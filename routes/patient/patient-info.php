<?php
include '../../db/conn.php';
session_start();
if(!isset($_SESSION['admin'])){
  header('location: ../../auth/login.php');
  exit();
}
$err = "";

$id = $_GET['id'];
// fetch patient data from database with ID 1
$stmt = $con->prepare("SELECT * FROM patient WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (isset($_POST['updatepatient'])) {
    $id = $_GET['id'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $civil_status = $_POST['civil_status'];
    $age = $_POST['age'];
    $weight = $_POST['weight'];
    $birthday = $_POST['birthday'];
    $birthplace = $_POST['birthplace'];
    $address = $_POST['address'];
    $contact_number = $_POST['contactno'];
    $temperature = $_POST['temperature'];
    $blood_pressure = $_POST['blood_pressure'];
    $blood_type = $_POST['blood_Type'];
    $sickness = $_POST['sickness'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    $sql = "UPDATE patient SET first_name='$first_name', middle_name='$middle_name', last_name='$last_name', gender='$gender', civil_status='$civil_status', age='$age', weight='$weight', birthday='$birthday', birthplace='$birthplace', address='$address', contact_number='$contact_number', temperature='$temperature', blood_pressure='$blood_pressure', blood_type='$blood_type', sickness='$sickness', date='$date', status='$status' WHERE id=$id";

    if ($con->query($sql) === TRUE) {
        header("Location: ../../pages/patient/patient.php");
        exit();
    } else {
        $err = "Error updating record: " . $conn->error;
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./patient.css">
    <link rel="stylesheet" href="../../index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bahmas</title>
</head>
<body>
<header class='header'>
        <a href="../../index.php"><i class="fa-solid fa-house"></i> Home</a>
        <a href="../../pages/child/child-record.php"><i class="fa-solid fa-child"></i> Child Record</a>
        <a href="../../pages/patient/patient.php"  class='active'><i class="fa-solid fa-hospital-user"></i> Patient</a>
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
    <h1>PATIENT OPERATIONS</h1>
    <form method='POST'>
            <?php
        if (!empty($err)) {
            echo '<div class="err">' . $err . '</div>';
        }
        ?>
        <label for="">Patient first / middle / last name</label>
        <div class="two">
    <input type="text" placeholder="Enter first name" name="first_name" required value="<?php echo $row['first_name']; ?>">
    <input type="text" placeholder="Enter middle name"  name="middle_name" required value="<?php echo $row['middle_name']; ?>">
    <input type="text" placeholder="Enter last name"  name="last_name" required value="<?php echo $row['last_name']; ?>">
</div>
<div class="two">
    <label>Gender</label>
    <select name="gender">
        <option value="male" <?php if($row['gender'] == 'male') echo 'selected'; ?>>male</option>
        <option value="female" <?php if($row['gender'] == 'female') echo 'selected'; ?>>female</option>
    </select>
    <label for="">Civil Status</label>
    <select name="civil_status">
        <option value="single" <?php if($row['civil_status'] == 'single') echo 'selected'; ?>>single</option>
        <option value="married" <?php if($row['civil_status'] == 'married') echo 'selected'; ?>>married</option>
        <option value="separated" <?php if($row['civil_status'] == 'separated') echo 'selected'; ?>>separated</option>
        <option value="widowed" <?php if($row['civil_status'] == 'widowed') echo 'selected'; ?>>widowed</option>
        <option value="never_married" <?php if($row['civil_status'] == 'never_married') echo 'selected'; ?>>never married</option>
    </select>
</div>
<br>
<label for="">Age / Weight(kg)</label>
<div class="two">
    <input type="text" placeholder="Age"  name="age" required value="<?php echo $row['age']; ?>">
    <input type="text" placeholder="Weight(kg)"  name="weight" required value="<?php echo $row['weight']; ?>">
</div>
<div class="two">
    <label for="">Birthday</label>
    <input type="date" name="birthday" required value="<?php echo $row['birthday']; ?>">
</div>
<label for="">Birthplace</label>
<input type="text" name="birthplace" required placeholder="Enter birth place" value="<?php echo $row['birthplace']; ?>">
<label for="">Address</label>
<input type="text" name="address" required placeholder="Enter Address" value="<?php echo $row['address']; ?>">
<label for="">Contact Number</label>
<input type="text" name="contactno" required placeholder="Enter mobile contact number" value="<?php echo $row['contact_number']; ?>">
<label for="">Temperature / Blood pressure / Blood type</label>
<div class="two">
    <input type="text" name="temperature" required placeholder="Temperature" value="<?php echo $row['temperature']; ?>">
    <input type="text" name="blood_pressure" required placeholder="Blood pressure" value="<?php echo $row['blood_pressure']; ?>">
    <input type="text" name="blood_Type" required placeholder="Blood type" value="<?php echo $row['blood_type']; ?>">
</div>
<label for="">Sickness / Date / Status</label>
            <div class="two">
                <input type="text" name="sickness" required placeholder="Sickness" value="<?php echo $row['sickness']?>">
                <input type="date" name="date" required placeholder="Date" value="<?php echo $row['date']?>">
                <input type="text" name="status" required placeholder="status" value="<?php echo $row['status']?>">
            </div>
        <div class="option">
            <a href="./delete-patient.php?id=<?php echo $row['id']?>">Delete</a>
            <button name='updatepatient'>Update</button>
        </div>
    </form>
</main>
</body>
</html>