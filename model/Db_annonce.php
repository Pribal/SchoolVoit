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
		$sql = "SELECT id_trajet, depart, lieu_depart, lieu_arrivee, nb_place,nb_placeDispo, fumeur 
		FROM TRAJET 
		WHERE id_user != $id
		AND nb_placeDispo > 0;";
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
			WHERE USER.id_user = TRAJET.id_user
			AND TRAJET.id_car = VEHICULE.id_car
			AND TRAJET.id_trajet = '$id_trajet';";
		$objResultat = connectPdo::getObjPdo()->query($sql);	
		$result = $objResultat->fetchAll();
		return $result; 
	}

	public static function count_nb_annonce($id_user)
	{
		$sql = "SELECT COUNT(*) FROM TRAJET WHERE id_user != $id_user;";
		$objResultat = connectPdo::getObjPdo()->query($sql);	
		$result = $objResultat->fetchAll();
		return $result[0][0]; 
	}

	public static function ReservAnnonce($id_user,$id_trajet)
	{
		$sql = "INSERT INTO reservation (id_reservation, reserve, id_user, id_trajet) VALUES (NULL, '0', $id_user, $id_trajet);";
		connectPdo::getObjPdo()->exec($sql);
	}

	
	public static function estDejaReserve($id_user,$id_trajet)
	{
		$sql = "SELECT * 
		FROM reservation
		WHERE id_user = $id_user
		AND id_trajet = $id_trajet;";
		$objResultat = connectPdo::getObjPdo()->query($sql);	
		$result = $objResultat->fetch();
		return $result;   

	}
}
?> 
