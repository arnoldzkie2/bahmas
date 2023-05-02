<?php
include './db/conn.php';
session_start();
if(!isset($_SESSION['admin'])){
    header('location: ./auth/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bahmas</title>
</head>
<body>
<header class='header'>
    <img src="./bahmas.png" alt="">
        <a href="./index.php" class='active'><i class="fa-solid fa-house"></i> Home</a>
        <a href="./pages/child/child-record.php"><i class="fa-solid fa-child"></i> Child Record</a>
        <a href="./pages/patient/patient.php"><i class="fa-solid fa-hospital-user"></i> Patient</a>
        <a href="./pages/maternal/maternal.php"><i class="fa-solid fa-person-breastfeeding"></i></i> Maternal</a>
        <a href="./pages/population/population.php"><i class="fa-solid fa-users"></i> Population</a>
        <div class="medicine"><i class="fa-solid fa-kit-medical"></i> Medicine
        <i class="fa-solid fa-angle-down"></i><ul>
            <li><a href="./pages/medicine/inventory.php">Inventory</a></li>
            <li><a href="./pages/medicine/logs.php">Logs</a></li>
        </ul>
</div>
        <a href="./auth/logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
</header>
<main class='main'>
    <h1>Welcome to our barangay health center</h1>
    <h3>We offer various health services for our community including:</h3>
    <div class="card-container">
        <div class="card">
            <img src="./assets/img1.jpg" alt="">
            <h4>Medical consultations</h4>
        </div>
        <div class="card">
            <img src="./assets/img2.jpg" alt="">
            <h4>Nutrition counseling</h4>
        </div>
        <div class="card">
            <img src="./assets/img3.jpg" alt="">
            <h4>Vaccinations</h4>
        </div>
        <div class="card">
            <img src="./assets/img4.jpg" alt="">
            <h4>Health Education</h4>
        </div>
        <div class="card">
            <img src="./assets/img5.jpg" alt="">
            <h4>Family Planning/Education</h4>
        </div>
    </div>
</main>
</body>
</html>