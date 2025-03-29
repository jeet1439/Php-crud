<?php
// Airpay Credentials (Replace with actual values)
$merchant_id = "334244";
$username = "cEx7RxEp4M";
$password = "aX6rYaZe";
$secret_key = "C7Ux5qUZPUP35DYW"; // Secret key, not API key

// Transaction Details
$transaction_id = "ORDER_12345"; // Unique Order ID
$amount = "1.00"; // Transaction amount
$currency = "356"; // INR currency code (356 is the numeric code for INR)
$return_url = "http://localhost/success.php"; // Your response handler URL
$customer_email = "test@example.com";
$customer_phone = "9876543210";
$billing_name = "John Doe";

// Airpay URL
$airpay_url = "https://payments.airpay.co.in/pay/index.php";

// Prepare payload
$data = [
    "MERCHANTID"    => $merchant_id,
    "USERNAME"      => $username,
    "PASSWORD"      => $password,
    "LOGINID"       => $customer_email,
    "CURRENCY"      => $currency,
    "AMOUNT"        => $amount,
    "TRANSACTIONID" => $transaction_id,
    "RETURN_URL"    => $return_url,
    "EMAIL"         => $customer_email,
    "PHONE"         => $customer_phone,
    "BILLINGNAME"   => $billing_name,
];

// Generate checksum
$data["CHECKSUM"] = generateChecksum($data, $secret_key);

// Function to generate checksum
function generateChecksum($data, $secret_key) {
    ksort($data); // Sort data alphabetically by key
    $checksum_string = implode("|", $data) . "|" . $secret_key;
    return hash('sha256', $checksum_string);
}

?>

<!-- Auto-submit form to Airpay -->
<form id="airpayForm" action="<?php echo $airpay_url; ?>" method="POST">
    <?php foreach ($data as $key => $value) { ?>
        <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
    <?php } ?>
</form>

<script>
    document.getElementById("airpayForm").submit(); // Auto-submit form
</script>
