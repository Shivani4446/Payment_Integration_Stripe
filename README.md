Stripe Payment Integration

Overview
    This project integrates Stripe for handling payments. It includes a front-end payment form, a PHP backend for processing payments, a webhook receiver for handling Stripe events, and database integration for storing payment details.
Features
    •	Front-end Payment Form: Collects payment information.
    •	Stripe Integration: Handles payment processing with Stripe's API.
    •	Webhook Receiver: Receives and processes Stripe webhook events.
    •	Database Integration: Stores payment details in a MySQL database.
    •	Error Handling: Manages errors gracefully.
Prerequisites
•	PHP 7.4 or higher
•	Composer for PHP dependencies
•	MySQL or compatible database
•	Stripe account (Test keys for development)


Steps:
Install Dependencies
  composer install

Configure Environment
Front-end Form
  Edit the front-end HTML file index.html to include your Stripe Publishable Key.
PHP Scripts
  •	process_payment.php: Update with your Stripe Secret Key.
  •	webhook_receiver.php: Update with your Stripe Secret Key and webhook URL.
Database Configuration
  1.	Create a database named payment.
  2.	Run the following SQL to create the payments table:

Set Up Webhooks
  1.	Log in to your Stripe Dashboard.
  2.	Navigate to Developers > Webhooks.
  3.	Add a new endpoint with the URL https://yourdomain.com/webhook_receiver.php.
  4.	Subscribe to the payment_intent.succeeded event.
  5. Testing
Sample Webhook Payloads
  To test your webhook receiver, use the following sample payloads:



charge.succeeded payload:

{
  "id": "ch_3PkjljEHBxWCsEiK1ZmGZK17",
  "object": "charge",
  "livemode": false,
  "payment_intent": "pi_3PkjljEHBxWCsEiK1tIUlJEq",
  "status": "succeeded",
  "amount": 1200,
  "amount_captured": 1200,
  "amount_refunded": 0,
  "application": null,
  "application_fee": null,
  "application_fee_amount": null,
  "balance_transaction": "txn_3PkjljEHBxWCsEiK1Khw1dFu",
  "billing_details": {
    "address": {
      "city": null,
      "country": null,
      "line1": null,
      "line2": null,
      "postal_code": "11221",
      "state": null
    },
    "email": null,
    "name": null,
    "phone": null
  },
  "calculated_statement_descriptor": "Stripe",
  "captured": true,
  "created": 1722936807,
  "currency": "usd",
  "customer": null,
  "description": null,
  "destination": null,
  "dispute": null,
  "disputed": false,
  "failure_balance_transaction": null,
  "failure_code": null,
  "failure_message": null,
  "fraud_details": {
  },
  "invoice": null,
  "metadata": {
  },
  "on_behalf_of": null,
  "order": null,
  "outcome": {
    "network_status": "approved_by_network",
    "reason": null,
    "risk_level": "normal",
    "risk_score": 11,
    "seller_message": "Payment complete.",
    "type": "authorized"
  },
  "paid": true,
  "payment_method": "pm_1PkjlhEHBxWCsEiKzVURslLU",
  "payment_method_details": {
    "card": {
      "amount_authorized": 1200,
      "authorization_code": null,
      "brand": "visa",
      "checks": {
        "address_line1_check": null,
        "address_postal_code_check": "pass",
        "cvc_check": "pass"
      },
      "country": "US",
      "exp_month": 12,
      "exp_year": 2027,
      "extended_authorization": {
        "status": "disabled"
      },
      "fingerprint": "y5iXDVzMzPYMDKAd",
      "funding": "credit",
      "incremental_authorization": {
        "status": "unavailable"
      },
      "installments": null,
      "last4": "4242",
      "mandate": null,
      "multicapture": {
        "status": "unavailable"
      },
      "network": "visa",
      "network_token": {
        "used": false
      },
      "overcapture": {
        "maximum_amount_capturable": 1200,
        "status": "unavailable"
      },
      "three_d_secure": null,
      "wallet": null
    },
    "type": "card"
  },
  "radar_options": {
  },
  "receipt_email": null,
  "receipt_number": null,
  "receipt_url": "https://pay.stripe.com/receipts/payment/CAcaFwoVYWNjdF8xUGtlYWtFSEJ4V0NzRWlLKOrbx7UGMgaSR4obCHE6LBZTIvlpPyjvp-OS4qptuX_pxAapXTkLAF-O3dHpR9DnAasNdun5kty-8NAy",
  "refunded": false,
  "review": null,
  "shipping": null,
  "source": null,
  "source_transfer": null,
  "statement_descriptor": null,
  "statement_descriptor_suffix": null,
  "transfer_data": null,
  "transfer_group": null
}


Contributing
Feel free to submit pull requests or open issues for improvements and bug fixes.

License
