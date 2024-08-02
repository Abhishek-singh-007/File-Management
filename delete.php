<?php
if (isset($_GET["id"])) {
  $id = $_GET["id"];

  $servername = "localhost";
  $usernanme = "root";
  $password = "";
  $database = "info";

  $connection = new mysqli($servername, $usernanme, $password, $database);

  $sql = "DELETE FROM membres WHERE id=$id";
  $connection->query($sql);
}

header("location: /membres/index.php");
exit;

?>