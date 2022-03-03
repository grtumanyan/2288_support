<?php

$host = 'support_db';
$db = 'support';
$user = 'root';
$password = 'root';


$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

if (!empty($_POST)) {
    $data = $_POST;
}


try {
    $pdo = new PDO($dsn, $user, $password);

    $data = json_encode($data);
    if ($pdo) {
        $query = "INSERT INTO answers (data) VALUES('$data')";


        $pdo->exec($query);

    }
}catch(Exception $ex){
    //Log Exception

    var_dump($ex->getMessage());
}


header('Location: index.php');
exit;