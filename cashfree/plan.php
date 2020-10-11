<?php

$con=mysqli_connect("localhost","u279605275_vyma","Mayapur@1080","u279605275_vyma") or die("cannot connect");


if($con){
    
}
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
    $sql="INSERT INTO rec_donation(name,email,number,pan,gotra,amount,purpose) VALUES('$name','$email','$number','$pan','$gotra','$amount','$purpose')";
}
else
{
    $sql="INSERT INTO rec_donation(name,email,number,pan,dob,gotra,amount,purpose) VALUES('$name','$email','$number','$pan','$dob','$gotra','$amount','$purpose')";
}
$result = mysqli_query($con, $sql);


$planId = time();
$amount = $_POST["amount"];
$name = $_POST["name"];
$email = $_POST["email"];
$phone = $_POST["number"];
$plan = shell_exec("curl -XPOST -H 'cache-control: no-cache' -H 'content-type: application/json' -H 'X-Client-Id: 63651c7956cafd4dc1083dce615636' -H 'X-Client-Secret: 5b7aebe4bc38ef2877da96bcdf5aa97f3c0bbbee' -d '{ \"planId\":\"$planId\", \"planName\":\"$name\", \"type\":\"PERIODIC\" ,\"amount\":\"$amount\", \"intervalType\":\"month\", \"intervals\":1,\"description\":\"This is the standard plan for our services\"}' 'https://api.cashfree.com/api/v2/subscription-plans'");
$subscription = shell_exec("curl -XPOST -H 'cache-control: no-cache' -H 'content-type: application/json' -H 'X-Client-Id: 63651c7956cafd4dc1083dce615636' -H 'X-Client-Secret: 5b7aebe4bc38ef2877da96bcdf5aa97f3c0bbbee'  -d '{\"subscriptionId\":\"$planId\", \"planId\":\"$planId\", \"customerEmail\":\"$email\", \"customerPhone\":\"$phone\", \"returnUrl\":\"https://iskconwarangal.com/pages/return.html\"}' 'https://api.cashfree.com/api/v2/subscriptions'");
$obj = json_decode($subscription);
$link = $obj->{"authLink"};
header("Location: $link");
?>