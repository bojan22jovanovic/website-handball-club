<!-- Container forms-->
<div class="container">
<!-- Forma + Spartak -->
    <div class="row">
      <div class="col-7 float-start mtb100">
<!-- FORM_(?) -->
      <?php 

      if ($page_title == "RK Spartak - Početna strana") { echo ""; 
      } elseif ($page_title == "Registracija") { require "form_create.php";
      } elseif ($page_title == "Prijava") { require "form_login.php";
      } elseif ($page_title == "Admin") { require "form_admin.php";
      } 
      ?>
<!-- END FORM -->
      </div>

    <div class="col-4 float-end mtb100">
      <h1><span>Ženski rukometni klub</span><br><span class="span1">"Spartak"</span><br><span class="span2">Debeljača</span></h1>
    </div>
  </div>
</div>    <!-- End container forms-->