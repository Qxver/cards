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
        <link rel="stylesheet" type="text/css" href="css/login.css">
    </head>
    <body>
        <!--ALERT-->
        <div class="alert" style="z-index:1;position:fixed;margin:32% 22%;font-size:30px;font-weight:bold;">
            <?php if(isset($_COOKIE['alert'])){print $_COOKIE['alert'];setcookie("alert", "", time() - 10, "/");}?>
        </div>
        <!--FORM-->
        <div class="login">
            <h1>Reset password</h1>
            <form method="POST" action="includes/inc/recovery.inc.php">
                <label for="recovery-email"><img src="images/icons/email.png" width="30px" height="24px" alt="icon"></label>
                <input type="text" name="recovery-email" placeholder="email" required=""><br>
                <input type="submit" name="recovery-submit" value="Reset your password">
            </form>
        </div>
        <div class="signup">
            <img src="images/icons/login.png">
            <p><a href="index.php">Back to login page</a>
        </div>
    </body>
</html>