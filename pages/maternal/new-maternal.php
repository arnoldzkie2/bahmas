<?php
include '../../db/conn.php';
session_start();
if(!isset($_SESSION['admin'])){
  header('location: ../../auth/login.php');
  exit();
}
$err = "";
if(isset($_POST['addparent'])){
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $spouse = $_POST['spouse'];
    $contact_no = $_POST['contact_no'];
    $civil_status = $_POST['civil_status'];
    $birthdate = $_POST['birthdate'];
    $age = $_POST['age'];
    $blood_pressure = $_POST['blood_pressure'];
    $weight = $_POST['weight'];
    $last_period = $_POST['last_period'];
    $month_pregnancy = $_POST['month_pregnancy'];
    $month_delivery = $_POST['month_delivery'];
    $date = $_POST['date'];

    $stmt = $con->prepare("INSERT into maternal (first_name, middle_name, last_name, address, spouse, contact_no, 
    civil_status, birthdate, age, blood_pressure, weight, last_period, 
    month_pregnancy, month_delivery, date) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssssssssssss", $first_name, $middle_name, $last_name, $address, $spouse, $contact_no, $civil_status, $birthdate, $age
, $blood_pressure, $weight, $last_period, $month_pregnancy, $month_delivery, $date);
    $stmt->execute();
    header('location: ./maternal.php');
    exit();    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./new-maternal.css">
    <link rel="stylesheet" href="../../index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bahmas</title>
</head>
<body>
<header class='header'>
<img src="../../bahmas.png" alt="">
        <a href="../../index.php"><i class="fa-solid fa-house"></i> Home</a>
        <a href="../../pages/child/child-record.php"  ><i class="fa-solid fa-child"></i> Child Record</a>
        <a href="../../pages/patient/patient.php"><i class="fa-solid fa-hospital-user"></i> Patient</a>
        <a href="../../pages/maternal/maternal.php" class='active'><i class="fa-solid fa-person-breastfeeding"></i></i> Maternal</a>
        <a href="../../pages/population/population.php"><i class="fa-solid fa-users"></i> Population</a>
        <div class="medicine" ><i class="fa-solid fa-kit-medical"></i> Medicine
        <i class="fa-solid fa-angle-down"></i><ul>
            <li><a href="../../pages/medicine/inventory.php">Inventory</a></li>
            <li><a href="../../pages/medicine/logs.php">Logs</a></li>
        </ul>
</div>
        <a href="../../auth/logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
</header>
<main class='new-child'>
    <h1>ADD NEW PARENT</h1>
    <form method='POST'>
            <?php
        if (!empty($err)) {
            echo '<div class="err">' . $err . '</div>';
        }
        ?>
        <label>Parent Info</label>
        <div class="two">
            <input type="text" placeholder="Enter first name" name="first_name" required>
            <input type="text" placeholder="Enter middle name"  name="middle_name" required>
            <input type="text" placeholder="Enter last name"  name="last_name" required>
        </div>

        <div class="two">

            <input type="text" placeholder="Age"  name="age" required>
            <input type="text" placeholder="Blood pressure"  name="blood_pressure" required>
            <input type="text" placeholder="Weight"  name="weight" required>
        </div>
            <input type="text" name="address" required placeholder="Address">
            <div class="two">
                <label for="">Birthdate</label>
                <input type="date" required name="birthdate">
            </div>
            <br>
            <label for="">Last period / Month of pregnancy / Month of delivery / Date</label>
            <div class="two">
                <input type="date" name="last_period" required>
                <input type="date" name="month_pregnancy" required>
                <input type="date" name="month_delivery" required>
                <input type="date" name="date" required>
            </div>
            <div class="two">
                <label for=""> Civil Status</label>
                <select name="civil_status">
                    <option value="single">single</option>
                    <option value="married">married</option>
                    <option value="divorced">divorced</option>
                    <option value="separated">separated</option>
                    <option value="widowed">widowed</option>
                </select>
                <input type="text" placeholder="spouse" name="spouse" required>
            </div>
            <input type="number" placeholder="Contact number" name='contact_no' required>
        <div class="option">
            <a href="./maternal.php">Cancel</a>
            <button name='addparent'>Add Parent</button>
        </div>
    </form>
</main>
</body>
</html>