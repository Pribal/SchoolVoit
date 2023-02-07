<div style="margin-top: 10vh;">

    <h1>Mes Annonces</h1>

    <?php
    foreach($listeAnnonces as $ligne)
    {
    ?>
        <div class="card" style="width: 18rem;">
            <div class="card-header">
                Annonces n° : <?php echo $ligne['id_trajet'] ?>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Date : <?php echo $ligne['depart'] ?></li>
                <li class="list-group-item">Lieu départ : <?php echo $ligne['lieu_depart'] ?></li>
                <li class="list-group-item">Lieu arrivée : <?php echo $ligne['lieu_arrivee'] ?></li>
                <li class="list-group-item">Nombre de place : <?php echo $ligne['nb_place'] ?></li>
                <li class="list-group-item">Fumeur autorisé : <?php echo $ligne['fumeur'] ?></li>
            </ul>
            <div class="card-footer">
                Véhicule
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Matricule : <?php echo $ligne['matricule'] ?></li>
                <li class="list-group-item">Véhicule : <?php echo $ligne['marque'].' '.$ligne['modele'] ?></li>
            </ul>
        </div>
        <hr>
    <?php
    }
    ?>

    <h1>Mes Reservations</h1>

    <?php
    foreach($listeReservations as $ligne)
    {
    ?>
        <div class="card" style="width: 18rem;">
            <div class="card-header">
                Annonces n° : <?php echo $ligne['id_trajet'] ?>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Date : <?php echo $ligne['depart'] ?></li>
                <li class="list-group-item">Lieu départ : <?php echo $ligne['lieu_depart'] ?></li>
                <li class="list-group-item">Lieu arrivée : <?php echo $ligne['lieu_arrivee'] ?></li>
                <li class="list-group-item">Nombre de place : <?php echo $ligne['nb_place'] ?></li>
                <li class="list-group-item">Fumeur autorisé : <?php echo $ligne['fumeur'] ?></li>
            </ul>
            <div class="card-footer">
                Status :
            </div>
            <ul class="list-group list-group-flush">
                <?php 
                if($ligne['reserve']==0)
                    echo "<li class='list-group-item' style='color:red;'>En cours";
                elseif($ligne['reserve']==1)
                echo "<li class='list-group-item' style='color:green ;'>Validé";
                ?></li>
            </ul>

        </div>
        <hr>
    <?php
    }
    ?>

    <h1>Validation des demandes</h1>

    <?php
    foreach($listeDemandeValid as $ligne)
    {
    ?>
        <div class="card" style="width: 18rem;">
        <div class="card-header">
                Informations de l'annonce :
            </div>
            <ul class="list-group list-group-flush">
            <li class="list-group-item"><?php echo $ligne['lieu_depart']." -> ".$ligne['lieu_arrivee'] ?></li>
                <li class="list-group-item">Date : <?php echo $ligne['depart'] ?></li>
            </ul>
            <div class="card-header">
                Informations de la personne :
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Nom : <?php echo $ligne['nom'] ?></li>
                <li class="list-group-item">Prénom : <?php echo $ligne['prenom'] ?></li>
            </ul>
            <div class="card-footer">
                <a href="index.php?ctl=reservation&action=AccepterDemande&id_reservation=<?= $ligne['id_reservation'] ?>&id_trajet=<?= $ligne['id_trajet'] ?>"><img src="vue/images/thumbup.png" width="35px;" height=auto;></a>
                <a href="index.php?ctl=reservation&action=RefuserDemande&id_reservation=<?= $ligne['id_reservation'] ?>"><img src="vue/images/thumbdown.jpg" width="35px;" height=auto;></a>
            </div>
        </div>
        

    </div>
    <hr>
<?php
}
?>