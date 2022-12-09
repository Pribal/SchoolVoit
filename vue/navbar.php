<?php
if(isset($_SESSION['email']))
{
?>
<nav class="navbar fixed-top" style="background: rgb(0,97,211);
background: linear-gradient(90deg, rgba(43,127,224,1) 0%, rgba(0,97,211,1) 27%, rgba(0,97,211,1) 55%, rgba(43,127,224,1) 75%); height: 10vh;">
  <div class="col-2 d-flex justify-content-center">
    <a class="navbar-brand" href="#">
      <img src="vue/images/logo.png" width="auto" height="50px" class="d-inline-block align-text-top" style="filter: brightness(10000);">
    </a>
  </div>
  <div class="col-8 text-center">
    <a href='index.php?ctl=annonce&action=vueAnnonces'><img src='vue/images/SchoolVoit2.png' width="auto" height="75px"></a>
  </div>
  <div class="col-2 d-flex justify-content-center">
      <div class="dropdown-center">
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="filter: brightness(1000);">
          <lord-icon
                src="https://cdn.lordicon.com/dxjqoygy.json"
                trigger="hover"
                colors="primary:#ffffff,secondary:#ffffff"
                state="hover-nodding"
                style="width: 50px;height:50px">
          </lord-icon>
        </button>
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <ul class="dropdown-menu text-center dropdown-menu-center" role="menu" aria-labelledby="menu1" style="position: absolute; z-index: 9999;">
              <li role="presentation"><a class= "nav-link" href='index.php?ctl=annonce&action=vueAnnonces'>Annonces</a></li>
              <li><hr class="dropdown-divider"></li>
              <li role="presentation"><a class= "nav-link" href='index.php?ctl=reservation&action=vueReservation'>Annonces et Réservations</a></li>
              <li><hr class="dropdown-divider"></li>
              <li role="presentation"><a class= "nav-link" href='index.php?ctl=user&action=profilUser'>Profil</a></li>
              <li><hr class="dropdown-divider"></li>
              <li role="presentation"><a class= "nav-link" href='index.php?ctl=user&action=deconnect'>Déconnexion</a></li>
          </ul>
      </div>
  </div>
</nav>
<?php
}
?>