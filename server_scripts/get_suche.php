<?php
if(isset($_POST['submit_logout'])){
    session_start();
    if(isset($_SESSION['userid'])) unset($_SESSION['userid']);
    session_destroy();
    header( "Location: ../index.php" );
}
if(isset($_POST['submit'])){
    session_start();
    if(isset($_SESSION['userid'])){        
        $userid = $_SESSION['userid'];
    } 
    else{
        $userid = 0;
    }    
    $suchbegriff = $_POST['suchbegriff'];    
    $db = mysqli_connect("localhost", "177301_12_1", "6qLRmKP1lVJY", "177301_12_1");
    if (mysqli_connect_error()) {
        die('Verbindungsfehler (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
    }
    mysqli_query($db, "SET NAMES 'utf8'");  		
    $sql = "INSERT INTO searches (begriff, user_id)
VALUES ('$suchbegriff','$userid');";
    $result = mysqli_query($db, $sql);
    mysqli_close($db);
    $link = "https://www.google.com/search?q=".$suchbegriff;
    header( "Location: $link" );
}
$suche = $_GET['transfer_suchanfrage'];
$user_id = intval($_GET['id']);
require_once("database.php");
$db = get_db_connection();
if($user_id == 0){
    $sql = "SELECT * FROM searches WHERE begriff LIKE '".$suche."%' AND user_id = $user_id GROUP BY begriff ORDER BY search_time DESC;";
    $result = $db->query($sql);
    while ($row = $result->fetch_assoc()) { 
        echo "<option value='".$row['begriff']."'>"."Benutzer Gast</option>";
    }
} else {
    $sql2 = "SELECT * FROM searches WHERE begriff LIKE '".$suche."%' GROUP BY begriff ORDER BY search_time DESC;";
    $result2 = $db->query($sql2); 
    while ($row = $result2->fetch_assoc()) {
        $sql3 = "SELECT * FROM user WHERE user=".$row['user_id'].";";
        $result3 = $db->query($sql3);
        while ($row2 = $result3->fetch_assoc()) {
            if ($row['user_id'] == $user_id) {
                echo "<option value='".$row['begriff']."'>"."Benutzer ".$row2['firstname']."</option>";
            } else {
                echo "<option value='".$row['begriff']."'></option>";
            }
        }
    }
}
$db->close();
?>
