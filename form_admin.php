<?php
if (!isset($_SESSION)) session_start();
require "connection.php";


if ($user < 1) {header('Location: index.php');}
if ($user[0]['permitName'] == 'User') {header('Location: index.php');}


if (array_key_exists('id', $_SESSION)) {

  $sql = "SELECT members.id AS id_member, userName, userLastName, email, permissions.id AS id_permit, permitName FROM members LEFT JOIN permissions ON members.role_id = permissions.id";
  $query = mysqli_query($conn, $sql);
  $results = mysqli_fetch_all($query, MYSQLI_ASSOC);
  //print_r($results);

?>

<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Last name</th>
      <th>Email</th>
      <th>Role</th>
    <?php if ($user[0]['permitName'] != 'Moderator') { ?>
      <th>Action</th>
    <?php } ?>
    </tr>
  </thead>
    <?php 
    for ($i=0; $i < count($results); $i++) { ?>

    <tr style="font-weight: 600; color: white">
      <td><?php echo $i+1; ?></td>
      <td><?php echo htmlspecialchars($results[$i]['userName']); ?></td>
      <td><?php echo htmlspecialchars($results[$i]['userLastName']); ?></td>
      <td><?php echo htmlspecialchars($results[$i]['email']); ?></td>
      <td><?php echo htmlspecialchars($results[$i]['permitName']); ?></td>
      <td>
        <?php if ($user[0]['permitName'] != 'Moderator') { ?>
          <a href="editUser.php?id=<?php echo htmlspecialchars($results[$i]['id_member']);?>" class="btn btn-danger btn-sm">Edit</a>
        <?php } ?>
        <?php if ($user[0]['permitName'] != 'Moderator' && $user[0]['permitName'] != 'Admin') { ?>
          <a href="delete.php?id=<?php echo htmlspecialchars($results[$i]['id_member']);?>" class="btn btn-danger btn-sm">Delete</a>
        <?php } ?>
      </td>
    </tr>

    <?php } ?>
  <tbody>

  </tbody>

</table>

<?php } ?>