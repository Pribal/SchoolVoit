<div style="margin-top: 10vh;">
    <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Mes annonces</button>
        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Mes réservations</button>
        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Gérer les demandes de réservation</button>
    </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <!-- Annonces -->
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
            <div style="display:flex;align-items:center; flex-direction:column;">
                <h1 style="text-align:center; margin-bottom:5%;margin-top:2%;"><u>Mes Annonces</u></h1>
                <div class="flexreservation">
                    <?php
                    foreach($listeAnnonces as $ligne)
                    {
                        ?>
                        <div class="col-6" style='margin-bottom:3%;'>
                            <div style="display:flex; justify-content:space-around;">
                                <div class="card border-dark mb-3" style='max-width:100%;'>
                                    <div class="card-body text-dark">
                                        
                                            <h4 class="card-title" style='display:flex; justify-content:center;'>Annonces n° : <?php echo $ligne['id_trajet'] ?></h4>
                                            <div id="<?= $ligne['id_trajet']?>" style="display:flex; justify-content:flex-end;">
                                                <button type='button' title="Supprimer l'annonce" class='btn' data-toggle='modal' data-target='#validDeleteAnnonce' onclick='valid_del_annonce(this);'>
                                                    <lord-icon
                                                        src="https://cdn.lordicon.com/kfzfxczd.json"
                                                        trigger="morph"
                                                        colors="primary:#000000"
                                                        state="morph-fill"
                                                        style="width:30px;height:30px;">
                                                    </lord-icon>	
                                                </button>
                                            </div>
                                            <hr>
                                        
                                        <h6 style='text-align:center;'>Date : <?php echo $ligne['depart'] ?></h6>
                                        <br>
                                        <div style='display:flex; justify-content:space-around;'>
                                            <p style='text-align:center; width:48%;'>Lieu départ :<br> <?php echo $ligne['lieu_depart']?></p>
                                            <div>
                                                <hr class="separation" />
                                            </div>
                                            <p style='text-align:center; width:48%;'>Lieu arrivée :<br> <?php echo $ligne['lieu_arrivee']?></p>
                                        </div>
                                        <br>
                                        <div style='display:flex; justify-content: space-around;'>
                                            <p style='text-align:center;'>Nombre de place : <?php echo $ligne['nb_place'] ?></p>
                                            <p style='text-align:center;'>Fumeur autorisé : <?php switch($ligne['fumeur']) { case 0: echo "non"; break; case 1: echo "oui"; break;} ?></p>
                                        </div>
                                        <hr>
                                        <u><h4 style='text-align:center;'>Véhicule</h4></u>
                                        <br>
                                        <div style='display:flex;flex-wrap: wrap; justify-content: space-around;'>
                                            <p style='text-align:center;'>Matricule : <?php echo $ligne['matricule'] ?></p>
                                            <p style='text-align:center;'>Véhicule : <?php echo $ligne['marque'].' '.$ligne['modele'] ?></p>
                                        </div>      
                                    </div>
                                </div>
                            </div>      
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- Réservations -->
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
            <div style="display:flex;align-items:center; flex-direction:column;">
                <h1 style="text-align: center; margin-bottom:5%;margin-top:2%;"><u>Mes Reservations</u></h1>     
                <div class="flexreservation">
                <?php
                    foreach($listeReservations as $ligne)
                    {
                    ?>
                    <div class="col-6" style='margin-bottom:3%;'>
                        <div style="display:flex; justify-content:space-around;">
                            <div class="card border-dark mb-3" style='max-width:100%;'>
                                <div class="card-body text-dark">
                                    
                                        <h4 class="card-title" style='display:flex; justify-content:center;'>Annonces n° : <?php echo $ligne['id_trajet'] ?></h4>
                                        <div id="<?= $ligne['id_reservation']."-".$ligne['reserve'].'-'.$ligne['id_trajet']?>" style="display:flex; justify-content:flex-end;">
                                            <button type='button' title="Supprimer l'annonce" class='btn' data-toggle='modal' data-target='#validDeleteReservation' onclick='valid_del_reservation(this);'>
                                                <lord-icon
                                                    src="https://cdn.lordicon.com/kfzfxczd.json"
                                                    trigger="morph"
                                                    colors="primary:#000000"
                                                    state="morph-fill"
                                                    style="width:30px;height:30px;">
                                                </lord-icon>	
                                            </button>
                                        </div>
                                        <hr>
                                    
                                    <h6 style='text-align:center;'>Date : <?php echo $ligne['depart'] ?></h6>
                                    <br>
                                    <div style='display:flex; justify-content:space-around;'>
                                        <p style='text-align:center; width:48%;'>Lieu départ :<br> <?php echo $ligne['lieu_depart']?></p>
                                        <div>
                                            <hr class="separation" />
                                        </div>
                                        <p style='text-align:center; width:48%;'>Lieu arrivée :<br> <?php echo $ligne['lieu_arrivee']?></p>
                                    </div>
                                    <br>
                                    <div style='display:flex; justify-content: space-around;'>
                                        <p style='text-align:center;'>Nombre de place : <?php echo $ligne['nb_place'] ?></p>
                                        <p style='text-align:center;'>Fumeur autorisé : <?php switch($ligne['fumeur']) { case 0: echo "non"; break; case 1: echo "oui"; break;} ?></p>
                                    </div>
                                    <hr>
                                    <u><h4 style='text-align:center;'>Statut</h4></u>
                                    <br>
                                    <div style='display:flex;flex-wrap: wrap; justify-content: space-around;'>
                                    <?php 
                                        if($ligne['reserve']==0)
                                            echo "<h4 style='color:red;'>En cours</h4>";
                                        elseif($ligne['reserve']==1)
                                        echo "<h4  style='color:green ;'>Validé</h4>";
                                        ?>
                                    </div>      
                                </div>
                            </div>
                        </div>      
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        

        <!-- Demande Validation -->
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
            <div style="display:flex;align-items:center; flex-direction:column;">
            <h1 style="text-align:center; margin-bottom:5%;margin-top:2%;"><u>Validation des demandes</u></h1>
                <div class="flexreservation">
                    <?php
                    foreach($listeDemandeValid as $ligne)
                    {
                    ?>
                        <div class="col-6" style='margin-bottom:3%;'>
                            <div style="display:flex; justify-content:space-around;">
                                <div class="card border-dark mb-3" style='max-width:100%;'>
                                    <div class="card-body text-dark">
                                        
                                            <h4 class="card-title" style='display:flex; justify-content:center;'><u>Annonces n° : <?php echo $ligne['id_trajet']?></u></h4>
                                            <br>
                                        
                                        <h6 style='text-align:center;'>Date : <?php echo $ligne['depart'] ?></h6>
                                        <br>
                                        <div style='display:flex; justify-content:space-around;'>
                                            <p style='text-align:center; width:48%;'>Lieu départ :<br> <?php echo $ligne['lieu_depart']?></p>
                                            <div>
                                                <hr class="separation2" />
                                            </div>
                                            <p style='text-align:center; width:48%;'>Lieu arrivée :<br> <?php echo $ligne['lieu_arrivee']?></p>
                                        </div>
                                        <div style='display:flex; justify-content: space-around;'>
                                            <p style='text-align:center;'>Nombre de places restantes : <?php echo $ligne['nb_placeDispo'] ?></p>
                                            
                                        </div>
                                        <hr>
                                        <u><h4 style='text-align:center;'>Informations de la personne</h4></u>
                                        <br>
                                        <div style='display:flex;flex-wrap: wrap; justify-content: space-around;'>
                                            <p style='text-align:center;'>Nom : <?php echo $ligne['nom'] ?></p>
                                            <p style='text-align:center;'>Prénom : <?php echo $ligne['prenom'] ?></p>
                                        </div>  
                                        <hr>
                                        <u><h4 style='text-align:center;'>Gérer</h4></u>
                                        <br>
                                        <div id=<?= $ligne['id_reservation']."-".$ligne['id_trajet'] ?> style='display:flex;flex-wrap: wrap; justify-content: space-around;'>
                                            <button type='button' title="accepter l'annonce" class='btn' data-toggle='modal' data-target='#accepterDemande' onclick='accepterReservation(this);'>
                                                <img src="vue/images/thumbup.png" width="60px;" height=auto;>
                                            </button>
                                            <button type='button' title="Supprimer l'annonce" class='btn' data-toggle='modal' data-target='#refuserDemande' onclick='refuserReservation(this);'>
                                                <img src="vue/images/thumbdown.jpg" width="60px;" height=auto;>
                                            </button>

                                        </div> 

                                    </div>
                                </div>
                            </div>      
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
    

<!-- Modal supprimer annonce-->

<div class="modal fade" tabindex="-1" id="validDeleteAnnonce" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" style='color:red;' id="exampleModalLongTitle">Attention !</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; background: none;">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body" >
			<p style='font-weight :normal; text-align:center;'>
				Vous vous apprêtez à supprimer une annonce.<br>
				Êtes-vous sur de vouloir continuer ?
			</p>
		</div>
		<div class="modal-footer" style='text-align:center;'>
			<button type="button" class="btn btn-muted" data-dismiss="modal">Annuler</button>
			<a class="btn btn-secondary" href="#" id="url_modal_suppAnnonce">Supprimer</a>
		</div>
		</div>
	</div>
</div>


<!-- Modal supprimer reservation-->

<div class="modal fade" tabindex="-1" id="validDeleteReservation" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" style='color:red;' id="exampleModalLongTitle">Attention !</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; background: none;">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body" >
			<p style='font-weight :normal; text-align:center;'>
				Vous vous apprêtez à supprimer une réservation.<br>
				Êtes-vous sur de vouloir continuer ?
			</p>
		</div>
		<div class="modal-footer" style='text-align:center;'>
			<button type="button" class="btn btn-muted" data-dismiss="modal">Annuler</button>
			<a class="btn btn-secondary" href="#" id="url_modal_suppReservation">Supprimer</a>
		</div>
		</div>
	</div>
</div>

<!-- Refuser demande-->

<div class="modal fade" tabindex="-1" id="refuserDemande" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" style='color:red;' id="exampleModalLongTitle">Attention !</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; background: none;">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body" >
			<p style='font-weight :normal; text-align:center;'>
				Vous vous apprêtez à refuser une demande de réservation.<br>
				Êtes-vous sur de vouloir continuer ?
			</p>
		</div>
		<div class="modal-footer" style='text-align:center;'>
			<button type="button" class="btn btn-muted" data-dismiss="modal">Annuler</button>
			<a class="btn btn-secondary" href="#" id="url_modal_refuser">Refuser</a>
		</div>
		</div>
	</div>
</div>

<!-- Modal accepter demande-->

<div class="modal fade" tabindex="-1" id="accepterDemande" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" style='color:red;' id="exampleModalLongTitle">Attention !</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; background: none;">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body" >
			<p style='font-weight :normal; text-align:center;'>
				Vous vous apprêtez à accepter une demande de réservation.<br>
				Êtes-vous sur de vouloir continuer ?
			</p>
		</div>
		<div class="modal-footer" style='text-align:center;'>
			<button type="button" class="btn btn-muted" data-dismiss="modal">Annuler</button>
			<a class="btn btn-secondary" href="#" id="url_modal_accepter">Accepter</a>
		</div>
		</div>
	</div>
</div>