<?php
function get_db_connection(){ 
    $db = new mysqli('localhost','177301_12_1','6qLRmKP1lVJY','177301_12_1'); 
    $db->query("SET NAMES 'utf8'");
    return $db;
}
?>
