<?php
include 'connectPdo.php';

class DbAnnonce{
	
    public static function ValidAjout($dateTrajet,$lieuDepart,$lieuArrivee,$nbPlace,$fumeur,$iduser,$idcar)
	{
		$sql = "INSERT INTO TRAJET (id_trajet, depart, lieu_depart, lieu_arrivee, nb_place,nb_placeDispo, fumeur, id_user, id_car)
		 VALUES (NULL, '$dateTrajet', '$lieuDepart', '$lieuArrivee', $nbPlace,$nbPlace, $fumeur, $iduser, $idcar);";
    	connectPdo::getObjPdo()->exec($sql);
		header("location: http://localhost/SchoolVoit/index.php?ctl=annonce&action=vueAnnonces");    
	}

	public static function getlistecar($id)
	{
		$sql = "SELECT id_car,marque,modele FROM VEHICULE WHERE id_user = $id;";		
		$objResultat = connectPdo::getObjPdo()->query($sql);	
		$result = $objResultat->fetchAll();
		return $result;    
	}

	public static function getAnnonces($id)
	{
		$sql = "SELECT id_trajet, depart, lieu_depart, lieu_arrivee, nb_place,nb_placeDispo, fumeur FROM TRAJET WHERE id_user != $id;";
		$objResultat = connectPdo::getObjPdo()->query($sql);	
		$result = $objResultat->fetchAll();
		return $result; 
	}

	public static function getCarAnnonces($id)
	{
		$sql = "SELECT id_car,marque,matricule FROM VEHICULE WHERE id_user != $id;";
		$objResultat = connectPdo::getObjPdo()->query($sql);	
		$result = $objResultat->fetchAll();
		return $result; 
	}

	public static function getInfoAnnonce($id_trajet)
	{
		$sql = "SELECT *
			from TRAJET,USER,VEHICULE
			WHERE user.id_user = trajet.id_user
			AND trajet.id_car = VEHICULE.id_car
			AND trajet.id_trajet = '$id_trajet';";
		$objResultat = connectPdo::getObjPdo()->query($sql);	
		$result = $objResultat->fetchAll();
		return $result; 
	}
}
?>
