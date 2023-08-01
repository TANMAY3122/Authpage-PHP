<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "auth-sys";

$conn = mysqli_connect($server , $username , $password , $database);


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $myemail = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "INSERT INTO users ( `email`, `username`, `mypassword`, `date`) VALUES ( ' $myemail', '$username', ' $password', current_timestamp())";
    
}


              ?>