<?php
if (isset($_GET['delete'])) {
  $lineToDelete = (int)$_GET['delete'];

  if (file_exists("customer.txt")) {
    $lines = file("customer.txt");
    unset($lines[$lineToDelete]);
    file_put_contents("customer.txt", implode("", $lines));
  }
  header("Location: display.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer List</title>
  <style>
  body {
    font-family: Arial, sans-serif;
    max-width: 900px;
    margin: 50px auto;
    padding: 20px;
  }

  .container {
    background: white;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
  }

  h2 {
    text-align: center;
    color: #333;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
  }

  th,
  td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }

  th {
    background-color: #4CAF50;
    color: white;
  }

  tr:hover {
    background-color: #f5f5f5;
  }

  .delete-btn {
    background-color: #f44336;
    color: white;
    padding: 6px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
  }

  .delete-btn:hover {
    background-color: #da190b;
  }

  .back-link {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background: #2196F3;
    color: white;
    text-decoration: none;
    border-radius: 4px;
  }

  .back-link:hover {
    background: #0b7dda;
  }

  .no-data {
    text-align: center;
    padding: 20px;
    color: #666;
  }
  </style>
</head>

<body>
  <div class="container">
    <h2>Customers</h2>

    <?php
    if (file_exists("customer.txt")) {
      $customers = file("customer.txt");

      if (count($customers) > 0) {
        echo '<table>';
        echo '<tr>';
        echo '<th>#</th>';
        echo '<th>First Name</th>';
        echo '<th>Last Name</th>';
        echo '<th>Email</th>';
        echo '<th>Gender</th>';
        echo '<th>Action</th>';
        echo '</tr>';

        foreach ($customers as $index => $customer) {
          $data = explode("|", trim($customer));

          if (count($data) >= 4) {
            echo '<tr>';
            echo '<td>' . ($index + 1) . '</td>';
            echo '<td>' . ($data[0]) . '</td>';
            echo '<td>' . ($data[1]) . '</td>';
            echo '<td>' . ($data[2]) . '</td>';
            echo '<td>' . ($data[3]) . '</td>';
            echo '<td><a href="display.php?delete=' . $index . '" class="delete-btn" onclick="return confirm(\'Are you sure you want to delete this record?\')">Delete</a></td>';
            echo '</tr>';
          }
        }

        echo '</table>';
      } else {
        echo '<div class="no-data">No customer records found.</div>';
      }
    } else {
      echo '<div class="no-data">No customer records yet. Please register first.</div>';
    }
    ?>

    <a href="register.php" class="back-link"> Add New Customer</a>
  </div>
</body>

</html>