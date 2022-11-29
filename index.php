<?php
session_start();

include ('vue/header.php');
include('vue/vue_user/login_user.php');
include ('vue/navbar.php');


if(isset($_GET['ctl']))
{
	switch($_GET['ctl'])
    {

		case 'user':
			include 'controleur/ctl_user.php';
			break;

		case 'annonce':
			include 'controleur/ctl_annonce.php';
			break;

		case 'reservation':
			include 'controleur/ctl_reservation.php';
			break;
	}

}

include ('vue/footer.php');

?>