<?php 
$con = new mysqli('localhost', 'root', '', 'bahmas');
if(!$con){
    echo "database not connected";
}
?>