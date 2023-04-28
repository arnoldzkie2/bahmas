<?php
session_start();
include '../../db/conn.php';
if(!isset($_SESSION['admin'])){
  header('location: ../../auth/login.php');
  exit();
}

$id = $_GET['id'];

// Prepare the SQL statement
$stmt = $con->prepare("DELETE FROM child WHERE id = ?");

// Bind the parameter to the statement
$stmt->bind_param("i", $id);

// Execute the statement
if($stmt->execute()){
    header('location: ../../pages/child/child-record.php');
    exit();
} else {
    $err = "Error deleting record: " . $con->error;
}

?>
