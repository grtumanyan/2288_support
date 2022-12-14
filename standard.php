<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$host = 'localhost';
$db = 'support';
$user = 'support';
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
<nav class="navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><?= $_SESSION["username"]; ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample02">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="standard.php">Standard questions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Sign out</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-md-0">
            <input class="form-control" type="text" placeholder="Search">
        </form>
    </div>
</nav>
<div class="container">
    <div class="py-5 text-center">
        <h2>Standard questions</h2>
        <p class="lead">Edit standard questions here</p>
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

