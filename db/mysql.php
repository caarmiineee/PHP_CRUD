<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "student_management";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  
  // sql to create table
  $sql = "CREATE TABLE IF NOT EXISTS Students (
    id INTEGER PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
	age INTEGER NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	)";
  // use exec() because no results are returned
  $conn->exec($sql);
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>