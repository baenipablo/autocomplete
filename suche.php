<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content= "width=device-width, initial-scale=1.0">
        <title>Suche</title>
        <link href=css/style.css rel="stylesheet" type="text/css">
        <script src="js/datalist-polyfill.min.js"></script>
    </head>
    <body>   
        <form action="/server_scripts/get_suche.php"   method="post">
            <label>
                Suche:
                <input list="such_anfragen" name="suchbegriff" id="sucheingabe">           
                <button type="submit" name="submit">Suchen</button>
            </label>
        </form>
        <datalist id="such_anfragen" ></datalist>

        <script src="js/jquery-3.1.1.min.js">
        </script>

        <script>
            $(document).ready(function(){
                $( '#sucheingabe' ).keyup(function(){
                    var suche = $( this ).val();
                    $.ajax({
                        method: 'GET',
                        url: 'server_scripts/get_suche.php',
                        data: { transfer_suchanfrage: suche},
                        success: function (ajax_output) {
                            $( '#such_anfragen' ).html(ajax_output);
                        }
                    });
                });
            });
        </script>
    </body>
</html>
