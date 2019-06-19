<?php
$msg = "";
$register_valid = true;
if(isset($_POST['register_submit'])){
    if(!empty($_POST['username'])){
        $username = $_POST['username'];
    } else {
        $register_valid = false;
        $msg .= "Da fehlt noch ein Username.<br>";
    }    
    if(!empty($_POST['password'])){
        $password = $_POST['password'];
    } else {
        $register_valid = false;
        $msg .= "Da fehlt noch ein Passwort.<br>";
    }

    if(!empty($_POST['confirm_password'])){
        $confirm_password = $_POST['confirm_password'];
    } else {
        $register_valid = false;
        $msg .= "Da fehlt noch das Confirm Passwort.<br>";
    }

    if(!empty($_POST['email'])){
        $email = $_POST['email'];
    } else {
        $register_valid = false;
        $msg .= "Da fehlt noch eine E-mail.<br>";
    }

    if(!empty($_POST['firstname'])){
        $firstname = $_POST['firstname'];
    } else {
        $register_valid = false;
        $msg .= "Da fehlt noch ein Vorname.<br>";
    }

    if(!empty($_POST['lastname'])){
        $lastname = $_POST['lastname'];
    } else {
        $register_valid = false;
        $msg .= "Da fehlt noch ein Nachname.<br>";
    }    
    if(isset($password) && isset($confirm_password) && $password != $confirm_password){$register_valid = false;
                                                                                       $msg .= "Passswort und Passwortbestätigung sind nicht gleichs!<br>";
                                                                                      }

    if($register_valid){
        $db = mysqli_connect("localhost", "177301_12_1", "6qLRmKP1lVJY", "177301_12_1");
        if (mysqli_connect_error()) {
            die('Verbindungsfehler (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        }
        mysqli_query($db, "SET NAMES 'utf8'");
        $sql = "INSERT INTO user (username, password, email, firstname, lastname)
VALUES ('$username','$password','$email','$firstname','$lastname');";
        $result = mysqli_query($db, $sql);
        mysqli_close($db);
        if($result){
            $msg = "Sie haben erfolgreich registriert.</br>
<a href='index.php'>Bitte loggen Sie sich jetzt ein.</a></br>";
        }  else{
            $msg .= "Es gibt ein Problem mit der Datenbankverbindung.</br>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content= "width=device-width, initial-scale=1.0">
        <title>Anmeldung</title>
        <link href=css/style.css rel="stylesheet" type="text/css">
    </head>
    <body>
        <div>
            <div>
                <a href="index.php"><h3 class="webseitenname_unterseite">SEFER</h3></a>
            </div><br>
            <section class="register">
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                    <div>
                        <label for="id_username">Username: </label>
                        <input type="text" name="username" id="id_username" value="">
                    </div><br>
                    <div>
                        <label for="id_password">Passwort: </label>
                        <input type="password" name="password" id="id_password">
                    </div><br>
                    <div>
                        <label for="id_confirm_password">Passwort bestätigen: </label>
                        <input type="password" name="confirm_password" id="id_confirm_password">
                    </div><br>
                    <div>
                        <label for="id_email">E-Mail: </label>
                        <input type="email" name="email" id="id_email" value="">
                    </div><br>
                    <div>
                        <label for="id_firstname">Vorname: </label>
                        <input type="text" name="firstname" id="id_firstname" value=""> 
                    </div><br>
                    <div>
                        <label for="id_lastname">Nachname: </label>
                        <input type="text" name="lastname" id="id_lastname" value="">
                    </div>
                    <br>
                    <br>
                    <br>
                    <input type="submit" name="register_submit" value="registrieren">
                </form>
            </section>
            <?php if(!empty($msg)){ ?>
            <div>
                <p><?php echo $msg ?></p>
            </div>
            <?php } ?>
        </div>
    </body>
</html>