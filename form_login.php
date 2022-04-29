<?php
if (!isset($_SESSION)) session_start();

if (isset($_POST['signup'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $error_mail = NULL;
    $pass = NULL;
    $correct = NULL;

    $sql = "SELECT id, email, password FROM members WHERE email = '$email'";
    $query = mysqli_query($conn, $sql);
    $user = mysqli_fetch_all($query, MYSQLI_ASSOC);

        if (count($user) < 1) {
          $error_mail = "Pogrešna mail adresa";
        } elseif (!password_verify($password, $user[0]['password'])) {
          $error_pass = 'Pogrešna šifra';
        } elseif (password_verify($password, $user[0]['password'])) {
          $_SESSION['id'] = $user[0]['id'];
          $correct = 'Uspešno ste se prijavili';
        }
}
?>

<form action="login.php" method="post" class="text-light">
    <span style="color: red; font-weight: 700; font-size: 16px; margin-left: 100px;"> <?php echo $error_mail ?? ''; ?> </span>
    <span style="color: green; font-weight: 700; font-size: 15px;"><?php echo $correct ?? ''; ?> </span>
  <div class="mb-3">
    <label class="form-label">Email adresa</label>
    <input type="email" name="email" placeholder="Unesite Vaš email" class="form-control" aria-describedby="emailHelp">
  </div>
  <span style="color: red; font-weight: 700; font-size: 16px; margin-left: 100px;"> <?php echo $error_pass ?? ''; ?> </span>
  <div class="mb-3">
    <label class="form-label">Šifra</label>
    <input type="password" name="password" placeholder="Unesite Vašu šifru" class="form-control">
  </div>
  <br>
  <button type="submit" name="signup" class="btn btn-danger">Prijavi se</button>
</form>