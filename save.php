<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/visionFlowService.php";

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

        $file = fopen($_SERVER['DOCUMENT_ROOT'] . "/docs/test.txt", "a") or die("Unable to open file!");
        fwrite($file, "\n". $data);
        fclose($file);
        var_dump($file);exit;
        
        $data = file_get_contents($file);
        $content= base64_decode($data);
        $result = (array)storeProjectDocument($client, $file, $content, $ticket);
    }
}catch(Exception $ex){
    //Log Exception

    var_dump($ex->getMessage());
}


header('Location: index.php');
exit;
