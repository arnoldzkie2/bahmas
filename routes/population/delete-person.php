<?php
session_start();
include '../../db/conn.php';
if(!isset($_SESSION['admin'])){
  header('location: ../../auth/login.php');
  exit();
}
$id = $_GET['id'];
$stmt = $con->prepare("DELETE FROM population WHERE id = ?");
$stmt->bind_param("i", $id);

if($stmt->execute()){
    header('location: ../../pages/population/population.php');
    exit();
} else {
    $err = "Error deleting record: " . $con->error;
}
?>
