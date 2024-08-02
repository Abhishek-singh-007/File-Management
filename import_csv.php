<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "info";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}

// Path to the CSV file
$file = 'data/data.csv';

// Open CSV file
if (($handle = fopen($file, 'r')) !== FALSE) {
  // Skip the header row
  fgetcsv($handle);

  // Read each line and insert into the database
  while (($line = fgetcsv($handle)) !== FALSE) {
    $name = $line[0];
    $email = $line[1];
    $username = $line[2];
    $address = $line[3];
    $role = $line[4];

    $sql = "INSERT INTO membres (name, email, username, address, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('sssss', $name, $email, $username, $address, $role);
    $stmt->execute();
  }

  fclose($handle);
  echo "Data imported successfully.";
} else {
  echo "Error opening the CSV file.";
}

$connection->close();
?>