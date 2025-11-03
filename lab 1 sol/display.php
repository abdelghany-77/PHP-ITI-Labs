<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Display</title>
  <style>
  body {
    font-family: Arial, sans-serif;
    max-width: 600px;
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

  .info {
    margin: 10px 0;
  }

  .label {
    font-weight: bold;
  }

  a {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background: #2196F3;
    color: white;
    text-decoration: none;
    border-radius: 4px;
  }
  </style>
</head>

<body>
  <div class="container">
    <h2>Registration Info</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $firstName = htmlspecialchars($_POST['first_name']);
      $lastName = htmlspecialchars($_POST['last_name']);
      $address = htmlspecialchars($_POST['address']);
      $country = htmlspecialchars($_POST['country']);
      $gender = htmlspecialchars($_POST['gender']);
      $username = htmlspecialchars($_POST['username']);
      $department = htmlspecialchars($_POST['department']);
      $code = htmlspecialchars($_POST['divide']);

      $skills = 'None';
      if (isset($_POST['skills']) && is_array($_POST['skills'])) {
        $skills = implode(', ', $_POST['skills']);
      }
    ?>

    <div class="info">
      <span class="label">Name:</span>
      <?php echo $firstName . ' ' . $lastName; ?>
    </div>

    <div class="info">
      <span class="label">Address:</span>
      <?php echo ($address); ?>
    </div>

    <div class="info">
      <span class="label">Country:</span>
      <?php echo $country; ?>
    </div>

    <div class="info">
      <span class="label">Gender:</span>
      <?php echo $gender; ?>
    </div>

    <div class="info">
      <span class="label">Skills:</span>
      <?php echo $skills; ?>
    </div>

    <div class="info">
      <span class="label">Username:</span>
      <?php echo $username; ?>
    </div>

    <div class="info">
      <span class="label">Department:</span>
      <?php echo $department; ?>
    </div>

    <div class="info">
      <span class="label">code:</span>
      <?php echo $code; ?>
    </div>

    <?php
    } else {
      echo '<p>No data received.</p>';
    }
    ?>

    <a href="register.php">← Back</a>
  </div>
</body>

</html>