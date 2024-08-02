<?php
// Enable error reporting for debugging purposes
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if 'id' is set and not empty
if (isset($_GET["id"]) && !empty($_GET["id"])) {
  $id = intval($_GET["id"]); // Ensure the ID is an integer

  // Database connection parameters
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "info";

  // Create a new connection to the database
  $connection = new mysqli($servername, $username, $password, $database);

  // Check the connection
  if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
  }

  // Prepare the SQL statement
  $sql = "SELECT * FROM membres WHERE id = ?";
  $stmt = $connection->prepare($sql);

  if ($stmt === false) {
    die("Prepare failed: " . $connection->error);
  }

  // Bind the parameters
  $stmt->bind_param("i", $id);

  // Execute the statement
  if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
  }

  // Get the result
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
  } else {
    echo "No records found.";
    exit;
  }

  // Close the statement and connection
  $stmt->close();
  $connection->close();
} else {
  echo "ID not set or is empty.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Client</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
  <div class="container my-5">
    <h2>View Client Details</h2>
    <a href="/membres/index.php" class="btn btn-primary" role="button">Back to List</a>
    <br><br>
    <?php if (isset($row)) { ?>
      <table class="table">
        <tr>
          <th>ID</th>
          <td><?php echo htmlspecialchars($row['id']); ?></td>
        </tr>
        <tr>
          <th>Name</th>
          <td><?php echo htmlspecialchars($row['name']); ?></td>
        </tr>
        <tr>
          <th>Email</th>
          <td><?php echo htmlspecialchars($row['email']); ?></td>
        </tr>
        <tr>
          <th>Username</th>
          <td><?php echo htmlspecialchars($row['username']); ?></td>
        </tr>
        <tr>
          <th>Address</th>
          <td><?php echo htmlspecialchars($row['address']); ?></td>
        </tr>
        <tr>
          <th>Role</th>
          <td><?php echo htmlspecialchars($row['role']); ?></td>
        </tr>
      </table>
    <?php } ?>
  </div>
</body>

</html>