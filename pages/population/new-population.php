<?php
include '../../db/conn.php';
session_start();
if(!isset($_SESSION['admin'])){
  header('location: ../../auth/login.php');
  exit();
}
$err = "";

if(isset($_POST['addperson'])){
    // prepare and bind statement
    $stmt = $con->prepare("INSERT INTO population (purok_name, first_name, middle_name, last_name, gender, age, civil_status, house_no, street, barangay, city, birthdate, status, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("sssssisssssss", $purok_name, $first_name, $middle_name, $last_name, $gender, $age, $civil_status, $house_no, $street, $barangay, $city, $birthdate, $status);

    // set parameters and execute statement
    $purok_name = $_POST['purok_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $civil_status = $_POST['civil_Status'];
    $house_no = $_POST['house_no'];
    $street = $_POST['street'];
    $barangay = $_POST['barangay'];
    $city = $_POST['city'];
    $birthdate = $_POST['birthdate'];
    $status = $_POST['status'];

    if ($stmt->execute()) {
        // success message
        header('location: ./population.php');
        exit();
    } else {
        // error message
        echo "Error: " . $stmt->error;
    }

    // close statement and connection
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./new-population.css">
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
        <a href="../../pages/patient/patient.php"><i class="fa-solid fa-hospital-user"></i> Patient</a>
        <a href="../../pages/maternal/maternal.php"><i class="fa-solid fa-person-breastfeeding"></i></i> Maternal</a>
        <a href="./population.php"  class='active'><i class="fa-solid fa-users"></i> Population</a>
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
        <label>Person Info</label>
        <div class="two">
            <input type="text" placeholder="Enter first name" name="first_name" required>
            <input type="text" placeholder="Enter middle name"  name="middle_name" required>
            <input type="text" placeholder="Enter last name"  name="last_name" required>
        </div>
        <div class="two">
            <label for="">Purok name</label>
            <input type="text" placeholder="Enter purok name"  name="purok_name" required>
        </div>
        <br>
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
            <input type="text" placeholder="Age"  name="age" required>
        </div>
        <div class="two">
            <label for="">Birthdate</label>
            <input type="date" name="birthdate" required>
        </div>
        <br>
        <label for="">Address</label>
        <div class="two">
            <input type="text" name="house_no" required placeholder="house #">
            <input type="text" name="street" required placeholder="street">
            <input type="text" name="barangay" required placeholder="barangay">
            <input type="text" name="city" required placeholder="city">
        </div>
            <div class="two">
                <input type="text" name="status" required placeholder="status">
            </div>
        <div class="option">
            <a href="./population.php">Cancel</a>
            <button name='addperson'>Add Person</button>
        </div>
    </form>
</main>
</body>
</html>