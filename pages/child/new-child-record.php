<?php
include '../../db/conn.php';
session_start();
if(!isset($_SESSION['admin'])){
  header('location: ../../auth/login.php');
  exit();
}
$err = "";

if(isset($_POST['addchild'])){
    // get the form data
    $child_first_name = $_POST['child_first_name'];
    $child_middle_name = $_POST['child_middle_name'];
    $child_last_name = $_POST['child_last_name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $birthday = $_POST['birthday'];
    $mother_first_name = $_POST['mother_first_name'];
    $mother_middle_name = $_POST['mother_middle_name'];
    $mother_last_name = $_POST['mother_last_name'];
    $father_first_name = $_POST['father_first_name'];
    $father_middle_name = $_POST['father_middle_name'];
    $father_last_name = $_POST['father_last_name'];

    if(!is_numeric($age) || !is_numeric($height) || !is_numeric($weight)){
        $err = "Invalid input";
    } else {
        $stmt = $con->prepare("INSERT INTO child (child_first_name, child_middle_name, child_last_name, gender, age, height, weight, birthday, mother_first_name, mother_middle_name, mother_last_name, father_first_name, father_middle_name, father_last_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssisssssssss", $child_first_name, $child_middle_name, $child_last_name, $gender, $age, $height, $weight, $birthday, $mother_first_name, $mother_middle_name, $mother_last_name, $father_first_name, $father_middle_name, $father_last_name);
        $stmt->execute();
        $stmt->close();
        header('Location: ./child-record.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./new-child-record.css">
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
        <a href="../../pages/child/child-record.php"  class='active'><i class="fa-solid fa-child"></i> Child Record</a>
        <a href="../../pages/patient/patient.php"><i class="fa-solid fa-hospital-user"></i> Patient</a>
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
    <h1>ADD NEW CHILD</h1>
    <form method='POST'>
            <?php
        if (!empty($err)) {
            echo '<div class="err">' . $err . '</div>';
        }
        ?>
        <label>Child Info</label>
        <div class="two">
            <input type="text" placeholder="Enter first name" name="child_first_name" required>
            <input type="text" placeholder="Enter middle name"  name="child_middle_name" required>
            <input type="text" placeholder="Enter last name"  name="child_last_name" required>
        </div>
        <div class="two">
            <label >Gender</label>
            <select name="gender">
                <option value="male">male</option>
                <option value="female">female</option>
            </select>
            <input type="text" placeholder="Age"  name="age" required>
            <input type="text" placeholder="Height(cm)"  name="height" required>
            <input type="text" placeholder="Weight(kg)"  name="weight" required>
        </div>
        <div class="two">
            <label for="">Birthday</label>
            <input type="date" name="birthday" required>
        </div>
        <label>Mother Info</label>
        <div class="two">
            <input type="text" placeholder="Enter first name"  name="mother_first_name" required>
            <input type="text" placeholder="Enter middle name"  name="mother_middle_name" required>
            <input type="text" placeholder="Enter last name"  name="mother_last_name" required>
        </div>
        <label>Father Info</label>
        <div class="two">
            <input type="text" placeholder="Enter first name"  name="father_first_name" required>
            <input type="text" placeholder="Enter middle name"  name="father_middle_name" required>
            <input type="text" placeholder="Enter last name"  name="father_last_name" required>
        </div>

        <div class="option">
            <a href="./child-record.php">Cancel</a>
            <button name='addchild'>Add Child</button>
        </div>
    </form>
</main>
</body>
</html>