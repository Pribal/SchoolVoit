<?php
if(!isset($_SESSION['email']))
{
?>
<!-- Section: Design Block -->
<section class="background-radial-gradient overflow-hidden" style="min-height:100vh; background: rgb(0,97,211);
background: linear-gradient(90deg, rgba(0,97,211,1) 0%, rgba(43,127,224,1) 27%, rgba(89,151,223,1) 55%, rgba(147,192,245,1) 75%); display: flex; align-items: center;">
  <div class="container px-4  px-md-5 text-center text-lg-start">
    <div class="row gx-lg-5 align-items-center" style="margin-top:10px;">
      
      <div class="col-lg-5 mb-lg-0" style="z-index: 10;" >
        <div class="container" style="text-align: center;">
          <img src="vue/images/logo.png" width="250" height="auto" class="d-inline-block" style="filter: brightness(100);">
          <h1 class=" display-5 fw-bold ls-tight" style=" margin-bottom:10%; color: hsl(218, 81%, 95%)">
              Bienvenue sur<br>
              <span style="color: hsl(218, 81%, 75%); font-size: larger;">SchoolVoit'</span><br>
          </h1>
        </div>
        <div style='border: 3px solid hsl(218, 81%, 75%); border-radius: 5px; background-color: hsl(218, 81%, 75%);'>
          <p style='text-align: justify; margin:10px; color:white;'>SchoolVoit est une application web de covoiturage créée par et pour <a href="https://institutionsaintaspais.fr" style="text-decoration: none;">le lycée Saint Aspais de Melun</a>. Elle permet la mise en relation d'étudiant du campus afin d'organiser entre eux des trajets d'un point de départ au lycée et vice-versa. SchoolVoit veut limiter le nombre de voitures utilisées pour des déplacements similaires afin de réduire la pollution et l'encombrement autour de l'école pendant les heures d'arrivée et de départ des étudiants.</p>
        </div>
      </div>
      <div class="col-lg-1"></div>
      
      <div class="col-lg-6 mb-5 mb-lg-0 position-relative" style="text-align:center;">
      <img src="vue/images/car-driving-7.gif" width="300" height="auto" class="d-inline-block" style="margin-bottom:-8%;">
        <div class="card bg-glass">
          <div class="card-body px-4 py-5 px-md-5">
            <form action="index.php?ctl=user&action=validLogin" method="POST">


              <!-- Email input -->
              <div class="form-outline mb-4" style="text-align:left;">
                <label class="form-label"  for="form3Example3">Email</label>
                <input type="email" name="email" id="form3Example3" class="form-control" required/>
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4" style="text-align:left;">
                <label class="form-label" for="form3Example4">Mot de passe</label>
                <input type="password" name="password" id="form3Example4" class="form-control" required/>
              </div>

              <!-- Submit button -->
              <button class="btn btn-primary btn-block">
                Se connecter
              </button>
            </form>
            <?php
            if(isset($_GET['msg']))
            {
              echo "<hr>";
              echo "<p style='color: red; text-align: center;'>".$_GET['msg']."</p>";
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section: Design Block -->
<?php
}
?>