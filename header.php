<?php

if (!isset($_SESSION)) session_start();
/* if(!require "head.php") {require "head.php";}
 */require "connection.php";


?>

<!-- Header -->
<header>
  <!-- Log in and Registratio -->
  <div class="fixed-top">
    <!-- Container -->
    <div class="container">
<!-- ------------------------------------------------------------------------------------ -->
      <div class="row">

        <?php if (array_key_exists('id', $_SESSION) && isset($_SESSION['id'])) {

          $userId = $_SESSION['id'];
          $sql = "SELECT members.id AS id_member, userName, userLastName, email, permissions.id AS id_permit, permitName FROM members LEFT JOIN permissions ON members.role_id = permissions.id WHERE members.id = $userId";
          $query = mysqli_query($conn, $sql);
          $user = mysqli_fetch_all($query, MYSQLI_ASSOC); ?>
          
          <div class="col-9">
            <p style="color: white";>Dobro došli: 
              <span class="welcome"><?php echo htmlspecialchars($user[0]['userName']) . " " . htmlspecialchars($user[0]['userLastName'])?>
              </span>
            </p>
          </div>

          <div class="col-3">
            <ul class="navbar navbar-expand-lg div_login">

              <?php if ($user[0]['permitName'] != 'User') { ?>

              <li class="nav-item">
                <a href="admin.php">
                  <img src="img/handball-ball3.png">Admin
                </a>
              </li>

              <?php } ?>

              <li class="nav-item">
                <a href="logout.php">
                  <img src="img/handball-ball3.png">Odjava
                </a>
              </li>

            </ul>
          </div>
        
        <?php } else { ?>
        
          <div class="col-9"></div>
          <div class="col-3">
            <ul class="navbar navbar-expand-lg div_login">

              <li class="nav-item">
                <a href="login.php">
                  <img src="img/handball-ball3.png">Prijava
                </a>
              </li>

              <li class="nav-item">
                <a href="createUser.php">
                  <img src="img/handball-ball3.png">Registracija
                </a>
              </li>

            </ul>
          </div>
          
        <?php } ?>

      </div> <!-- End row div / login and registration-->

<!-- Navbar -->
        <div class="row">
          <div class="col-12">
            <nav class="navbar navbar-expand-lg div_nav">
            <div class="container-fluid">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"><img src="img/handball_ball4.PNG"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-lg-0">
                    <li class="nav-item dropdown">
                      <a href="index.php">
                        <img src="img/handball_ball4.PNG">Početna
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="about.php">
                        <img src="img/handball_ball4.PNG">O nama
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="players.php">
                        <img src="img/handball_ball4.PNG">Treneri i igrači
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="gallery.php">
                        <img src="img/handball_ball4.PNG">Galerija
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="contact.php">
                        <img src="img/handball_ball4.PNG">Kontakt
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>
          </div> <!-- End row col-12 -->
        </div> <!-- End row div -->
<!-- ------------------------------------------------------------------------------------ -->
    </div> <!-- End container -->
  </div> <!-- END FIXED Container -->
</header>
<div class="clearfix"></div>