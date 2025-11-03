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
  </style>
</head>

<body>
  <div class="form-container">
    <h2>Registration</h2>
    <form action="display.php" method="POST">

      <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" required />
      </div>

      <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" required />
      </div>

      <div class="form-group">
        <label for="address">Address</label>
        <textarea id="address" name="address" required></textarea>
      </div>

      <div class="form-group">
        <label for="country">Country</label>
        <select id="country" name="country" required>
          <option value="">Select Country</option>
          <option value="Egypt">Egypt</option>
          <option value="USA">USA</option>
          <option value="UK">UK</option>
          <option value="Canada">Canada</option>
        </select>
      </div>

      <div class="form-group">
        <label>Gender</label>
        <label><input type="radio" name="gender" value="Male" required /> Male</label>
        <label><input type="radio" name="gender" value="Female" /> Female</label>
      </div>

      <div class="form-group">
        <label>Skills</label>
        <label><input type="checkbox" name="skills[]" value="PHP" /> PHP</label>
        <label><input type="checkbox" name="skills[]" value="J2SE" /> J2SE</label>
        <label><input type="checkbox" name="skills[]" value="MySQL" /> MySQL</label>
      </div>

      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required />
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required />
      </div>

      <div class="form-group">
        <label for="department">Department</label>
        <input type="text" id="department" name="department" placeholder="Open Source" required />
      </div>

      <div class="form-group">
        <label for="divide">gt156</label>
        <input type="text" id="divide" name="divide" />
        <small style="color: #666;">Please Insert the code in the box below</small>
      </div>

      <div class="button-group">
        <button type="submit" class="submit-btn">Submit</button>
        <button type="reset" class="reset-btn">Reset</button>
      </div>

    </form>
  </div>
</body>

</html>