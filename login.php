<?php
session_start();
$logged_in = false;
if(isset($_SESSION['userid'])){
    $user_id = $_SESSION['userid'];
    $username = $_SESSION['username'];
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $logged_in = true;
    $log_in_out_text = "Logout";
}
if(isset($_POST['login_submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $db = mysqli_connect("localhost", "177301_12_1", "6qLRmKP1lVJY", "177301_12_1");
    if (mysqli_connect_error()) {
        die('Verbindungsfehler (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
    }
    mysqli_query($db, "SET NAMES 'utf8'");
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password';";
    $result = mysqli_query($db, $sql);
    mysqli_close($db);
    $row_count = mysqli_num_rows($result);
    if($row_count == 1){
        session_start();
        $user = mysqli_fetch_assoc($result);
        $_SESSION['userid'] = $user['user'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['firstname'] = $user['firstname'];
        $_SESSION['lastname'] = $user['lastname'];
        header('Location: index.php');
    }else{
        $msg = "leider falsch.";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content= "width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link href=css/style.css rel="stylesheet" type="text/css">
    </head>
    <body>
        <div>
            <a href="index.php"><h3 class="webseitenname_unterseite">SEFER</h3></a>
            <section class="login">
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                    <div>
                        <label for="id_username">Username: </label>
                        <input type="text" name="username" id="id_username">
                    </div>
                    <div>
                        <label for="id_password">Passwort: </label> 
                        <input type="password" name="password" id="id_password">
                    </div>
                    <br>
                    <br>
                    <br>

                    <input type="submit" name="login_submit" value="einloggen">
                </form>
            </section>
            <?php if(!empty($msg)){ ?>
            <div>
                <p><?php echo $msg ?></p>
            </div>
            <?php } ?>
        </div>
        <div class="aufforderung">
            <?php if($logged_in){ ?>
            <?php }else{ ?>
            Noch keinen Account?<a href="register.php"> Registriere dich hier!</a><br>
            <?php }?>
        </div>
    </body>
</html>