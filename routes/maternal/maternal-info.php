<?php
include '../../db/conn.php';
session_start();
if(!isset($_SESSION['admin'])){
  header('location: ../../auth/login.php');
  exit();
}

$id = $_GET['id'];
$err = "";

if(isset($_POST['update'])){
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
    
    $sql = "UPDATE maternal SET 
            first_name='$first_name', 
            middle_name='$middle_name', 
            last_name='$last_name', 
            address='$address', 
            spouse='$spouse', 
            contact_no='$contact_no', 
            civil_status='$civil_status', 
            birthdate='$birthdate', 
            age='$age', 
            blood_pressure='$blood_pressure', 
            weight='$weight', 
            last_period='$last_period', 
            month_pregnancy='$month_pregnancy', 
            month_delivery='$month_delivery', 
            date='$date' 
            WHERE id=$id";
    if ($con->query($sql) === TRUE) {
        header('location: ../../pages/maternal/maternal.php');
        exit();
    } else {
        echo "Error updating maternal record: " . $con->error;
    }
    $con->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./maternal.css">
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
    <h1>PARENT OPERATIONS</h1>
    <form method='POST'>
            <?php
        if (!empty($err)) {
            echo '<div class="err">' . $err . '</div>';
        }

        $sql = "SELECT * FROM maternal where id='$id'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>
        <label>Parent Info / First name / Middle name / Last name</label>
        <div class="two">
            <input type="text" placeholder="Enter first name" name="first_name" required value="<?php echo $row['first_name']?>">
            <input type="text" placeholder="Enter middle name"  name="middle_name" required value="<?php echo $row['middle_name']?>">
            <input type="text" placeholder="Enter last name"  name="last_name" required value="<?php echo $row['last_name']?>">
        </div>
        <label for="">Age / Blood pressure / Weight</label>
        <div class="two">
            <input type="text" placeholder="Age"  name="age" required value="<?php echo $row['age']?>">
            <input type="text" placeholder="Blood pressure"  name="blood_pressure" required value="<?php echo $row['blood_pressure']?>">
            <input type="text" placeholder="Weight"  name="weight" required value="<?php echo $row['weight']?>">
        </div>
            <label for="">Address</label>
            <input type="text" name="address" required placeholder="Address" value="<?php echo $row['address']?>">
            <div class="two">
                <label for="">Birthdate</label>
                <input type="date" required name="birthdate" value="<?php echo $row['birthdate']?>">
            </div>
            <br>
            <label for="">Last period / Month of pregnancy / Month of delivery / Date</label>
            <div class="two">
                <input type="date" name="last_period" required value="<?php echo $row['last_period']?>">
                <input type="date" name="month_pregnancy" required value="<?php echo $row['month_pregnancy']?>">
                <input type="date" name="month_delivery" required value="<?php echo $row['month_delivery']?>">
                <input type="date" name="date" required value="<?php echo $row['date']?>"> 
            </div>
            <label for=""> Civil Status / Spouse</label>
            <div class="two">
                <select name="civil_status">
                    <option value="single" <?php if($row['civil_status'] == 'single') echo "selected"; ?> >single</option>
                    <option value="married" <?php if($row['civil_status'] == 'married') echo "selected"; ?>>married</option>
                    <option value="divorced" <?php if($row['civil_status'] == 'divorced') echo "selected"; ?>>divorced</option>
                    <option value="separated" <?php if($row['civil_status'] == 'separated') echo "selected"; ?>>separated</option>
                    <option value="widowed" <?php if($row['civil_status'] == 'widowed') echo "selected"; ?>>widowed</option>
                </select>
                <input type="text" placeholder="spouse" name="spouse" required value="<?php echo $row['spouse']?>">
            </div>
            <label for="">Contact number</label>
            <input type="number" placeholder="Contact number" name='contact_no' required value="<?php echo $row['contact_no']?>">
        <div class="option">
            <a href="./delete-maternal.php?id=<?php echo $id = $_GET['id']?>">Delete</a>
            <button name='update'>Update</button>
        </div>
    </form>
</main>
</body>
</html>