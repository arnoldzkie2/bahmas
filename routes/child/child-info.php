<?php
session_start();
include '../../db/conn.php';
if(!isset($_SESSION['admin'])){
  header('location: ../../auth/login.php');
  exit();
}

$id = $_GET['id'];

if(isset($_POST['updatechild'])){
    // Get form data
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
        $stmt = $con->prepare("UPDATE child SET child_first_name=?, child_middle_name=?, child_last_name=?, gender=?, age=?, height=?, weight=?, birthday=?, mother_first_name=?, mother_middle_name=?, mother_last_name=?, father_first_name=?, father_middle_name=?, father_last_name=? WHERE id=?");
    
        // Bind the parameters to the statement
        $stmt->bind_param("ssssisssssssssi", $child_first_name, $child_middle_name, $child_last_name, $gender, $age, $height, $weight, $birthday, $mother_first_name, $mother_middle_name, $mother_last_name, $father_first_name, $father_middle_name, $father_last_name, $id);
    
        // Execute the statement
        if($stmt->execute()){
            header('location: ../../pages/child/child-record.php');
            exit();
        } else {
            $err = "Error updating record: " . $con->error;
        }
    }

}

// Prepare the SQL statement
$stmt = $con->prepare("SELECT * FROM child WHERE id = ?");

// Bind the parameter to the statement
$stmt->bind_param("i", $id);

// Execute the statement
$stmt->execute();

// Get the result set from the statement
$result = $stmt->get_result();

// Fetch the row as an associative array
$row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="./child-info.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bahmas</title>
</head>
<body>
<header class='header'>
        <a href="../../index.php"><i class="fa-solid fa-house"></i> Home</a>
        <a href="../../pages/child/child-record.php"  class='active'><i class="fa-solid fa-child"></i> Child Record</a>
        <a href="../../pages/patient/patient.php"><i class="fa-solid fa-hospital-user"></i> Patient</a>
        <a href="../../pages/population/population.php"><i class="fa-solid fa-users"></i> Population</a>
        <div class="medicine" ><i class="fa-solid fa-kit-medical"></i> Medicine
        <i class="fa-solid fa-angle-down"></i><ul>
            <li><a href="../../pages/medicine/inventory.php">Inventory</a></li>
            <li><a href="../../pages/medicine/logs.php">Logs</a></li>
        </ul>
</div>        <a href="../..//auth/logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
</header>
<main class='new-child'>
    <h1>CHILD OPERATIONS</h1>
    <form method='POST'>
            <?php
        if (!empty($err)) {
            echo '<div class="err">' . $err . '</div>';
        }
        ?>
        <label>Child first / middle / last name</label>
        <div class="two">
            <input type="text" placeholder="Enter first name" name="child_first_name" value="<?php echo $row['child_first_name']; ?>" required>
            <input type="text" placeholder="Enter middle name"  name="child_middle_name" value="<?php echo $row['child_middle_name']; ?>" required>
            <input type="text" placeholder="Enter last name"  name="child_last_name" value="<?php echo $row['child_last_name']; ?>" required>
        </div>
        <div class="two">
            <label >Gender</label>
            <select name="gender">
                <option value="male" <?php if($row['gender'] == 'male') echo 'selected'; ?>>male</option>
                <option value="female" <?php if($row['gender'] == 'female') echo 'selected'; ?>>female</option>
            </select>
            <label for="">Birthday</label>
            <input type="date" name="birthday" value="<?php echo $row['birthday']; ?>" required>
        </div>
        <br>
        <label for="">Age / Height(cm) / Weight(kg)</label>
        <div class="two">
            <input type="text" placeholder="Age"  name="age" value="<?php echo $row['age']; ?>" required>
            <input type="text" placeholder="Height(cm)"  name="height" value="<?php echo $row['height']; ?>" required>
            <input type="text" placeholder="Weight(kg)"  name="weight" value="<?php echo $row['weight']; ?>" required>
        </div>
        <label>Mother first / middle / last name</label>
        <div class="two">
            <input type="text" placeholder="Enter first name"  name="mother_first_name" value="<?php echo $row['mother_first_name']; ?>" required>
            <input type="text" placeholder="Enter middle name"  name="mother_middle_name" value="<?php echo $row['mother_middle_name']; ?>" required>
            <input type="text" placeholder="Enter last name"  name="mother_last_name" value="<?php echo $row['mother_last_name']; ?>" required>
        </div>
        <label>Father first / middle / last name</label>
        <div class="two">
            <input type="text" placeholder="Enter first name"  name="father_first_name" value="<?php echo $row['father_first_name']; ?>" required>
            <input type="text" placeholder="Enter middle name"  name="father_middle_name" value="<?php echo $row['father_middle_name']; ?>" required>
            <input type="text" placeholder="Enter last name"  name="father_last_name" value="<?php echo $row['father_last_name']; ?>" required>
        </div>
        <div class="option">
            <a href="./delete-child.php?id=<?php echo $row['id'] ?>">Delete</a>
            <button name='updatechild'>Update</button>
        </div>
    </form>
</main>

</body>
</html>