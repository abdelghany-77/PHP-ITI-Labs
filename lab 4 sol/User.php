<?php

class User
{
  private $username;
  private $email;
  private $password;
  private $roomNumber;
  private $profilePicture;

  public function __construct($username = '', $email = '', $password = '', $roomNumber = '', $profilePicture = '')
  {
    $this->username = $username;
    $this->email = $email;
    $this->password = $password;
    $this->roomNumber = $roomNumber;
    $this->profilePicture = $profilePicture;
  }

  public function getUsername()
  {
    return $this->username;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function getRoomNumber()
  {
    return $this->roomNumber;
  }

  public function getProfilePicture()
  {
    return $this->profilePicture;
  }

  public function setUsername($username)
  {
    $this->username = $username;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function setPassword($password)
  {
    $this->password = $password;
  }

  public function setRoomNumber($roomNumber)
  {
    $this->roomNumber = $roomNumber;
  }

  public function setProfilePicture($profilePicture)
  {
    $this->profilePicture = $profilePicture;
  }

  public function validateEmail()
  {
    if (empty($this->email)) {
      return "Email is required";
    }

    if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
      return "Invalid email format";
    }

    if (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/", $this->email)) {
      return "Invalid email format";
    }

    return null;
  }

  public function validatePassword()
  {
    if (empty($this->password)) {
      return "Password is required";
    }

    if (strlen($this->password) != 8) {
      return "Password must be exactly 8 characters";
    }

    if (!preg_match("/^[a-z0-9_]+$/", $this->password)) {
      return "Password can only contain lowercase letters, numbers, and underscore";
    }

    if (preg_match("/[A-Z]/", $this->password)) {
      return "Password cannot contain capital letters";
    }

    return null;
  }

  public function save()
  {
    $userData = $this->username . "|" . $this->email . "|" . $this->password . "|" . $this->roomNumber . "|" . $this->profilePicture . "\n";
    file_put_contents('users.txt', $userData, FILE_APPEND);
  }

  public static function findUser($username, $password)
  {
    if (!file_exists('users.txt')) {
      return null;
    }

    $users = file('users.txt', FILE_IGNORE_NEW_LINES);

    foreach ($users as $userData) {
      $data = explode('|', $userData);

      if ($data[0] == $username && $data[2] == $password) {
        return new User($data[0], $data[1], $data[2], $data[3], $data[4]);
      }
    }

    return null;
  }

  public static function usersFileExists()
  {
    return file_exists('users.txt');
  }
}