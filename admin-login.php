<?php
require 'password.php';   // password_verfy()はphp 5.5.0以降の関数のため、バージョンが古くて使えない場合に使用
require 'db.php';

session_start();

$errorMessage = "";

if (isset($_POST["login"])) {
   
    if (!empty($_POST["userid"]) && !empty($_POST["password"])) {
        
        $userid = $_POST["userid"];

        try {
            $stmt = $db->prepare('SELECT * FROM booking_admin WHERE name = ?');
            $stmt->execute(array($userid));

            $password = $_POST["password"];

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($password, $row['password'])) {
                    session_regenerate_id(true);

                    $_SESSION["admin-id"] = $row['id'];                  

                    header("Location: admin.php");  
                    exit(); 
                } else {
                    $errorMessage = 'Wrong password';
                }
            } else {  
                $errorMessage = 'This User Name does not exist';
            }
        } catch (PDOException $e) {
            $errorMessage = 'Database Error';
            echo $e->getMessage();
        }
    } else {
        if (empty($_POST["userid"])) {  
            $errorMessage = 'User ID not entered';
        } else if (empty($_POST["password"])) {
            $errorMessage = 'Password not entered';
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
            <title>ADMIN-LOGIN</title>
    </head>

    <body>

        <form id="loginForm" class="centered-block" name="loginForm" action="" method="POST">
           
            <h3 class="form-title">ADMIN LOGIN</h3>
                <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
                <div class="form-group">
                <label for="userid" class="form-label">USERNAME</label><input type="text" id="userid" class="form-control" name="userid" value="<?php if (!empty($_POST["userid"])) {echo htmlspecialchars($_POST["userid"], ENT_QUOTES);} ?>">
                </div>
                <div class="form-group">
                <label for="password" class="form-label">PASSWORD</label><input type="password" id="password" class="form-control" name="password" >
                </div>
                <input type="submit" class="submit" name="login" value="LOGIN">
       
        </form>

    </body>
</html>
