<?php
include './model/Db_annonce.php';

$action =$_GET['action'];

switch($action){	

    case 'vueAnnonces':
        include('vue/vue_annonces/annonces.php');
}

?>