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
    $data = array_map ( 'htmlspecialchars' , $_POST );
}
var_dump($data);exit;
try {
    $pdo = new PDO($dsn, $user, $password);

    $dataForDB = json_encode($data);
    if ($pdo) {
        $query = "INSERT INTO answers (data) VALUES('$dataForDB')";
        $pdo->exec($query);
        $fileName = $_SERVER['DOCUMENT_ROOT'] . "/docs/".uniqid().".txt";
        $file = file_put_contents($fileName, print_r($data, true));
        $ticket = $_SESSION["ticket"];
        //
        $res = countPoints($data);
        //
        $client = login();
        $result = (array)storeIssueDocument($client, $file, $ticket);
        unlink($fileName);

    }
}catch(Exception $ex){
    //Log Exception
    var_dump($ex->getMessage());
}


header('Location: index.php');
exit;
