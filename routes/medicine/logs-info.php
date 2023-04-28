<?php
include '../../db/conn.php';
session_start();
if(!isset($_SESSION['admin'])){
  header('location: ../../auth/login.php');
  exit();
}
$err = "";

$id = $_GET['id'];

if (isset($_POST['update'])) {
    $patient_name = $_POST['patient_name'];
    $sickness = $_POST['sickness'];
    $temperature = $_POST['temperature'];
    $blood_pressure = $_POST['blood_pressure'];
    $date = $_POST['date'];
    $medicine = $_POST['medicine'];
    $quantity = $_POST['quantity'];

    $sql = "UPDATE logs SET patient_name=?, sickness=?, temperature=?, blood_pressure=?, date=?, medicine=?, quantity=? WHERE id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssssssi", $patient_name, $sickness, $temperature, $blood_pressure, $date, $medicine, $quantity, $id);
    if ($stmt->execute()) {
        header("location: ../../pages/medicine/logs.php");
        exit();
    } else {
        $err = "Failed to update data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./inventory.css">
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
        <a href="./patient.php"><i class="fa-solid fa-hospital-user"></i> Patient</a>
        <a href="../../pages/population/population.php"><i class="fa-solid fa-users"></i> Population</a>
        <div class="medicine active" ><i class="fa-solid fa-kit-medical"></i> Medicine
        <i class="fa-solid fa-angle-down"></i><ul>
            <li><a href="../../pages/medicine/inventory.php">Inventory</a></li>
            <li><a href="../../pages/medicine/logs.php">Logs</a></li>
        </ul>
</div>
        <a href="../../auth/logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
</header>
<main class='new-child'>
    <h1>MEDICINE LOGS OPERATION</h1>
    <form method='POST'>
    <?php
        if (!empty($err)) {
            echo '<div class="err">' . $err . '</div>';
        }
        // fetch data from the database
        $sql = "SELECT * FROM logs WHERE id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
    <label for="">Patient full name / Sickness</label>
    <div class="two">
        <input type="text" placeholder="Patient full name" name="patient_name" required value="<?php echo $row['patient_name']; ?>">
        <input type="text" name="sickness" required placeholder="sickness" value="<?php echo $row['sickness']; ?>">
    </div>
    <label for="">Temperature / Blood pressure / Date</label>
    <div class="two">
        <input type="text" name="temperature" required placeholder="Temperature" value="<?php echo $row['temperature']; ?>">
        <input type="text" name="blood_pressure" required placeholder="Blood pressure" value="<?php echo $row['blood_pressure']; ?>">
        <input type="date" name="date" required value="<?php echo $row['date']; ?>">
    </div>
    <label for="">Medicine name / Quantity</label>
    <div class="two">
        <input type="text" name="medicine" required placeholder="Medicine" value="<?php echo $row['medicine']; ?>">
        <input type="text" name="quantity" required placeholder="Quantity" value="<?php echo $row['quantity']; ?>">
    </div>   
    <div class="option">
        <a href="./delete-logs.php?id=<?php echo $row['id']; ?>">Delete</a>
        <button name='update'>Update</button>
    </div>
    <?php } ?>
</form>
</main>
</body>
</html>