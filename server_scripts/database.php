<?php
function get_db_connection(){ 
    $db = new mysqli('localhost','','',''); 
    $db->query("SET NAMES 'utf8'");
    return $db;
}
?>
