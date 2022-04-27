<?php 
$host = "localhost";
$db_name = "librarydb";
$db_user = "root";
$db_pass = "";


$conn = mysqli_connect($host,$db_user,$db_pass,"$db_name");
if(!$conn){
    die ("Could not connect mysql:".mysqli_error());
}
?>