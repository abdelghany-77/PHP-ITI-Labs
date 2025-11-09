<?php
require_once 'User.php';
require_once 'FileUploader.php';

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $password = $_POST['password'];
  $room_number = $_POST['room_number'];

  if (empty($username)) {
    $errors[] = "Username is required";
  }

  $user = new User($username, $email, $password, $room_number);

  $emailError = $user->validateEmail();
  if ($emailError) {
    $errors[] = $emailError;
  }

  $passwordError = $user->validatePassword();
  if ($passwordError) {
    $errors[] = $passwordError;
  }

  if (empty($room_number)) {
    $errors[] = "Room number is required";
  }

  $fileUploader = new FileUploader($_FILES['profile_picture']);
  $fileError = $fileUploader->validate();
  if ($fileError) {
    $errors[] = $fileError;
  }

  if (empty($errors)) {
    $uploadedFilename = $fileUploader->upload($username);

    if ($uploadedFilename) {
      $user->setProfilePicture($uploadedFilename);
      $user->save();
      $success = "Registration successful! You can now <a href='login.php'>login</a>";
    } else {
      $errors[] = "Failed to upload profile picture";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Add User </title>
  <style>
  body {
    font-family: Arial, sans-serif;
    max-width: 500px;
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
  input[type="email"],
  input[type="password"],
  select,
  input[type="file"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
  }

  button {
    width: 100%;
    padding: 12px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
  }

  button:hover {
    background-color: #45a049;
  }

  .error {
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px;
    border-radius: 4px;
    margin-bottom: 15px;
  }

  .success {
    background-color: #d4edda;
    color: #155724;
    padding: 10px;
    border-radius: 4px;
    margin-bottom: 15px;
  }

  .login-link {
    text-align: center;
    margin-top: 15px;
  }
  </style>
</head>

<body>
  <div class="container">
    <h2>User Registration</h2>

    <?php if (!empty($errors)): ?>
    <div class="error">
      <ul style="margin: 0; padding-left: 20px;">
        <?php foreach ($errors as $error): ?>
        <li><?php echo $error; ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
    <div class="success">
      <?php echo $success; ?>
    </div>
    <?php endif; ?>

    <form method="POST" action="" enctype="multipart/form-data">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username"
          value="<?php echo isset($_POST['username']) ? ($_POST['username']) : ''; ?>">
      </div>

      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"
          value="<?php echo isset($_POST['email']) ? ($_POST['email']) : ''; ?>">
      </div>

      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
      </div>

      <div class="form-group">
        <label for="room_number">Room Number:</label>
        <select id="room_number" name="room_number">
          <option value="">Select Room</option>
          <option value="Application1"
            <?php echo (isset($_POST['room_number']) && $_POST['room_number'] == 'Application1') ? 'selected' : ''; ?>>
            Application1</option>
          <option value="Application2"
            <?php echo (isset($_POST['room_number']) && $_POST['room_number'] == 'Application2') ? 'selected' : ''; ?>>
            Application2</option>
          <option value="cloud"
            <?php echo (isset($_POST['room_number']) && $_POST['room_number'] == 'cloud') ? 'selected' : ''; ?>>Cloud
          </option>
        </select>
      </div>

      <div class="form-group">
        <label for="profile_picture">Profile Picture:</label>
        <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
      </div>

      <button type="submit">Register</button>
    </form>

    <div class="login-link">
      Already have an account? <a href="login.php">Login here</a>
    </div>
  </div>
</body>

</html>