<?php
include './model/Db_reservation.php';

$action =$_GET['action'];

switch($action){	
          
    case 'vueReservation':
        $id = $_SESSION['id'];
        $listeAnnonces = DbReservation::getAnnoncebyID($id);
        $listeReservations = DbReservation::getReservationbyID($id);
        $listeDemandeValid = DbReservation::getDemandeValidAnnonce($id);
        DbReservation::SuppReservationComplete();
        include 'vue/vue_reservation/reservation.php';
        break;
    
    case 'RefuserDemande':
        $id = $_SESSION['id'];
        $id_reservation = $_GET['id_reservation'];
        DbReservation::RefuserDemande($id_reservation);
        $listeAnnonces = DbReservation::getAnnoncebyID($id);
        $listeReservations = DbReservation::getReservationbyID($id);
        $listeDemandeValid = DbReservation::getDemandeValidAnnonce($id);
        echo "<script>window.location.replace('index.php?ctl=reservation&action=vueReservation');</script>";
        break;

    case 'AccepterDemande':
        $id = $_SESSION['id'];
        $id_reservation = $_GET['id_reservation'];
        $id_trajet = $_GET['id_trajet'];
        $listeAnnonces = DbReservation::getAnnoncebyID($id);
        $listeReservations = DbReservation::getReservationbyID($id);
        $listeDemandeValid = DbReservation::getDemandeValidAnnonce($id);
        DbReservation::AccepterDemande($id_reservation,$id_trajet);
        echo "<script>window.location.replace('index.php?ctl=reservation&action=vueReservation');</script>";
        break;

    case 'supprimer_annonce':
        $id_trajet = $_GET['idtrajet'];
        DbReservation::supprimer_annonce($id_trajet);
        $id = $_SESSION['id'];
        $listeAnnonces = DbReservation::getAnnoncebyID($id);
        $listeReservations = DbReservation::getReservationbyID($id);
        $listeDemandeValid = DbReservation::getDemandeValidAnnonce($id);
        echo "<script>window.location.replace('index.php?ctl=reservation&action=vueReservation');</script>";
        break;

    case 'supprimer_reservation':
        $id_reservation = $_GET['idreservation'];
        $reserve = $_GET['reserve'];    
        $id_trajet = $_GET['id_trajet'];    
        DbReservation::supprimer_reservation($id_reservation);
        if($reserve==1)
        {
            DbReservation::rajoute1place($id_trajet);
        }
        $id = $_SESSION['id'];
        $listeAnnonces = DbReservation::getAnnoncebyID($id);
        $listeReservations = DbReservation::getReservationbyID($id);
        $listeDemandeValid = DbReservation::getDemandeValidAnnonce($id);
        echo "<script>window.location.replace('index.php?ctl=reservation&action=vueReservation');</script>";
        break;


}

?>