<?php
include 'connectPdo.php';

class DbAnnonce{
	
    public static function ValidAjout($dateTrajet,$lieuDepart,$lieuArrivee,$nbPlace,$fumeur,$iduser,$idcar)
	{
		$sql = "INSERT INTO TRAJET (id_trajet, depart, lieu_depart, lieu_arrivee, nb_place, fumeur, id_user, id_car)
		 VALUES (NULL, '$dateTrajet', '$lieuDepart', '$lieuArrivee', $nbPlace, $fumeur, $iduser, $idcar);";
    	connectPdo::getObjPdo()->exec($sql);    
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
		$sql = "SELECT id_trajet, depart, lieu_depart, lieu_arrivee, nb_place, fumeur FROM TRAJET WHERE id_user = $id;";
		$objResultat = connectPdo::getObjPdo()->query($sql);	
		$result = $objResultat->fetchAll();
		return $result; 
	}

	public static function getCarAnnonces($id)
	{
		$sql = "SELECT id_car,marque,matricule FROM VEHICULE WHERE id_user = $id;";
		$objResultat = connectPdo::getObjPdo()->query($sql);	
		$result = $objResultat->fetchAll();
		return $result; 
	}
	
}
?>
