<div style="margin-top: 10vh;">
	<?php
		foreach($infoUser as $ligne)
		{
			$email=$ligne['email'];
			$nom=$ligne['nom'];
			$prenom=$ligne['prenom'];	
		}
	?>	 
	<!--
	<div style="display: flex; flex-direction: column; padding: 0; margin: 0 auto; width:55%; height: 90vh; align-items: center; background-color: rgba(255,255,255, 0.98); justify-content: space-around;">
		Carte Info perso
		<div class="info-perso" style="display: flex; align-items: center;">
			<div id="img" style="width: 50%; display: flex; align-items: center; justify-content: center;">
				<img src="vue/images/InfoPerso.gif" style="width: 50%; height:auto;">
			</div>
			<div id="info" style="width: 50%; display: flex; flex-direction: column; align-items: center; justify-content: center;">
				<h4><u>Informations personnelles</u></h4>
				<div>
					<p>Email : <?php echo $email ?></p>
					<p>Nom : <?php echo $nom ?></p>
					<p>Prenom : <?php echo $prenom ?></p>
				</div>
			</div>
		</div>
		<div id="voitures" style="width: 100%;">
			<div class="info-voiture" style="display:flex; flex-direction: column; align-items: center;">
				<img src="vue/images/voiture.gif" height="auto" width="25%">
				<h4>Voitures <button type='button' class='btn' data-toggle='modal' data-target='#ajout_vehicule' style="padding: 0;padding-bottom: 4px;"><img src='./vue/images/plus.png' style="height: 20px; width: 20px;"></button></h4>
			</div>
			<br>
			<div style="display: flex; justify-content: space-around; width: 100%; align-items: center;">
				<?php
				if(is_array($infoVehicule))
				{
				?>
					<?php
					$compteur=1;
					foreach($infoVehicule as $ligne)
					{
						?>
						<div class="card" id="<?= $ligne['id_car'] ?>">
							<div class="card-header">
								<span><?= $ligne['marque']." ".$ligne['modele'] ?></span>
								<div>

								</div>
							</div>
							<div class="card-body">
								<p>Marque : <span id='marque'><?= $ligne['marque'] ?></span></p>
								<p>Modèle : <span id='modele'><?= $ligne['modele'] ?></span></p>
								<p>Immatriculation : <span id='matricule'><?= $ligne['matricule'] ?></span></p>
							</div>
							<div class="card-footer" id="<?= $ligne['id_car'] ?>" style="display: flex; justify-content: flex-end;">
								<button type='button' title="Supprimer le véhicule" class='btn' data-toggle='modal' data-target='#validDelete' onclick='valid_del_car(this);'>
									<lord-icon
										src="https://cdn.lordicon.com/kfzfxczd.json"
										trigger="morph"
										colors="primary:#000000"
										state="morph-fill"
										style="width:30px;height:30px">
									</lord-icon>	
								</button>
								<button type='button' title="Modifier le véhicule" class='btn' id="btn_modif_voit" data-toggle='modal' data-target='#modif_vehicule' onclick='get_id_parent(this);'>
									<lord-icon
											src="https://cdn.lordicon.com/hwuyodym.json"
											trigger="loop-on-hover"
											colors="primary:#000000"
											state="hover-1"
											style="width:30px;height:30px">
									</lord-icon>
								</button>
							</div>
						</div>
						<br>
						<?php
					}
				}
				?>
			</div>
		</div>
	</div> -->

	<div style="width: 100vw; height: 90vh; display: flex; max-width: 100%; overflow: hidden;">
		<div style="height: 90vh; width: 50vw; margin-top: 10px; display:flex; flex-direction: column; align-items: center; justify-content: space-evenly;">
			<h3 style="text-align: center;">Vos Informations</h3>
			<div style="height: 70%; width: 70%; border-radius: 24px; background: #0d6efd; box-shadow:  15px 15px 43px #a8a8a8,-15px -15px 43px #ffffff; padding: 20px 70px; color: #ffffff; display: flex; flex-direction: column; justify-content: space-around;">
				<div>
					<h3 class="animate__animated animate__slow animate__headShake"><u>Nom</u></h3>
					<p><?= $nom ?></p>
				</div>
				<div style="display: flex; align-items: flex-end; flex-direction: column;" >
					<h3 class="animate__animated animate__slow animate__headShake animate__delay-2s"><u>Prénom</u></h3>
					<p><?= $prenom ?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</p>
				</div>
				<div>
					<h3 class="animate__animated animate__slow animate__headShake animate__delay-4s"><u>Email</u></h3>
					<p><?= $email ?></p>
				</div>
			</div>
		</div>
		<div style="height: 90vh; width: 50vw; display: flex; flex-direction: column;">
			<div style="height: 20vh; width: 100%; display: flex; justify-content: center; align-items: center;">
				<h3>Vos Voitures <button type='button' class='btn' data-toggle='modal' data-target='#ajout_vehicule' style="padding: 0;padding-bottom: 4px;"><img src='./vue/images/plus.png' style="height: 20px; width: 20px;"></button></h3>
			</div>
			<div style="height: 60vh; width: 100%; display: flex; justify-content: center; align-items: center;">
				<?php
					if(!empty($infoVehicule))
					{
						?>
							<div id="carouselExampleFade" class="carousel carousel-dark slide">
								<div class="carousel-inner">
								<?php
								$active = true;
								foreach($infoVehicule as $voiture)
								{
									?>
									<div class="carousel-item <?php if($active) { echo "active"; } ?>">
										<img src="https://cdn.imagin.studio/getimage/?customer=frpribal&make=<?= $voiture["marque"] ?>&modelFamily=<?= $voiture["modele"] ?>&angle=28" class="d-block w-100">
										<div class="carousel-caption d-none d-md-block" id="<?= $voiture["id_car"] ?>">
											<h5><?= strtoupper($voiture["marque"]." ".$voiture["modele"]) ?></h5>
											<div>
												<!-- Bouton modification voiture -->
												<button type='button' title="Modifier le véhicule" class='btn' id="btn_modif_voit" data-toggle='modal' data-target='#modif_vehicule' onclick='get_id_parent(this.parentNode, "datalist_car_model_modif");'>
													<lord-icon
															src="https://cdn.lordicon.com/hwuyodym.json"
															trigger="loop-on-hover"
															colors="primary:#000000"
															state="hover-1"
															style="width:30px;height:30px">
													</lord-icon>
												</button>
												<!-- Bouton supression voiture -->
												<button type='button' title="Supprimer le véhicule" class='btn' data-toggle='modal' data-target='#validDelete' onclick='valid_del_car(this.parentNode);'>
													<lord-icon
														src="https://cdn.lordicon.com/kfzfxczd.json"
														trigger="morph"
														colors="primary:#000000"
														state="morph-fill"
														style="width:30px;height:30px">
													</lord-icon>	
												</button>
											</div>
											<input type="hidden" id="matricule" value="<?= $voiture["matricule"] ?>">
											<input type="hidden" id="marque" value="<?= $voiture["marque"] ?>">
											<input type="hidden" id="modele" value="<?= $voiture["modele"] ?>">
										</div>
										<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
											<span class="carousel-control-prev-icon" aria-hidden="true"></span>
											<span class="visually-hidden">Previous</span>
										</button>
										<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
											<span class="carousel-control-next-icon" aria-hidden="true"></span>
											<span class="visually-hidden">Next</span>
										</button>
									</div>
									<?php
									$active = false;
								}
							?>
							</div>
						<?php
					}
					else
					{
						
						echo "<h5>Vous n'avez pas de véhicule. Vous pouvez en ajouter un avec le bouton +</h5>";
					}
				?>
			</div>
		</div>
	</div>
	<!-- Modal supression véhicule -->
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
					Vous vous apprêtez à supprimer un véhicule. Si le véhicule est lié à des annonces, elles seront aussi supprimées.<br><br>
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
					<div class="col-md-12">
						<label for="inputEmail4" class="form-label">Marque</label>
						<input type="text" name="marque" list="datalist_car_brand" class="form-control" autocomplete="off" onfocusout="valid_value_from_datalist(this, 'datalist_car_brand', 'marque_error', 'ajout_car_modele', 'datalist_car_model_ajout')" required>
						<datalist id="datalist_car_brand">
            				<option value="abarth">abarth</option>
							<option value="acura">acura</option>
							<option value="aiways">aiways</option>
							<option value="alfa-romeo">alfa-romeo</option>
							<option value="alpine">alpine</option>
							<option value="aston-martin">aston-martin</option>
							<option value="audi">audi</option>
							<option value="bentley">bentley</option>
							<option value="bmw">bmw</option>
							<option value="borgward">borgward</option>
							<option value="bugatti">bugatti</option>
							<option value="buick">buick</option>
							<option value="byd">byd</option>
							<option value="byton">byton</option>
							<option value="cadillac">cadillac</option>
							<option value="chery">chery</option>
							<option value="chevrolet">chevrolet</option>
							<option value="chrysler">chrysler</option>
							<option value="citroen">citroen</option>
							<option value="cupra">cupra</option>
							<option value="dacia">dacia</option>
							<option value="dodge">dodge</option>
							<option value="dr-automobiles">dr-automobiles</option>
							<option value="ds">ds</option>
							<option value="elaris">elaris</option>
							<option value="fiat">fiat</option>
							<option value="fisker">fisker</option>
							<option value="ford">ford</option>
							<option value="gac">gac</option>
							<option value="genesis">genesis</option>
							<option value="gmc">gmc</option>
							<option value="haval">haval</option>
							<option value="honda">honda</option>
							<option value="hongqi">hongqi</option>
							<option value="hyundai">hyundai</option>
							<option value="ineos">ineos</option>
							<option value="infiniti">infiniti</option>
							<option value="isuzu">isuzu</option>
							<option value="iveco">iveco</option>
							<option value="jac">jac</option>
							<option value="jaguar">jaguar</option>
							<option value="jeep">jeep</option>
							<option value="kia">kia</option>
							<option value="lada">lada</option>
							<option value="lamborghini">lamborghini</option>
							<option value="lancia">lancia</option>
							<option value="land-rover">land-rover</option>
							<option value="ldv">ldv</option>
							<option value="levc">levc</option>
							<option value="lexus">lexus</option>
							<option value="lightyear">lightyear</option>
							<option value="lincoln">lincoln</option>
							<option value="lotus">lotus</option>
							<option value="lucid">lucid</option>
							<option value="lynkco">lynkco</option>
							<option value="man">man</option>
							<option value="maserati">maserati</option>
							<option value="maxus">maxus</option>
							<option value="mazda">mazda</option>
							<option value="mclaren">mclaren</option>
							<option value="mercedes">mercedes</option>
							<option value="mg">mg</option>
							<option value="mini">mini</option>
							<option value="mitsubishi">mitsubishi</option>
							<option value="nio">nio</option>
							<option value="nissan">nissan</option>
							<option value="opel">opel</option>
							<option value="ora">ora</option>
							<option value="peugeot">peugeot</option>
							<option value="piaggio">piaggio</option>
							<option value="polestar">polestar</option>
							<option value="porsche">porsche</option>
							<option value="ram">ram</option>
							<option value="renault">renault</option>
							<option value="rivian">rivian</option>
							<option value="rolls-royce">rolls-royce</option>
							<option value="saic">saic</option>
							<option value="seat">seat</option>
							<option value="seres">seres</option>
							<option value="skoda">skoda</option>
							<option value="smart">smart</option>
							<option value="sono">sono</option>
							<option value="ssangyong">ssangyong</option>
							<option value="subaru">subaru</option>
							<option value="suzuki">suzuki</option>
							<option value="tesla">tesla</option>
							<option value="toyota">toyota</option>
							<option value="vauxhall">vauxhall</option>
							<option value="vinfast">vinfast</option>
							<option value="volkswagen">volkswagen</option>
							<option value="volvo">volvo</option>
							<option value="wey">wey</option>
							<option value="xpeng">xpeng</option>
							<option value="zeekr">zeekr</option>
						</datalist> 
						<p id="marque_error" style="color: red; text-align: center; display: none; margin: 0;"><b>La marque doit être une valeur présente dans le liste<b></p>
					</div>
					<div class="col-md-12">
						<label for="inputPassword4" class="form-label">Modèle</label>
						<input type="text" autocomplete="off" name="modele" id="ajout_car_modele" class="form-control" list='datalist_car_model_ajout' required disabled>
						<datalist id="datalist_car_model_ajout">
						</datalist>
					</div>
					<div class="col-12">
						<label for="inputAddress" class="form-label">Immatriculation</label>
						<input type="text" name="matricule" class="form-control" oninput="verif_immat_ajout(this)" placeholder="Ex : AA-123-AA" required>
						<p id="immat_error_ajout" style="color: red; text-align: center; display: none; margin: 0;"><b>Immatriculation trop longue<br>(10 caractères max)<b></p>
					</div>
					<div class="col-12" style='text-align: center;margin-top: 10px;'>
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
					<div class="col-md-12">
						<label for="inputEmail4" class="form-label">Marque</label>
						<input type="text" name ="marque" class="form-control" id="marque_form" list="datalist_car_brand" autocomplete="off" onfocusout="valid_value_from_datalist(this, 'datalist_car_brand', 'marque_error_modif', 'modele_form', 'datalist_car_model_modif')"> 
						<p id="marque_error_modif" style="color: red; text-align: center; display: none; margin: 0;"><b>La marque doit être une valeur présente dans le liste<b></p>	
					</div>
					<div class="col-md-12">
						<label for="inputPassword4" class="form-label">Modèle</label>
						<input type="text" name="modele" class="form-control" id="modele_form" autocomplete="off" list="datalist_car_model_modif">
						<datalist id="datalist_car_model_modif">
						</datalist>
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
</div>