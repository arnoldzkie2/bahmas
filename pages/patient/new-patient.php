<?php
include '../../db/conn.php';
session_start();
if(!isset($_SESSION['admin'])){
  header('location: ../../auth/login.php');
  exit();
}
$err = "";

if(isset($_POST['addpatient'])) {
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $civil_status = $_POST['civil_Status'];
    $birthday = $_POST['birthday'];
    $birthplace = $_POST['birthplace'];
    $address = $_POST['address'];
    $contact_number = $_POST['contactno'];
    $weight = $_POST['weight'];
    $temperature = $_POST['temperature'];
    $blood_pressure = $_POST['blood_pressure'];
    $blood_type = $_POST['blood_Type'];
    $sickness = $_POST['sickness'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    $sql = "INSERT INTO patient (first_name, middle_name, last_name, age, gender, civil_status, birthday, birthplace, address, contact_number, weight, temperature, blood_pressure, blood_type, sickness, date, status) 
            VALUES ('$first_name', '$middle_name', '$last_name', '$age', '$gender', '$civil_status', '$birthday', '$birthplace', '$address', '$contact_number', '$weight', '$temperature', '$blood_pressure', '$blood_type', '$sickness', '$date', '$status')";
    if(mysqli_query($con, $sql)){
        header('Location: ./patient.php');
        exit();
    } else{
        $err = "Error: " . mysqli_error($con);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./new-patient.css">
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
        <a href="../../pages/child/child-record.php"><i class="fa-solid fa-child"></i> Child Record</a>
        <a href="./patient.php"  class='active'><i class="fa-solid fa-hospital-user"></i> Patient</a>
        <a href="../../pages/maternal/maternal.php"><i class="fa-solid fa-person-breastfeeding"></i></i> Maternal</a>
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
    <h1>ADD NEW PATIENT</h1>
    <form method='POST'>
            <?php
        if (!empty($err)) {
            echo '<div class="err">' . $err . '</div>';
        }
        ?>
        <label>Patient Info</label>
        <div class="two">
            <input type="text" placeholder="Enter first name" name="first_name" required>
            <input type="text" placeholder="Enter middle name"  name="middle_name" required>
            <input type="text" placeholder="Enter last name"  name="last_name" required>
        </div>
        <div class="two">
            <label >Gender</label>
            <select name="gender">
                <option value="male">male</option>
                <option value="female">female</option>
            </select>
            <label for="">Civil Status</label>
            <select name="civil_Status">
                <option value="single">single</option>
                <option value="married">married</option>
                <option value="separated">separated</option>
                <option value="widowed">widowed</option>
                <option value="never_married">never_married</option>
            </select>
        </div>
            <div class="two">
                <input type="text" placeholder="Age"  name="age" required>
                <input type="text" placeholder="Height(cm)"  name="height" required>
                <input type="text" placeholder="Weight(kg)"  name="weight" required>
            </div>
        <div class="two">
            <label for="">Birthday</label>
            <input type="date" name="birthday" required>
        </div>
            <input type="text" name="birthplace" required placeholder="Enter birth place">
            <input type="text" name="address" required placeholder="Enter Address">
            <input type="number" name="contactno" required placeholder="Enter mobile contact number">
            <div class="two">
                <input type="text" name="temperature" required placeholder="Temperature">
                <input type="text" name="blood_pressure" required placeholder="Blood pressure">
                <input type="text" name="blood_Type" required placeholder="Blood type">
            </div>
            <div class="two">
                <input type="text" name="sickness" required placeholder="Sickness">
                <input type="date" name="date" required placeholder="Date">
                <input type="text" name="status" required placeholder="status">
            </div>
        <div class="option">
            <a href="./patient.php">Cancel</a>
            <button name='addpatient'>Add Child</button>
        </div>
    </form>
</main>
</body>
</html>