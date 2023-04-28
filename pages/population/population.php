<?php

session_start();
if(!isset($_SESSION['admin'])){
  header('location: ../../auth/login.php');
  exit();
}

include '../../db/conn.php';
$entries = isset($_GET['entries']) ? $_GET['entries'] : 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $entries;
$query = "SELECT * FROM population LIMIT $start, $entries";
$result = mysqli_query($con, $query);
$total_population = mysqli_num_rows(mysqli_query($con, "SELECT * FROM population"));
$total_pages = ceil($total_population / $entries);

if(isset($_GET['print'])) {
  header('Content-Type: text/csv');
  header('Content-Disposition: attachment; filename="child.csv"');
    $output = fopen('php://output', 'w');
    $headers = array('ID', 'Full Name','Purok name','Gender', 'Age', 'Civil status', 'Address');
    fputcsv($output, $headers);
    $index = $start + 1;
    $total_data = "select * from population";
    $result_data = mysqli_query($con, $total_data);
    while($row = mysqli_fetch_assoc($result_data)) {
        $fullName = $row['first_name'] . " " . $row['middle_name'] . " " . $row['last_name'];
        $address = $row['street'] . " " . $row['barangay'] . " " . $row['city'];
        $line = array($index, $fullName, $row['purok_name'], $row['gender'], $row['age'], $row['civil_status'],$address);
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
    <link rel="stylesheet" href="./population.css">
    <link rel="stylesheet" href="../../button.css">
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
        <a href="../../pages/patient/patient.php"><i class="fa-solid fa-hospital-user"></i> Patient</a>
        <a href="../../pages/population/population.php"  class='active'><i class="fa-solid fa-users"></i> Population</a>
        <div class="medicine" ><i class="fa-solid fa-kit-medical"></i> Medicine
        <i class="fa-solid fa-angle-down"></i><ul>
            <li><a href="../../pages/medicine/inventory.php">Inventory</a></li>
            <li><a href="../../pages/medicine/logs.php">Logs</a></li>
        </ul>
</div>
        <a href="../../auth/logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
</header>
<main class='main-child-record'>
<h1><i class="fa-solid fa-users" ></i> Population</h1>
<div class="content">
    <form class="option">
          <a href="./new-population.php">Add New</a>
          <button name='print' class='print'>Print</button>
    </form>
<?php

?>
<div class="display">
  <h2>Total number of total population <span><?php echo $total_population ?></span></h2>
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
      <input type="text" placeholder='Search person' oninput="filterTable()"><i class="fa-solid fa-magnifying-glass" onclick="filterTable()"></i>
    </div>
  </div>
  <table id="population-table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Full name</th>
      <th>Purok name</th>
      <th>Gender</th>
      <th>Age</th>
      <th>Civil status</th>
      <th>Address</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      $index = $start + 1;
      while($row = mysqli_fetch_assoc($result)): 
    ?>
      <tr>
        <!-- Table Data -->
        <td><?php echo $index ?></td> <!-- # -->
        <td onClick="showChildInfo(<?php echo $row['id']?>)" class='name'><?php echo $row['first_name'] . " " . $row['middle_name'] . " " . $row['last_name'] ?></td> <!-- Patient name -->
        <td><?php echo $row['purok_name']?></td>
        <td><?php echo $row['gender'] ?></td> <!-- Gender -->
        <td><?php echo $row['age'] ?></td> <!-- Age -->
        <td><?php echo $row['civil_status'] ?></td> <!-- Civil status -->
        <td><?php echo $row['street'] . " " . $row['barangay'] . " " . $row['city'] ?></td> <!-- Birthday -->
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
    table = document.getElementById("population-table");
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
  window.location.href = `../../routes/population/population-info.php?id=${id}`;
}

</script>
</div>
</main>
</body>
</html>