<?php



$con=mysqli_connect("localhost","u279605275_vyma","Mayapur@1080","u279605275_vyma") or die("cannot connect");


if($con){
    
}
// Check if image file is a actual image or fake image
//if (isset($_POST['upload'])) {
  	// Get image name
//  	echo "About to upload";
    $name=$_POST["name"];
    $email=$_POST["email"];
	$number=$_POST["number"];
	$pan = $_POST["pan"];
    $dob=$_POST["dob"];
    $amount=$_POST["amount"];
    $purpose=$_POST["purpose"];
    $gotra = $_POST["gotra"];
    if(strcmp('$dob',''))
    {
        $sql="INSERT INTO donation(name,email,number,pan,gotra,amount,purpose) VALUES('$name','$email','$number','$pan','$gotra','$amount','$purpose')";
    }
    else
    {
        $sql="INSERT INTO donation(name,email,number,pan,dob,gotra,amount,purpose) VALUES('$name','$email','$number','$pan','$dob','$gotra','$amount','$purpose')";
    }
      // execute query
  	$result = mysqli_query($con, $sql);
if($result)
{
    echo "Redirecting to payment gateway...";
}
else
{

}


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
$orderDetails["appId"] = "vnXlYV5gYF7TTMEuyWZHGJZo";

$orderDetails["signature"] = generateSignature($orderDetails);



function generateSignature($postData)
{
    $secretKey = "vnXlYV5gYF7TTMEuyWZHGJZo";
    ksort($postData);
    $signatureData = "";
    foreach ($postData as $key => $value){
       $signatureData .= $key.$value;
    }
    $signature = hash_hmac('sha256', $signatureData, $secretKey,true);
    $signature = base64_encode($signature);
    return $signature;
}

?>


<form id="redirectForm" method="post" action="https://checkout.razorpay.com/v1/checkout.js">
    <input type="hidden" name="appId" value="<?php echo $orderDetails["appId"]  ?>"/>
    <input type="hidden" name="orderId" value="<?php echo $orderDetails["orderId"]  ?>"/>
    <input type="hidden" name="orderAmount" value="<?php echo $orderDetails["orderAmount"]  ?>"/>
    <input type="hidden" name="orderCurrency" value="<?php echo $orderDetails["orderCurrency"]  ?>"/>
    <input type="hidden" name="orderNote" value="<?php echo $orderDetails["orderNote"]  ?>"/>
    <input type="hidden" name="customerName" value="<?php echo $orderDetails["customerName"]  ?>"/>
    <input type="hidden" name="customerEmail" value="<?php echo $orderDetails["customerEmail"]  ?>"/>
    <input type="hidden" name="customerPhone" value="<?php echo $orderDetails["customerPhone"]  ?>"/>
    <input type="hidden" name="returnUrl" value="<?php echo $orderDetails["returnUrl"]  ?>"/>
    <input type="hidden" name="notifyUrl" value="<?php echo $orderDetails["notifyUrl"]  ?>"/>
    <input type="hidden" name="signature" value="<?php echo $orderDetails["signature"]  ?>"/>
  </form>

  <script>document.getElementById("redirectForm").submit();</script>

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