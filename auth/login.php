<?php 
session_start();
include '../db/conn.php';
$err = '';
if(isset($_POST['login'])){
  $username = $_POST['username'];
  $pass = $_POST['pass'];

  if($username != "admin" && $pass !== "admin"){
    $err = "Invalid Credentials";
  } else {
    $_SESSION['admin'] = $username;
    header('location: ../index.php');
    exit();
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
      <input type="text" name='username' required placeholder="Username">
      <input type="password" name='pass' required placeholder="Password">
    <button name='login'>Log in</button>
  </form>
</div>
</body>
</html>