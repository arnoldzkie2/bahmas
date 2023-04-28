<?php
include '../../db/conn.php';
session_start();
if(!isset($_SESSION['admin'])){
  header('location: ../../auth/login.php');
  exit();
}
$err = "";

if(isset($_GET['id'])){
    $id = $_GET['id'];

    // Get the row with the specified id from the inventory table
    $stmt = $con->prepare("SELECT * FROM inventory WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows === 1) {
        $row = $result->fetch_assoc();
    } else {
        $err = "Error: No record found with the specified ID.";
    }
}

if(isset($_POST['updateitem'])){
    $item = $_POST['item'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $arrival = $_POST['arrival'];
    $expiry = $_POST['expiry'];
    $stmt = $con->prepare("UPDATE inventory SET item = ?, description = ?, quantity = ?, arrival = ?, expiry = ? WHERE id = ?");
    $stmt->bind_param("ssissi", $item, $description, $quantity, $arrival, $expiry, $id);
    if ($stmt->execute()) {
        header("location: ../../pages/medicine/inventory.php");
        exit();
    } else {
        $err = "Error: Failed to update item.";
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
    <h1>EDIT MEDICINE</h1>
    <form method='POST'>
            <?php
        if (!empty($err)) {
            echo '<div class="err">' . $err . '</div>';
        }
        ?>
        <div class="two">
            <input type="text" placeholder="Item name" name="item" value="<?php echo $row['item'] ?>" required>
            <input type="text" name="description" value="<?php echo $row['description'] ?>" required placeholder="Description">
        </div>
        <label for="">Quantity / Arrival / Expiry</label>
            <div class="two">
                <input type="text" name="quantity" value="<?php echo $row['quantity'] ?>" required placeholder="Quantity">
                <input type="date" name="arrival" value="<?php echo $row['arrival'] ?>" required >
                <input type="date" name="expiry" value="<?php echo $row['expiry'] ?>" required >
            </div>
        <div class="option">
            <a href="./delete-item.php?id=<?php echo $row['id']?>">Delete</a>
            <button name='updateitem'>Update</button>
        </div>
    </form>
</main>
</body>
</html>