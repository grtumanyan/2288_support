<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'] . "/visionFlowService.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/pointsCountingService.php";

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

        $file = file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/docs/test.txt", print_r($data, true));
        $ticket = $_SESSION["ticket"];
        //
        $res = countPoints($data);
        //
        $client = login();
        $result = (array)storeIssueDocument($client, $file, $ticket);
    }
}catch(Exception $ex){
    //Log Exception
    var_dump($ex->getMessage());
}


header('Location: index.php');
exit;
