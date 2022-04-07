<?php

$host = 'localhost';
$db = 'support';
$user = 'root';
$password = 'password';


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

        try {
            $file = file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/docs/' . uniqid(rand(), true) .'.txt', print_r($data, true), FILE_APPEND);
        }
        catch(Exception $ex){
            //Log Exception
            var_dump($ex->getMessage());exit;
        }

    }
}catch(Exception $ex){
    //Log Exception

    var_dump($ex->getMessage());
}


header('Location: index.php');
exit;
