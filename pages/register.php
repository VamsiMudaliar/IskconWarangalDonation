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
$dob=$_POST["dob"];

//echo $dob;

//$sql="INSERT INTO drawing(name) VALUES('$name')";
$sql = "INSERT INTO drawing(name,email,number,dob) VALUES('$name','$email','$number','$dob')";
  // execute query
//echo $sql;

if($result = mysqli_query($con, $sql))
{
    include '../pages/register_return.html';
}
else
{
    echo "Oops Something went wrong!!!";
}
mysqli_query($con, "commit");
mysqli_close($con);
/*  	$image = $_FILES['image']['name'];
  	// image file directory
  	$target = "uploads/".basename($image);

  	

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  		echo "Hello world";
  	}else{
  		$msg = "Failed to upload image";
  	}
  }
*/

?>