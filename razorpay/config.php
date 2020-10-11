<?php
use Razorpay\Api\Api;
$key_id = "rzp_test_tvD0z3n7UH9DHC";
$key_secret = "vnXlYV5gYF7TTMEuyWZHGJZo";
$host = "https://iskconwarangal.com";
$notifyUrl = $host;
$returnUrl = "https://iskconwarangal.com/pages/return.html";

$orderDetails = array();
$orderDetails["notifyUrl"] = $notifyUrl;
$orderDetails["returnUrl"] = $returnUrl;

$userDetails = getUserDetails($orderId);
$order = getOrderDetails($orderId);

$orderDetails["customerName"] = $userDetails["customerName"];
$orderDetails["customerEmail"] = $userDetails["customerEmail"];
$orderDetails["customerPhone"] = $userDetails["customerPhone"];

$orderDetails["orderId"] = $order["orderId"];
$orderDetails["orderAmount"] = $order["orderAmount"];
$orderDetails["orderNote"] = $order["orderNote"];
$orderDetails["orderCurrency"] = $order["orderCurrency"];

$orderDetails["signature"] = generateSignature($orderDetails);

$api = new Api($key_id, $key_secret);
$attributes  = array('razorpay_signature'  => '23233',  'razorpay_payment_id'  => '332' ,  'order_id' => '12122');
$order  = $api->utility->verifyPaymentSignature($attributes);

?>

    <form action="https://www.example.com/payment/success/" method="POST"> 
        <script
            src="https://checkout.razorpay.com/v1/checkout.js"
            data-key="<?php echo $key_id ?>" 
            data-amount="<?php echo $orderDetails["orderAmount"] ?>"
            data-currency="INR"
            data-order_id="<?php echo $orderDetails["orderId"] ?>"
            data-buttontext="Donate"
            data-name="ISKCON"
            data-description="Serve"
            data-prefill.name="<?php echo $orderDetails["customerName"] ?>"
            data-prefill.email="<?php echo $orderDetails["customerEmail"] ?>"
            data-prefill.contact="<?php echo $orderDetails["customerPhone"] ?>"
            data-theme.color="#F37254"
        ></script>
        <input type="hidden" custom="Hidden Element" name="hidden">
    </form>

<?php

function getUserDetails($orderId)
{
    return array
    (
        "customerName" => $_POST["name"],
        "customerEmail" => $_POST["email"],
        "customerPhone" => $_POST["number"]
    );

}
function getOrderDetails($orderId)
{
    return array
    (
        "orderId" => time(),
        "orderAmount" => $_POST["amount"],
        "orderNote" => "Pay to ISKCON",
        "orderCurrency" => "INR"
    );

}

?>