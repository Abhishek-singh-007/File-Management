<?php
include 'db_connection.php';

function backupData($conn)
{
  $filename = 'backup_' . date('Y-m-d_H-i-s') . '.csv';
  $output = fopen($filename, 'w');

  // Get table columns
  $columns = $conn->query("SHOW COLUMNS FROM membres");
  while ($row = $columns->fetch_assoc()) {
    $header[] = $row['Field'];
  }
  fputcsv($output, $header);

  // Get table data
  $result = $conn->query("SELECT * FROM membres");
  while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
  }

  fclose($output);
  echo "Data backed up to $filename successfully.";
}

backupData($conn);
$conn->close();
?>