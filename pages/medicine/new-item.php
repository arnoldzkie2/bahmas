<?php
include '../../db/conn.php';
session_start();
if(!isset($_SESSION['admin'])){
  header('location: ../../auth/login.php');
  exit();
}
$err = "";

if(isset($_POST['additem'])) {
    $item = $_POST['item'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $arrival = $_POST['arrival'];
    $expiry = $_POST['expiry'];

    // Prepare the SQL statement
    $stmt = $con->prepare("INSERT INTO inventory (item, description, quantity, arrival, expiry) VALUES (?, ?, ?, ?, ?)");
    // Bind parameters to statement
    $stmt->bind_param("ssiss", $item, $description, $quantity, $arrival, $expiry);
    // Execute the statement
    if($stmt->execute()) {
        header('location: ./inventory.php');
        exit();
    } else {
        $err = "Error adding item to inventory.";
    }
    // Close the statement and connection
    $stmt->close();
    $conn->close();
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
        <a href="../../pages/maternal/maternal.php"><i class="fa-solid fa-person-breastfeeding"></i></i> Maternal</a>
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
    <h1>ADD NEW MEDICINE</h1>
    <form method='POST'>
            <?php
        if (!empty($err)) {
            echo '<div class="err">' . $err . '</div>';
        }
        ?>
        <div class="two">
            <input type="text" placeholder="Item name" name="item" required>
            <input type="text" name="description" required placeholder="Description">
        </div>
        <label for="">Quantity / Arrival / Expiry</label>
            <div class="two">
                <input type="text" name="quantity" required placeholder="Quantity">
                <input type="date" name="arrival" required >
                <input type="date" name="expiry" required >
            </div>
        <div class="option">
            <a href="./inventory.php">Cancel</a>
            <button name='additem'>Add Item</button>
        </div>
    </form>
</main>
</body>
</html>