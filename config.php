<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "auth-sys";

$conn = mysqli_connect($server , $username , $password , $database);
if($conn){
    echo "success";
}
else{
    echo("Error" . mysqli_connect_error() );
}
?>