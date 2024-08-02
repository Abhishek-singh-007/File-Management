<?php
include 'db_connection.php';

function restoreData($conn, $filename)
{
  $file = fopen($filename, 'r');

  // Skip the first line (column headers)
  fgetcsv($file);

  while ($row = fgetcsv($file)) {
    $name = $row[0];
    $email = $row[1];
    $username = $row[2];
    $address = $row[3];
    $role = $row[4];

    $sql = "INSERT INTO membres (name, email, username, address, role) VALUES ('$name', '$email', '$username', '$address', '$role')";
    if (!$conn->query($sql)) {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

  fclose($file);
  echo "Data restored from $filename successfully.";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['restore_file'])) {
  $filename = $_FILES['restore_file']['tmp_name'];
  if (is_uploaded_file($filename)) {
    restoreData($conn, $filename);
  } else {
    echo "File upload failed.";
  }
}

$conn->close();
?>