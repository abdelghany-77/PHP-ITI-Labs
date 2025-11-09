<?php
session_start();

$error = "";

if (isset($_SESSION['username'])) {
  header("Location: welcome.php");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST['username']);
  $password = $_POST['password'];

  if (empty($username) || empty($password)) {
    $error = "Please enter both username and password";
  } else {
    if (file_exists('users.txt')) {
      $users = file('users.txt', FILE_IGNORE_NEW_LINES);
      $login_successful = false;

      foreach ($users as $user) {
        $user_data = explode('|', $user);

        if ($user_data[0] == $username && $user_data[2] == $password) {
          $_SESSION['username'] = $username;
          $_SESSION['email'] = $user_data[1];
          $_SESSION['room_number'] = $user_data[3];
          $_SESSION['profile_picture'] = $user_data[4];
          $login_successful = true;
          header("Location: welcome.php");
          exit();
        }
      }

      if (!$login_successful) {
        $error = "Invalid username or password";
      }
    } else {
      $error = "No users registered yet";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Login</title>
  <style>
  body {
    font-family: Arial, sans-serif;
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    background-color: #f4f4f4;
  }

  .container {
    background-color: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  h2 {
    color: #333;
    text-align: center;
  }

  .form-group {
    margin-bottom: 15px;
  }

  label {
    display: block;
    margin-bottom: 5px;
    color: #555;
    font-weight: bold;
  }

  input[type="text"],
  input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
  }

  button {
    width: 100%;
    padding: 12px;
    background-color: #2196F3;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
  }

  button:hover {
    background-color: #0b7dda;
  }

  .error {
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px;
    border-radius: 4px;
    margin-bottom: 15px;
    text-align: center;
  }

  .register-link {
    text-align: center;
    margin-top: 15px;
  }
  </style>
</head>

<body>
  <div class="container">
    <h2>Login</h2>

    <?php if (!empty($error)): ?>
    <div class="error">
      <?php echo $error; ?>
    </div>
    <?php endif; ?>

    <form method="POST" action="">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
      </div>

      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>

      <button type="submit">Login</button>
    </form>

    <div class="register-link">
      Don't have an account? <a href="register.php">Register here</a>
    </div>
  </div>
</body>

</html>