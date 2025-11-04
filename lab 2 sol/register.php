<?php
$errors = array();
$firstName = $lastName = $email = $gender = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST['first_name'])) {
    $errors['first_name'] = "First name required";
  } else {
    $firstName = trim($_POST['first_name']);
    if (!preg_match("/^[a-zA-Z ]*$/", $firstName)) {
      $errors['first_name'] = "Only letters  allowed";
    }
  }

  if (empty($_POST['last_name'])) {
    $errors['last_name'] = "Last name is required";
  } else {
    $lastName = trim($_POST['last_name']);
    if (!preg_match("/^[a-zA-Z ]*$/", $lastName)) {
      $errors['last_name'] = "Only letters allowed";
    }
  }

  if (empty($_POST['email'])) {
    $errors['email'] = "Email is required";
  } else {
    $email = trim($_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = "Invalid email ";
    }
  }

  if (empty($_POST['gender'])) {
    $errors['gender'] = "Gender is required";
  } else {
    $gender = $_POST['gender'];
  }

  if (empty($errors)) {
    $data = $firstName . "|" . $lastName . "|" . $email . "|" . $gender . "\n";

    file_put_contents("customer.txt", $data, FILE_APPEND);

    header("Location: display.php");
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registration Form</title>
  <style>
  body {
    font-family: Arial, sans-serif;
    max-width: 500px;
    margin: 50px auto;
    padding: 20px;
  }

  .form-container {
    background: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }

  h2 {
    text-align: center;
    margin-bottom: 20px;
  }

  .form-group {
    margin-bottom: 15px;
  }

  label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
  }

  input[type="text"],
  input[type="email"],
  input[type="password"],
  textarea,
  select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
  }

  textarea {
    resize: vertical;
    min-height: 80px;
  }

  .button-group {
    text-align: center;
    margin-top: 20px;
  }

  button {
    padding: 10px 30px;
    margin: 0 5px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  .submit-btn {
    background: #4caf50;
    color: white;
  }

  .reset-btn {
    background: #f44336;
    color: white;
  }

  .error {
    color: red;
    font-size: 14px;
    margin-top: 5px;
  }

  .success {
    color: green;
    text-align: center;
    margin-bottom: 15px;
  }
  </style>
</head>

<body>
  <div class="form-container">
    <h2>Registration</h2>
    <form action="register.php" method="POST">

      <div class="form-group">
        <label for="first_name">First Name *</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo ($firstName); ?>" />
        <?php if (isset($errors['first_name'])): ?>
        <div class="error"><?php echo $errors['first_name']; ?></div>
        <?php endif; ?>
      </div>

      <div class="form-group">
        <label for="last_name">Last Name *</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo ($lastName); ?>" />
        <?php if (isset($errors['last_name'])): ?>
        <div class="error"><?php echo $errors['last_name']; ?></div>
        <?php endif; ?>
      </div>

      <div class="form-group">
        <label for="email">Email *</label>
        <input type="email" id="email" name="email" value="<?php echo ($email); ?>" />
        <?php if (isset($errors['email'])): ?>
        <div class="error"><?php echo $errors['email']; ?></div>
        <?php endif; ?>
      </div>

      <div class="form-group">
        <label>Gender *</label>
        <label><input type="radio" name="gender" value="Male" <?php if ($gender == "Male") echo "checked"; ?> />
          Male</label>
        <label><input type="radio" name="gender" value="Female" <?php if ($gender == "Female") echo "checked"; ?> />
          Female</label>
        <?php if (isset($errors['gender'])): ?>
        <div class="error"><?php echo $errors['gender']; ?></div>
        <?php endif; ?>
      </div>

      <div class="button-group">
        <button type="submit" class="submit-btn">Submit</button>
        <button type="reset" class="reset-btn">Reset</button>
      </div>

    </form>

    <div style="text-align: center; margin-top: 20px;">
      <a href="display.php" style="text-decoration: none; color: #2196F3;">View All Customers </a>
    </div>
  </div>
</body>

</html>