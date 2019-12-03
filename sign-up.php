<?php
session_start();

require 'password.php';   // password_hash()はphp 5.5.0以降の関数のため、バージョンが古くて使えない場合に使用
require 'db.php';

$errorMessage = "";
$signUpMessage = "";

if (isset($_POST["signUp"])) {

    $sthandler = $db->prepare("SELECT * FROM user WHERE name = :name");
    $sthandler->bindParam(':name', $_POST["username"]);
    $sthandler->execute();
    
    if (empty($_POST["username"])) { 
        $errorMessage = 'Enter username';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'Enter password';
    } else if (empty($_POST["password2"])) {
        $errorMessage = 'Enter password';
    } else if (empty($_POST["email"])) {
        $errorMessage = 'Enter e-mail address';
    } else if($sthandler->rowCount() > 0){
        $errorMessage = "This username is taken";
    } else if ($_POST["password"] != $_POST["password2"]) {
        $errorMessage = 'Your first and second password didn\'t match';
    }
    

    if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["password2"]) && !empty($_POST["email"])&& $_POST["password"] === $_POST["password2"] && $sthandler->rowCount() === 0) {
        
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];

        try {
            
            $stmt = $db->prepare("INSERT INTO booking_user(name, password, email) VALUES (?, ?, ?)");

            $stmt->execute(array($username, password_hash($password, PASSWORD_DEFAULT), $email));  
            //$userid = $db->lastinsertid();  // 登録した(DB側でauto_incrementした)IDを$useridに入れる

            $signUpMessage = 'You have successfully signed up! Your username is '. $username. ' . Your password is '. $password. ' .';  
        } catch (PDOException $e) {
            $errorMessage = 'Database Error';
            // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
        }

    } 
}
?>

<!doctype html>
<html>
    <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <script src="jquery-3.4.1.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="style.css">
            <title>SIGN UP</title>
    </head>

    <body id="sign-up-body">

        <header class="flex-header">
            <img src="img/logo.png" alt="" class="logo_2">
            <button onclick="location.href = 'login.php';" class="login">LOGIN</button>
        </header>

        <form id="loginForm" class="centered-block" name="loginForm" action="" method="POST">
            
                <h3 class="form-title">Registration Form</h3>
                <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
                <div><font color="#0000ff"><?php echo htmlspecialchars($signUpMessage, ENT_QUOTES); ?></font></div>
                <div class="form-group">
                <label for="username" class="form-label">USERNAME</label>
                <input type="text" id="username" class="form-control" name="username" value="<?php if (!empty($_POST["username"])) {echo htmlspecialchars($_POST["username"], ENT_QUOTES);} ?>">
                </div>
                <div class="form-group">
                <label for="password" class="form-label">PASSWORD</label>
                <input type="password" id="password" class="form-control" name="password" value="">
                </div>
                <div class="form-group">
                <label for="password2" class="form-label">PASSWORD RE-ENTER</label>
                <input type="password" id="password2" class="form-control" name="password2" value="">
                </div>
                <div class="form-group">
                <label for="email" class="form-label">E-MAIL</label>
                <input type="text" id="email" class="form-control" name="email" value="">
                </div>
                <input type="submit" class="submit" name="signUp" value="SIGN UP">

                <a href="admin-login.php" class="to-admin" target="_blank">ADMIN&raquo;</a>
            
        </form>
        <br>

    </body>
</html>