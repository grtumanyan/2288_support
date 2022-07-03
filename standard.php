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
    $new_standard = $_POST['standard'];

    try {
        $pdo = new PDO($dsn, $user, $password);

//        $dataForDB = json_encode($new_standard);
        if ($pdo) {
            $sql = "UPDATE standard SET data=? WHERE id=?";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$new_standard, 1]);
        }
        header('Location: index.php');
        exit;
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
<div class="container">
    <div class="py-5 text-center">
        <h2>Standard questions</h2>
        <p class="lead">Edit standard questions here, or</p>
        <a class="btn btn-info" href="index.php">Go Home</a>
    </div>

    <div class="row">
        <div class="col-md-12  text-center">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <textarea class="form-control" name="standard" rows="3"><?php echo $standard['data']; ?></textarea>
                </div>
                <input type="submit" value="Update!" />
            </form>
        </div>
    </div>
</div>

</body>
</html>

