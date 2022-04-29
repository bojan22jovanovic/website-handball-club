<?php

session_start();

$page_title = "Izmena podataka";

require 'connection.php';

/* Head */
require "head.php";


?>

<body>

<!-- Header ------------------------------------------------------------------------------------->
<?php 
require "header.php";

if (!$user) header('Location: index.php');
if ($user[0]['permitName'] == 'User') header('Location: index.php');
if ($user[0]['permitName'] == 'Moderator') header('Location: admin.php');

?>

<!-- Container -->
    <div class="container">
<!-- Form + h1 (Spartak) -->
        <div class="row">
          <div class="col-7">


<?php
/* --------------------------------------- EDIT USER DATA ----------------------------------------*/

if (isset($_SESSION['id'])) {
    $user_id = mysqli_real_escape_string($conn, $_GET['id']);
    $sqlEdit = "SELECT members.id AS id_member, userName, userLastName, password, birthYear, role_id, permissions.id AS id_permit, permitName FROM members LEFT JOIN permissions ON members.role_id = permissions.id WHERE members.id= $user_id";
    $queryEdit = mysqli_query($conn, $sqlEdit);
    $userEdit = mysqli_fetch_all($queryEdit, MYSQLI_ASSOC);   /* Vraća podatke za EDITOVANOG USERA */
    //print_r($userEdit);
}


$sqlPermits = "SELECT id, permitName FROM permissions";
$queryPermits = mysqli_query($conn, $sqlPermits);
$permits = mysqli_fetch_all($queryPermits, MYSQLI_ASSOC);
//print_r($permits);
/* ------------------------------------ END EDIT USER DATA ---------------------------------------*/


/* ----------------------------------------- UPDATE ----------------------------------------------*/
if (isset($_POST['btn_update'])) {

    $id_update = mysqli_real_escape_string($conn, $_GET['id']);
    $newName = mysqli_real_escape_string($conn, $_POST['userName']);
    $newLastname = mysqli_real_escape_string($conn, $_POST['userLastName']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['password']);
    $r_newPassword = mysqli_real_escape_string($conn, $_POST['r_password']);
    $newBirthYear = mysqli_real_escape_string($conn, $_POST['birthYear']);
    $newPermit = mysqli_real_escape_string($conn, $_POST['permit']);

    $error = NULL;
    $error_pass = NULL;
    $correct = NULL;
    
    //print_r($newRole );

     if (!$newName || !$newLastname || !$newBirthYear || !$newPassword || !$r_newPassword) {
        $error = "Sva polja moraju biti popunjena";
      } elseif ($newPassword != $r_newPassword) {
        $error_pass = "Šifre se ne poklapaju";
      } else {
        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sqlUpdate = "UPDATE members SET userName = '$newName', userLastName = '$newLastname', password = '$newPassword', birthYear = '$newBirthYear', role_id = '$newPermit' WHERE id = $id_update";
       
        if (mysqli_query($conn, $sqlUpdate)) {
          $correct = "Uspešno izmenjeni podaci";
        /* $error1 = "Error: " . $sqlUpdate . "<br>" . mysqli_error($conn); */
      }
    }
}
?>
<!-- ------------------------------------ END UPDATE -------------------------------------- -->



<!-- Form --------------------------------------------------------------------------------- -->
<div class="div-form">
  <form action="editUser.php?id=<?php echo htmlspecialchars($_GET['id']);?>" method="post" class="text-light;">
        <span style="color: red; font-weight: 700; font-size: 16px; margin-left: 70px;"> <?php echo $error ?? ''; ?> </span>
        <span style="color: red; font-weight: 700; font-size: 16px; margin-left: 40px;"> <?php echo $error_pass ?? ''; ?> </span>
        <span style="color: green;  font-weight: 700; font-size: 15px;"><?php echo $correct ?? ''; ?></span>
    <div class="mb-3">
        <label class="form-label">Unesite novo ime</label>
        <input type="text" name="userName" value="<?php echo htmlspecialchars($userEdit[0]['userName'])?>" class="form-control" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label class="form-label">Unesite novo prezime</label>
        <input type="text" name="userLastName" value="<?php echo htmlspecialchars($userEdit[0]['userLastName'])?>" class="form-control" aria-describedby="emailHelp">
    </div>
    <div class="mb-3 clearfix">
      <div>
        <label class="form-label">Unesite novu šifru</label>
      </div>
      <input type="password" name="password" class="form-control  float-start" placeholder="Unesite novi šifru" style="width: 300px;">
      <input type="password" name="r_password" class="form-control float-end"  placeholder="Ponovite šifru" style="width: 300px;">
    </div>
    <div class="mb-3">
        <label class="form-label">Unesite novu godinu rođenja</label>
        <input type="number" name="birthYear" value="<?php echo htmlspecialchars($userEdit[0]['birthYear'])?>" max="2022" min="1901" class="form-control" aria-describedby="emailHelp">
    </div>

    <!-- Roles -->
    <div class="mb-3">
        <label class="form-label">Permits</label>
        <select name="permit" class="form-select" aria-label="Default select example">

            <option value="<?php echo htmlspecialchars($userEdit[0]['role_id']); ?>" > <?php echo htmlspecialchars($userEdit[0]['permitName']); ?></option>
        <?php foreach ($permits as $permit) { 
          if ($permit['id'] == $userEdit[0]['role_id'] && $permit['permitName'] == $userEdit[0]['permitName']) {
             continue;
          } ?>
            <option value="<?php echo htmlspecialchars($permit['id']); ?>" >
              <?php echo htmlspecialchars($permit['permitName']); ?>
            </option>
        <?php } ?>
        
        </select>
    </div> <!-- END Roles -->
    <br>
    <button type="submit" name="btn_update" class="btn btn-danger">Izmeni podatke</button><br><br><br>
  </form> <!-- END form -->
</div> <!-- End div_form -->

<!-- END FORM EDIT -->
          </div>

        <div class="col-4 float-end">
          <h1 style="margin-top: 150px;"><span>Ženski rukometni klub</span><br><span class="span1">"SpartaK"</span><br><span class="span2">Debeljača</span></h1>
        </div> <!-- h1 -->
      </div>
    </div> <!-- End container -->
</header>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>