<?php

require_once 'Database.php';

$db = new Database();

$db->connect('localhost', 'root', '29102001', 'test_db');

echo "<hr>";

echo "<h3>Example 1: Insert</h3>";
$db->insert('users', [
  'name' => 'Mohamed',
  'email' => 'mohamed@example.com',
  'age' => '24'
]);

echo "<hr>";

echo "<h3>Example 2: Select</h3>";
$users = $db->select('users');

echo "Users in database:<br>";
foreach ($users as $user) {
  echo "ID: " . $user['id'] . " | Name: " . $user['name'] . " | Email: " . $user['email'] . "<br>";
}

echo "<hr>";

echo "<h3>Example 3: Update</h3>";
$db->update('users', 1, [
  'name' => 'Jane Doe',
  'email' => 'jane@example.com'
]);

echo "<hr>";

echo "<h3>Example 4: Delete</h3>";
$db->delete('users', 2);

echo "<hr>";

$db->closeConnection();