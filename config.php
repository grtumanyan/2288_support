<?php
/* Database credentials.*/
$host = 'support_db';
$db = 'support';
$user = 'root';
$password = 'password';


$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
$pdo = new PDO($dsn, $user, $password);
var_dump(1);
// Check connection
if($pdo === false){
    var_dump(3);
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
var_dump(2);
?>
