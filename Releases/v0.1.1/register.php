<?php
session_start();
// UID SESSION
if(isset($_COOKIE['LOGIN'])){
    header("location: home.php");
    exit();
}
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Card</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/register.css">
    </head>
    <body>
        <!--ALERT-->
        <div class="alert" style="z-index:1;position:fixed;margin:32% 55%;font-size:30px;font-weight:bold;">
            <?php if(isset($_COOKIE['alert'])){print $_COOKIE['alert'];setcookie("alert", "", time() - 10, "/");}?>
        </div>
        <!--FORM-->
        <div class="signup">
            <h1>Sign up</h1>
            <form method="POST" action="includes/inc/register.inc.php">
                <label for="register-username"><img src="images/icons/username.png" width="30px" height="24px" alt="icon"></label>
                <input type="text" name="register-username" placeholder="username" required=""><br>
                <label for="register-email"><img src="images/icons/email.png" width="30px" height="24px" alt="icon"></label>
                <input type="text" name="register-email" placeholder="email" required=""><br>
                <label for="register-password"><img src="images/icons/password.png" width="30px" height="24px" alt="icon"></label>
                <input id="password" type="password" name="register-password" placeholder="password" required=""><img style="position:fixed;margin:0.9% -2.7%;" 
                onclick="passwd()" src="images/icons/eye.png" width="30px" height="24px" alt="icon"><br>
                <input type="submit" name="register-submit" value="Register">
            </form>
            <span style="font-size: 15px;">By creating an account you agree to our <a href="#">Terms & Privacy</a></span>
        </div>
        <div class="login">
            <img src="images/icons/register.png">
            <p>Already have an account? <a href="index.php">Sign in</a></p>
        </div>
        <!--JAVA SCRIPT-->
        <script src="js/password.js"></script>
    </body>
</html>