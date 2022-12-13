<?php
/* Database credentials.*/
$host = 'support_db';
$db = 'support';
$user = 'support';
$password = 'password';


$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
$pdo = new PDO($dsn, $user, $password);


// Check connection
if($pdo === false){

    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>
