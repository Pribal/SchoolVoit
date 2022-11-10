<?php
	foreach($infoUser as $ligne)
    {
		$email=$ligne['email'];
		$nom=$ligne['nom'];
        $prenom=$ligne['prenom'];	
	}
?>
<style>
	body {
		background-image: url("vue/images/fond_profil.svg");
		background-size: cover;
	}
</style>

<div style="display: flex; flex-direction: column; padding: 0; margin: 0 auto; width:50%; height: 90vh; align-items: center; background-color: rgba(255,255,255, 0.95);">
	<!-- Carte Info perso -->
	<div class="info-perso">
		<h4><span><img src="vue/images/InfoPerso.gif" style="width: auto; height:60px;"></span> Informations personnelles</h4>
		<br>
		<ul>
			<li class="list-group-item">Email : <?php echo $email ?></li><br>
			<li class="list-group-item">Nom : <?php echo $nom ?></li><br>
			<li class="list-group-item">Prenom : <?php echo $prenom ?></li><br>
		</ul>	
	</div>
	<div class="info-voiture">
		<h4><span><img src="vue/images/voiture.gif" height="60px" width="auto"></span> Voitures <button type='button' class='btn' data-toggle='modal' data-target='#ajout_vehicule'><img src='./vue/images/plus.png' height=20 width=20></button></h4>
	</div>
	<br>
	<ul style="display: flex; justify-content: center;">
		<?php
		if(is_array($infoVehicule))
		{
		?>
			<?php
			$compteur=1;
			foreach($infoVehicule as $ligne)
			{
				?>
				<div class="voiture" id="<?= $ligne['id_car'] ?>">
					<h5><?= $ligne['marque']." ".$ligne['modele'].":" ?></h5>
					<ul style="list-style: none;">
						<li>Marque : <span id='marque'><?= $ligne['marque'] ?></span></li>
						<li>Modèle : <span id='modele'><?= $ligne['modele'] ?></span></li>
						<li>Immatriculation : <span id='matricule'><?= $ligne['matricule'] ?></span></li>
					</ul>
					<button type='button' class='btn' data-toggle='modal' data-target='#validDelete' onclick='valid_del_car(this);'><img src='./vue/images/remove.png' height=20 width=20></button>
					<button type='button' class='btn' id="btn_modif_voit" data-toggle='modal' data-target='#modif_vehicule' onclick='get_id_parent(this);'><img src='./vue/images/edit.png' height=20 width=20></button>
				</div>
				<br>
				<?php
			}
		}
		?>
	</ul>
</div>

<div class="modal fade" tabindex="-1" id="validDelete" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
			Vous vous apprêtez à supprimer un véhicule.<br>
			Êtes-vous sur de vouloir continuer ?
		</p>
      </div>
      <div class="modal-footer" style='text-align:center;'>
        <button type="button" class="btn btn-muted" data-dismiss="modal">Annuler</button>
		<a class="btn btn-secondary" href="#" id="url_modal">Supprimer</a>
      </div>
    </div>
  </div>
</div>

<!-- Ajout véhicule modal -->
<div class="modal fade" tabindex="-1" id="ajout_vehicule" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style='justify-content: center;'>
        <h5 class="modal-title" id="exampleModalLongTitle">Ajout d'un véhicule</h5>
      </div>
      <div class="modal-body" >
	  	<form method="POST" action="index.php?ctl=user&action=addCarUser" class="row g-3">
			<div class="col-md-6">
				<label for="inputEmail4" class="form-label">Marque</label>
				<input type="text" name = "marque" class="form-control" required>
			</div>
			<div class="col-md-6">
				<label for="inputPassword4" class="form-label">Modèle</label>
				<input type="text" name="modele" class="form-control" required>
			</div>
			<div class="col-12">
				<label for="inputAddress" class="form-label">Immatriculation</label>
				<input type="text" name="matricule" class="form-control" oninput="verif_immat_ajout(this)" placeholder="Ex : AA-123-AA" required>
				<p id="immat_error_ajout" style="color: red; text-align: center; display: none; margin: 0;"><b>Immatriculation trop longue<br>(10 caractères max)<b></p>
			</div>
			<div class="col-12" style='text-align: center;'>
				<button id="btn_ajout" class="btn btn-dark btn-block">Ajouter</button>
			</div>
		</form>
      </div>
    </div>
  </div>
</div>

<!-- modifier véhicule modal -->
<div class="modal fade" tabindex="-1" id="modif_vehicule" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style='justify-content: center;'>
        <h5 class="modal-title" id="exampleModalLongTitle">Modification du véhicule</h5>
      </div>
      <div class="modal-body" >
	  	<form method="POST" action="index.php?ctl=user&action=validModif" class="row g-3">
			<div class="col-md-6">
				<label for="inputEmail4" class="form-label">Marque</label>
				<input type="text" name ="marque" class="form-control" id="marque_form">
			</div>
			<div class="col-md-6">
				<label for="inputPassword4" class="form-label">Modèle</label>
				<input type="text" name="modele" class="form-control" id="modele_form">
			</div>
			<div class="col-12">
				<label for="inputAddress" class="form-label">Immatriculation</label>
				<input type="text" name="matricule" class="form-control" id="matricule_form" oninput="verif_immat_modif(this)" autocomplete=off>
				<p id="immat_error_modif" style="color: red; text-align: center; display: none; margin: 0;"><b>Immatriculation trop longue<br>(10 caractères max)<b></p>
			</div>
			<input type="hidden" name="id_car" id="id_car">
			<div class="col-12" style="text-align: center;">
				<button id="btn_modif" class="btn btn-dark btn-block">Modifier</button>
			</div>
		</form>
      </div>
    </div>
  </div>
</div>

<script src="vue/js/script.js" type="text/javascript" language="javascript"></script>
	