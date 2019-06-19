<?php
session_start();
$logged_in = false;
$user_id = 0;

if(isset($_SESSION['userid'])){
    $user_id = $_SESSION['userid'];
    $username = $_SESSION['username'];
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $logged_in = true;
    $log_in_out_text = "Logout";
}  
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content= "width=device-width, initial-scale=1.0">
        <title>Suchmaschine</title>
        <link href=css/style.css rel="stylesheet" type="text/css">
        <script src="js/datalist-polyfill.min.js"></script>
    </head>
    <body>
        <input type="hidden" id="u_id" value="<?php echo $user_id ?>">
        <a href="index.php"><h1 class="webseitenname"> SEFER </h1></a>
        <div class="login">
            <?php if(!empty($msg)){ ?>
            <div>
                <p><?php echo $msg ?></p>
            </div>
            <?php } ?>
        </div>
        <footer>
            <form action="/server_scripts/get_suche.php"   method="post">
                <label class="searchbutton">
                    Suche:
                    <input list="such_anfragen" name="suchbegriff" id="sucheingabe">            
                    <button type="submit" name="submit">Suchen</button>
                </label>
            </form>
            <datalist id="such_anfragen" >
            </datalist>
            <script src="js/jquery-3.1.1.min.js"></script>
            <script> 
                $(document).ready(function(){
                    var u_id = $('#u_id').val();
                    $( '#sucheingabe' ).keyup(function(){
                        var suche = $( this ).val();
                        $.ajax({
                            method: 'GET',
                            url: 'server_scripts/get_suche.php',
                            data: { transfer_suchanfrage: suche , id : u_id},
                            success: function (ajax_output) {
                                console.log(ajax_output);
                                $( '#such_anfragen' ).html(ajax_output);
                            }
                        });        
                    });
                });
            </script>
            <br>
            <p id='test_anfragen'></p>
            <div class="aufforderung">
                <?php if($logged_in){ ?>
                <?php }else{ ?>
                Um Suchbegriffe zu speichern, <a href='login.php'>loggen </a> Sie sich bitte ein.<br>
                Noch keinen Account?<a href="register.php"> Registriere dich hier!</a><br>
                <?php }?>
                <?php
                if($logged_in){?>
                <p>Hallo <?php echo $username ?>, du kannst nun Suchanfragen tätigen.</p>
                <p>Eingeloggt als <?php echo $firstname . " " . $lastname ?></p>
                <form action="server_scripts/get_suche.php" method="post"><button type="submit" name="submit_logout">Logout</button></form>
                <?php
                              }
                else{ ?>
                <section>
                    <!--<?php echo $_SERVER['PHP_SELF']?>-->
                </section><br>
                <?php } ?>
            </div>
        </footer>
    </body>
</html>
