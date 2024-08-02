<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Persist Ventures</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
  <div class="container my-5">
    <h2>List Of Clients</h2>
    <a href="/membres/create.php" class="btn btn-primary" role="button">New Client</a>
    <br>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Username</th>
          <th>Address</th>
          <th>Role</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "info";

        $connection = new mysqli($servername, $username, $password, $database);

        if ($connection->connect_error) {
          die("Connection failed: " . $connection->connect_error);
        }

        $sql = "SELECT * FROM membres";
        $result = $connection->query($sql);

        if (!$result) {
          die("Invalid query: " . $connection->error);
        }

        while ($row = $result->fetch_assoc()) {
          echo "
          <tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['username']}</td>
            <td>{$row['address']}</td>
            <td>{$row['role']}</td>
            <td>
              <a class='btn btn-success btn-sm' href='/membres/view.php?id={$row['id']}'>View</a>
              <a href='/membres/delete.php?id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
              
            </td>
          </tr>
          ";
        }

        $connection->close();
        ?>
      </tbody>
    </table>
  </div>
  <hr>
  <div class="container my-5 mt-2">
    <h2>Backup and Restore</h2>
    <form action="backup.php" method="post">
      <button type="submit" class='btn btn-secondary btn-sm'>Backup Data</button>
    </form>
    <br>
    <form action="restore.php" method="post" enctype="multipart/form-data">
      <input type="file" name="restore_file" required>
      <button type="submit" class='btn btn-success btn-sm'>Restore Data</button>
    </form>
  </div>
</body>

</html>