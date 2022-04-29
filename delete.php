<?php 

require "connection.php";

if (!$user) header('Location: index.php');
if ($user[0]['permitName'] == 'User')  header('Location: index.php');
if ($user[0]['permitName'] == 'Moderator')  header('Location: admin.php'); 


if (isset($_GET['id'])) {
  $userId = mysqli_real_escape_string($conn, $_GET['id']);
  $sql = "DELETE FROM members WHERE id = $userId";
  $query = mysqli_query($conn, $sql);
  header("Location: admin.php");
}

?>