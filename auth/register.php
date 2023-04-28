<?php 
include '../db/conn.php';

if(isset($_POST['register'])){
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $cpass = $_POST['cpass'];
    if(empty($lname) || empty($email) || empty($password) || empty($cpass) || empty($fname) || empty($mname)){
        $err = 'Fill up all the forms!';
    } else if ($password !== $cpass || $cpass !== $password){
        $err = 'Password does not match!';
    } else {
        $emailExist = "select * from child where email='$email'";
        $emailResult = mysqli_query($con, $emailExist);
        if(mysqli_num_rows($emailResult) > 0){
            $err = 'Email already exists!';
        } else {
          $stmt = $con->prepare("insert into child (first_name, middle_name, last_name, email, password) values(?, ?, ?, ?, ?)");
          $stmt->bind_param("sssss", $fname, $mname, $lname, $email, $password);
          $stmt->execute();
          $stmt->close();
            header('location: ./login.php');
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./auth.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOTED</title>
</head>
<body>
<div class="container">
  <h1>BAHMAS</h1>

  <form method='post'>
  <?php if(!empty($err)): ?>
    <div class='err'><?php echo $err; ?></div>
  <?php endif; ?>
      <input type="text" name='fname' required placeholder="Enter first name">
      <input type="text" name='mname' required placeholder="Enter middle name">
      <input type="text" name='lname' required placeholder="Enter last name">
      <input type="email" name='email' required placeholder="Enter email">
      <div class="two">
        <input type="password" name='pass' required placeholder="Create password">
        <input type="password" name='cpass' required placeholder="Confirm password">
      </div>
    <button name='register'>Sign up</button>
    <div class='auth-footer'>Already signed up? <a href="./login.php">Login</a></div>
  </form>
</div>
</body>
</html>
