<?php
include '../../db/conn.php';
session_start();
if(!isset($_SESSION['admin'])){
  header('location: ../../auth/login.php');
  exit();
}
$err = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
  
    // Query the database to retrieve the row of data that corresponds to the ID
    $query = "SELECT * FROM population WHERE id = $id";
    $result = mysqli_query($con, $query);
  
    // If the query was successful and a row was retrieved, populate the form inputs with the values from the row
    if ($result && mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
    } else {
      $err = "Invalid ID";
    }
  }

  if(isset($_POST['updateperson'])) {
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $purok_name = $_POST['purok_name'];
    $gender = $_POST['gender'];
    $civil_status = $_POST['civil_Status'];
    $age = $_POST['age'];
    $birthdate = $_POST['birthdate'];
    $house_no = $_POST['house_no'];
    $street = $_POST['street'];
    $barangay = $_POST['barangay'];
    $city = $_POST['city'];
  
    // Update the database row with the new data
    $query = "UPDATE population SET first_name='$first_name', middle_name='$middle_name', last_name='$last_name', purok_name='$purok_name', gender='$gender', civil_status='$civil_status', age='$age', birthdate='$birthdate', house_no='$house_no', street='$street', barangay='$barangay', city='$city' WHERE id=$id";
  
    $result = mysqli_query($con, $query);
  
    if($result) {
      header('location: ../../pages/population/population.php');
    } else {
      $err = "Error updating record: " . mysqli_error($con);
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./population.css">
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
        <a href="../../pages/patient/patient.php"><i class="fa-solid fa-hospital-user"></i> Patient</a>
        <a href="../../pages/maternal/maternal.php"><i class="fa-solid fa-person-breastfeeding"></i></i> Maternal</a>
        <a href="../../pages/population/population.php"  class='active'><i class="fa-solid fa-users"></i> Population</a>
        <div class="medicine" ><i class="fa-solid fa-kit-medical"></i> Medicine
        <i class="fa-solid fa-angle-down"></i><ul>
            <li><a href="../../pages/medicine/inventory.php">Inventory</a></li>
            <li><a href="../../pages/medicine/logs.php">Logs</a></li>
        </ul>
</div>
        <a href="../../auth/logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
</header>
<main class='new-child'>
  <h1>POPULATION OPERATION</h1>
  <form method='POST'>
    <?php if (!empty($err)) { ?>
      <div class="err"><?php echo $err; ?></div>
    <?php } ?>
    <label>Person first / middle / last name</label>
    <div class="two">
      <input type="text" placeholder="Enter first name" name="first_name" required value="<?php echo $row['first_name']; ?>">
      <input type="text" placeholder="Enter middle name" name="middle_name" required value="<?php echo $row['middle_name']; ?>">
      <input type="text" placeholder="Enter last name" name="last_name" required value="<?php echo $row['last_name']; ?>">
    </div>
    <div class="two">
      <label for="">Purok name</label>
      <input type="text" placeholder="Enter purok name" name="purok_name" required value="<?php echo $row['purok_name']; ?>">
    </div>
    <br>
        <label for="">Gender / Civil Status / Age</label>
    <div class="two">
      <select name="gender">
        <option value="male" <?php echo ($row['gender'] == 'male') ? 'selected' : ''; ?>>male</option>
        <option value="female" <?php echo ($row['gender'] == 'female') ? 'selected' : ''; ?>>female</option>
      </select>
      <select name="civil_Status">
        <option value="single" <?php echo ($row['civil_status'] == 'single') ? 'selected' : ''; ?>>single</option>
        <option value="married" <?php echo ($row['civil_status'] == 'married') ? 'selected' : ''; ?>>married</option>
        <option value="separated" <?php echo ($row['civil_status'] == 'separated') ? 'selected' : ''; ?>>separated</option>
        <option value="widowed" <?php echo ($row['civil_status'] == 'widowed') ? 'selected' : ''; ?>>widowed</option>
        <option value="never_married" <?php echo ($row['civil_status'] == 'never_married') ? 'selected' : ''; ?>>never_married</option>
      </select>
      <input type="text" placeholder="Age" name="age" required value="<?php echo $row['age']; ?>">
    </div>
    <div class="two">
      <label for="">Birthdate</label>
      <input type="date" name="birthdate" required value="<?php echo $row['birthdate']; ?>">
    </div>
    <br>
    <label for="">Address / house # / street / barangay / city</label>
    <div class="two">
      <input type="text" name="house_no" required placeholder="house #" value="<?php echo $row['house_no']; ?>">
      <input type="text" name="street" required placeholder="street" value="<?php echo $row['street']; ?>">
      <input type="text" name="barangay" required placeholder="barangay" value="<?php echo $row['barangay']; ?>">
      <input type="text" name="city" required placeholder="city" value="<?php echo $row['city']; ?>">
    </div>
    <label for="">Status</label>
            <div class="two">
                <input type="text" name="status" required placeholder="status" value="<?php echo $row['status'] ?>">
            </div>
        <div class="option">
            <a href="./delete-person.php?id=<?php echo $row['id']?>">Delete</a>
            <button name='updateperson'>Update</button>
        </div>
    </form>
</main>
</body>
</html>