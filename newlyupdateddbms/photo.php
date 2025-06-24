<?php
include('sell.php');
$file_name=$_FILES['photo']['name'];
$temp_name=$_FILES['photo']['temp_name'];
$folder = 'sell/'.$file_name;

$query= mysqli_query($con, "insert into property (file) values ('$file_name')");

if(move_uploaded_file($tempname, $folder)) {
    echo "uploaded";
}
else{
    echo "not";
}
?>