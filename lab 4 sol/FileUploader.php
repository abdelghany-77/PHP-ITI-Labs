<?php

class FileUploader
{
  private $file;
  private $uploadDir;
  private $allowedTypes;

  public function __construct($file, $uploadDir = 'uploads/')
  {
    $this->file = $file;
    $this->uploadDir = $uploadDir;
    $this->allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
  }

  public function validate()
  {
    if (!isset($this->file) || $this->file['error'] != 0) {
      return "Profile picture is required";
    }

    $fileType = $this->file['type'];

    if (!in_array($fileType, $this->allowedTypes)) {
      return "Only images allowed";
    }

    return null;
  }

  public function upload($username)
  {
    if (!file_exists($this->uploadDir)) {
      mkdir($this->uploadDir, 0777, true);
    }

    $fileExtension = pathinfo($this->file['name'], PATHINFO_EXTENSION);
    $newFilename = $username . '_' . time() . '.' . $fileExtension;
    $uploadPath = $this->uploadDir . $newFilename;

    if (move_uploaded_file($this->file['tmp_name'], $uploadPath)) {
      return $newFilename;
    }

    return false;
  }
}