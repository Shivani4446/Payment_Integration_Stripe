<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'vendor/autoload.php'; // Ensure you have Stripe PHP library installed

\Stripe\Stripe::setApiKey('sk_test_51PkeakEHBxWCsEiKJ7wJxkPldVAb7unJhTOvYdY3UI0m0DGWvlPSswEBRaLN05uXb74WCxYMSBICur53O5c4CP3100B9BX1cjl'); // Use your Secret Key

$input = file_get_contents('php://input');
$data = json_decode($input, true);

$paymentMethodId = $data['payment_method_id'];

try {
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => 800, // Amount in cents
        'currency' => 'usd',
        'payment_method' => $paymentMethodId,
        'confirm' => true,
    ]);

    // Extract payment details
    $paymentIntentId = $paymentIntent->id;
    $amountReceived = $paymentIntent->amount_received;
    $status = $paymentIntent->status;
    $timestamp = date('Y-m-d H:i:s');

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'payment'); // Use your DB credentials

    // Check connection
    if ($conn->connect_error) {
        throw new Exception('Connection failed: ' . $conn->connect_error);
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

    echo json_encode(['success' => true, 'payment_intent' => $paymentIntentId]);
} catch (\Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
