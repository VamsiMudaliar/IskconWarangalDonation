<?php


$con=mysqli_connect("localhost","u279605275_vyma","Mayapur@1080","u279605275_vyma") or die("cannot connect");


if($con){
    
}
// Check if image file is a actual image or fake image
//if (isset($_POST['upload'])) {
  	// Get image name
//  	echo "About to upload";
  	$name=$_POST["name"];
	$number=$_POST["number"];
	$info = $_POST["info"];
	$prof = $_POST["prof"];
    $dob=$_POST["dob"];
    $sql="INSERT INTO iyf(name,number,info,prof,dob) VALUES('$name','$number','$info','$prof','$dob')";
  	// execute query
  	$result = mysqli_query($con, $sql);
if($result)
{
    include '../pages/register_return.html';
}
else
{
    echo "Oops Something went wrong!!!";
}
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