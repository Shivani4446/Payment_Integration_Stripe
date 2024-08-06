<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set content type to JSON
header('Content-Type: application/json');

// Include Stripe PHP library
require 'vendor/autoload.php'; // Ensure this path is correct

// Your Stripe Secret Key
\Stripe\Stripe::setApiKey('sk_test_51PkeakEHBxWCsEiKJ7wJxkPldVAb7unJhTOvYdY3UI0m0DGWvlPSswEBRaLN05uXb74WCxYMSBICur53O5c4CP3100B9BX1cjl');

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (isset($data['payment_method_id'])) {
    $paymentMethodId = $data['payment_method_id'];

    try {
        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => 1200, // Amount in cents
            'currency' => 'usd',
            'payment_method' => $paymentMethodId,
            'confirm' => true,
            'return_url' => 'http://localhost/test.php', // Update with your return URL
        ]);

        // Extract payment details
        $paymentIntentId = $paymentIntent->id;
        $amountReceived = $paymentIntent->amount_received;
        $status = $paymentIntent->status;
        $timestamp = date('Y-m-d H:i:s');

        // Connect to the database
        $conn = new mysqli('localhost', 'root', '', 'payment'); // Update with your DB credentials

        // Check connection
        if ($conn->connect_error) {
            throw new Exception('Database connection failed: ' . $conn->connect_error);
        }

        // Prepare and execute the SQL statement
        $stmt = $conn->prepare("INSERT INTO payments (payment_intent_id, amount_received, status, timestamp) VALUES (?, ?, ?, ?)");
        if ($stmt === false) {
            throw new Exception('Prepare failed: ' . $conn->error);
        }

        $stmt->bind_param('siss', $paymentIntentId, $amountReceived, $status, $timestamp);
        if (!$stmt->execute()) {
            throw new Exception('Execute failed: ' . $stmt->error);
        }

        $stmt->close();
        $conn->close();

        // Prepare data for webhook
        $webhookData = [
            'payment_intent' => $paymentIntentId,
            'amount_received' => $amountReceived,
            'status' => $status
        ];

        // Send data to webhook
        $webhookUrl = 'https://yourdomain.com/webhook_receiver.php'; // Update with the correct path
        $ch = curl_init($webhookUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($webhookData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        // Check webhook response
        $responseData = json_decode($response, true);
        if (isset($responseData['error'])) {
            throw new Exception('Webhook error: ' . $responseData['error']);
        }

        // Respond to the client
        echo json_encode([
            'success' => true,
            'payment_intent' => $paymentIntentId
        ]);

    } catch (\Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'No payment method ID received']);
}
?>
