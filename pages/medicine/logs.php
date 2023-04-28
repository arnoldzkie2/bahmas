<?php
include '../../db/conn.php';
session_start();
if(!isset($_SESSION['admin'])){
  header('location: ./auth/login.php');
  exit();
}
include '../../db/conn.php';
$entries = isset($_GET['entries']) ? $_GET['entries'] : 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $entries;
$query = "SELECT * FROM logs LIMIT $start, $entries";
$result = mysqli_query($con, $query);
$total_item = mysqli_num_rows(mysqli_query($con, "SELECT * FROM logs"));
$total_pages = ceil($total_item / $entries);

if(isset($_GET['print'])) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="child.csv"');
      $output = fopen('php://output', 'w');
      $headers = array('ID', 'Patient name','Temperature','Blood pressure', 'Sickness', 'Medicine', 'Quantity', 'Date');
      fputcsv($output, $headers);
      $index = $start + 1;
      $total_data = "select * from logs";
      $result_data = mysqli_query($con, $total_data);
      while($row = mysqli_fetch_assoc($result_data)) {
          $line = array($index,$row['patient_name'],  $row['temperature'], $row['blood_pressure'], $row['sickness'], $row['medicine'], $row['quantity'], $row['date']);
          fputcsv($output, $line);
          $index++;
      }
      fclose($output);
      exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bahmas</title>
    <link rel="stylesheet" href="../../index.css">
    <link rel="stylesheet" href="../../button.css">
    <link rel="stylesheet" href="./inventory.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
<header class='header'>
<img src="../../bahmas.png" alt="">
        <a href="../../index.php"><i class="fa-solid fa-house"></i> Home</a>
        <a href="../../pages/child/child-record.php"><i class="fa-solid fa-child"></i> Child Record</a>
        <a href="../../pages/patient/patient.php"><i class="fa-solid fa-hospital-user" ></i> Patient</a>
        <a href="../../pages/population/population.php"><i class="fa-solid fa-users"></i> Population</a>
        <div class="medicine active" ><i class="fa-solid fa-kit-medical"></i> Medicine
        <i class="fa-solid fa-angle-down"></i><ul>
            <li><a href="./inventory.php">Inventory</a></li>
            <li><a href="./logs.php">Logs</a></li>
        </ul>
</div>
        <a href="../../auth/logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
</header>   
<main class='main-child-record'>
<h1><i class="fa-solid fa-kit-medical" ></i> Medicine Logs</h1>
<div class="content">
    <form class="option">
          <a href="./new-logs.php">Add New</a>
          <button name='print' class='print'>Print</button>
    </form>
<?php

?>
<div class="display">
  <h2>Total number of medicine logs <span><?php echo $total_item ?></span></h2>
  <div class="features">
    <div class="entries">
      Show 
      <select id="entries-select" onchange="changeEntries()">
        <?php for($i=10; $i<=100; $i+=10): ?>
          <option value="<?php echo $i ?>" <?php echo ($entries == $i) ? "selected" : "" ?>><?php echo $i ?></option>
        <?php endfor; ?>
      </select> entries
    </div>
    <div class="search">
      <input type="text" placeholder='Search logs' oninput="filterTable()"><i class="fa-solid fa-magnifying-glass" onclick="filterTable()"></i>
    </div>
  </div>
  <table id="logs-table">
  <thead>
    <tr>
      <th>Patient name</th>
      <th>Temperature</th>
      <th>Blood pressure</th>
      <th>Sickness</th>
      <th>Medicine</th>
      <th>Quantity</th>
      <th>Date</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      $index = $start + 1;
      while($row = mysqli_fetch_assoc($result)): 
        if($row['quantity'] == 0){
            mysqli_query($con, "DELETE FROM inventory WHERE id = {$row['id']}");
            continue; 
        }
    ?>
      <tr>  
        <td class="name" onclick="showChildInfo(<?php echo $row['id']?>)"><?php echo $row['patient_name'] ?></td> <!-- Gender -->
        <td><?php echo $row['temperature'] ?></td> <!-- Gender -->
        <td><?php echo $row['blood_pressure'] ?></td> <!-- Age -->
        <td><?php echo $row['sickness'] ?></td> <!-- Civil status -->
        <td><?php echo $row['medicine'] ?></td> <!-- Birthday -->
        <td><?php echo $row['quantity'] ?></td> <!-- Birthday -->
        <td><?php echo $row['date'] ?></td> <!-- Birthday -->
      </tr>
      <?php $index++; ?>
    <?php endwhile; ?>
  </tbody>
</table>
  <div class="pagination">
    <div>Page <?php echo $page ?> of <?php echo $total_pages ?></div>
    <?php if($page > 1): ?>
      <a href="?entries=<?php echo $entries ?>&page=<?php echo ($page-1) ?>">Previous</a>
    <?php endif; ?>
    <?php if($page < $total_pages): ?>
      <a href="?entries=<?php echo $entries ?>&page=<?php echo ($page+1) ?>">Next</a>
    <?php endif; ?>
  </div>
</div>
<script>
  function changeEntries() {
    var select = document.getElementById("entries-select");
    var entries = select.options[select.selectedIndex].value;
    var urlParams = new URLSearchParams(window.location.search);
    urlParams.set('entries', entries);
    window.location.search = urlParams.toString();
  }
  function filterTable() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.querySelector(".search input");
    filter = input.value.toUpperCase();
    table = document.getElementById("logs-table");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
  function showChildInfo(id){
  window.location.href = `../../routes/medicine/logs-info.php?id=${id}`;
}

</script>
</div>
</main>   
</body>
</html>