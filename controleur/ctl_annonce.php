<?php
include './model/Db_annonce.php';

$action =$_GET['action'];

switch($action){	

    case 'vueAnnonces':
        $iduser= $_SESSION["id"];
        $listecar = DbAnnonce::getlistecar($iduser);
        $listeAnnonce = DBAnnonce::getAnnonces($iduser);
        include('vue/vue_annonces/annonces.php');
        break;

    case 'ValidAjout':
        $dateTrajet = $_POST['dateTrajet'];
        $lieuDepart= $_POST['lieuDepart'];
        $lieuArrivee= $_POST['lieuArrivee'];
        $nbPlace= $_POST['nbPlace'];
        $fumeur= $_POST['fumeur'];
        $iduser= $_SESSION["id"];
        $idcar= $_POST['idcar'];
        $listecar = DbAnnonce::getlistecar($iduser);
        DbAnnonce::ValidAjout($dateTrajet,$lieuDepart,$lieuArrivee,$nbPlace,$fumeur,$iduser,$idcar);
        $listeAnnonce = DBAnnonce::getAnnonces($iduser);
        include('vue/vue_annonces/annonces.php');
        break;

        case 'ReservAnnonce' :
            $id_user = $_SESSION['id'];
            $id_trajet = $_POST['id_trajet'];
            DbAnnonce::ReservAnnonce($id_user,$id_trajet);
            $listecar = DbAnnonce::getlistecar($id_user);
            $listeAnnonce = DBAnnonce::getAnnonces($id_user);
            include ('vue/vue_annonces/annonces.php');
            break;

}

?>