<?php
include '../../db/conn.php';
session_start();
if(!isset($_SESSION['admin'])){
  header('location: ../../auth/login.php');
  exit();
}
$err = "";
if(isset($_POST['addlogs'])){

    // Get input data from form
    $patient_name = $_POST['patient_name'];
    $sickness = $_POST['sickness'];
    $temperature = $_POST['temperature'];
    $blood_pressure = $_POST['blood_pressure'];
    $date = $_POST['date'];
    $medicine = $_POST['medicine'];
    $quantity = $_POST['quantity'];

    // Check if medicine is in inventory and has enough quantity
    $inventory_query = "SELECT quantity FROM inventory WHERE item = '$medicine'";
    $inventory_result = mysqli_query($con, $inventory_query);
    $inventory_row = mysqli_fetch_assoc($inventory_result);
    $inventory_quantity = $inventory_row['quantity'];

    if($inventory_quantity >= $quantity){
        // Add new log entry to database
        $query = "INSERT INTO logs (patient_name, sickness, temperature, blood_pressure, date, medicine, quantity) 
                VALUES ('$patient_name', '$sickness', '$temperature', '$blood_pressure', '$date', '$medicine', '$quantity')";
        mysqli_query($con, $query);

        // Update inventory quantity
        $new_inventory_quantity = $inventory_quantity - $quantity;
        $inventory_update_query = "UPDATE inventory SET quantity = '$new_inventory_quantity' WHERE item = '$medicine'";
        mysqli_query($con, $inventory_update_query);
        // Redirect to logs page
        header('location: ./logs.php');
        exit();
    } else {
        $err = "Not enough quantity in inventory for $medicine";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./new-item.css">
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
    <h1>ADD NEW MEDICINE LOGS</h1>
    <form method='POST'>
            <?php
        if (!empty($err)) {
            echo '<div class="err">' . $err . '</div>';
        }
        ?>
        <div class="two">
            <input type="text" placeholder="Patient full name" name="patient_name" required>
            <input type="text" name="sickness" required placeholder="sickness">
        </div>
            <div class="two">
                <input type="text" name="temperature" required placeholder="Temperature">
                <input type="text" name="blood_pressure" required placeholder="Blood pressure">
                <input type="date" name="date" required>
            </div>
            <div class="two">
                <input type="text" name="medicine" required placeholder="Medicine">
                <input type="text" name="quantity" required placeholder="Quantity">
            </div>   
        <div class="option">
            <a href="./logs.php">Cancel</a>
            <button name='addlogs'>Add Logs</button>
        </div>
    </form>
</main>
</body>
</html>