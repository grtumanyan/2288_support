<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$db = 'support';
$user = 'root';
$password = 'password';

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = array_map ( 'htmlspecialchars' , $_POST );

    var_dump('think man');exit;

    try {
        $pdo = new PDO($dsn, $user, $password);

        $dataForDB = json_encode($data);
        if ($pdo) {
            $query = "INSERT INTO answers (data) VALUES('$dataForDB')";
            $pdo->exec($query);
            $fileUniqueName = uniqid().".txt";
            $fileName = $_SERVER['DOCUMENT_ROOT'] . "/docs/".$fileUniqueName;

            $points = $_SESSION["ticket_points"];
            if ($points < 50) {
                $data['beslutsstödets_svar'] = 'Går bra att avvakta hemma, Rådgivning från 2288';
            } elseif ($points >= 50 && $points <= 200) {
                $data['beslutsstödets_svar'] = 'Kontakta Firstvet';
            } elseif ($points > 200) {
                $data['beslutsstödets_svar'] = 'Åk till klinik';
            }

            $file = file_put_contents($fileName, print_r($data, true));
            $ticket = $_SESSION["ticket"];
            $ticketPrimaryKey = $_SESSION["ticket_primaryKey"];

            $client = login();
            $result = (array)storeIssueDocument($client, $fileName, $ticketPrimaryKey, $fileUniqueName);
            $_SESSION["ticket_points"] = $points;
            unlink($fileName);
        }
    }catch(Exception $ex){
        //Log Exception
        var_dump($ex->getMessage());
    }

}
else {
    $pdo = new PDO($dsn, $user, $password);
    if ($pdo) {
        $stmt = $pdo->prepare("SELECT * FROM standard");
        $stmt->execute();
        $standard = $stmt->fetch();
        $standard = explode(',', $standard['data']);
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
<div class="h-100 row justify-content-center">
    <div class="wrapper">
        <h2>Standard questions</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Please submit new entries with commas separated</label>
                <input type="textarea" name="standard" class="form-control value="<?php echo $standard; ?>">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Update">
            </div>
        </form>
    </div>
</div>

</body>
</html>

