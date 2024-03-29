<?php
//$hashed_password = password_hash('TYPE_PASS_HERE', PASSWORD_DEFAULT);
//var_dump($hashed_password);
//exit;

// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

// DB values
$host = 'localhost';
$db = 'support';
$dbuser = 'support';
$dbpassword = 'password';
$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        try {
            $pdo = new PDO($dsn, $dbuser, $dbpassword);
            if ($pdo) {
                $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username=:username");
                $stmt->execute(['username' => $username]);
                $user = $stmt->fetch();

                if ($user) {
                    if (password_verify($password, $user['password'])) {
                        // Password is correct, so start a new session
                        session_start();

                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $user['id'];
                        $_SESSION["username"] = $username;

                        // Redirect user to welcome page
                        header("location: index.php");
                    } else {
                        // Password is not valid, display a generic error message
                        $login_err = "Invalid username or password.";
                    }
                } else {
                    // Password is not valid, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            }
        } catch (Exception $ex) {
            //Log Exception
            var_dump($ex->getMessage());
        }
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
            <h2>Login</h2>
            <p>Please fill in your credentials to login.</p>

            <?php
            if(!empty($login_err)){
                echo '<div class="alert alert-danger">' . $login_err . '</div>';
            }
            ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Login">
                </div>
                <p>Don't have an account? Contact administrator.</p>
            </form>
        </div>
    </div>

</body>
</html>
