<?php
include 'connectPdo.php';

class DbReservation{
	//Récuperer les annonces publiés de l'utilisateur
	public static function getAnnoncebyID($id)
	{
		$sql = "SELECT * from TRAJET, VEHICULE where TRAJET.id_car = VEHICULE.id_car and TRAJET.id_user = $id;";		
		$objResultat = connectPdo::getObjPdo()->query($sql);	
		$result = $objResultat->fetchAll();
		return $result;    
	}

	//Récuperer les annonces réservé par l'utilisateur
	public static function getReservationbyID($id)
	{
		$sql = "SELECT * FROM RESERVATION, TRAJET where RESERVATION.id_trajet = TRAJET.id_trajet and TRAJET.id_user = $id;";
		$objResultat = connectPdo::getObjPdo()->query($sql);	
		$result = $objResultat->fetchAll();
		return $result;   
	}

	//Récuperer les demandes de validation des annonces de l'utilisateur
	public static function getDemandeValidAnnonce($id)
	{
		$sql = "SELECT * FROM RESERVATION, TRAJET, USER 
		WHERE RESERVATION.id_trajet = TRAJET.id_trajet
		AND TRAJET.id_user = USER.id_user
		AND TRAJET.id_user = $id
		AND RESERVATION.reserve = 0";
		$objResultat = connectPdo::getObjPdo()->query($sql);	
		$result = $objResultat->fetchAll();
		return $result;   
	}

	public static function RefuserDemande($id_reservation)
	{
		$sql = "DELETE FROM RESERVATION WHERE RESERVATION.id_reservation = $id_reservation;";
		connectPdo::getObjPdo()->exec($sql);    
	}

	//Change la valeur de reserve a 1 (Reservation validé) dans la table Reservation quand le créateur de l'annonce
	//accepter et diminue le nb de place dispo dans la ligne du trajet
	public static function AccepterDemande($id_reservation,$id_trajet)
	{
		$sql ="UPDATE RESERVATION SET reserve = 1 WHERE RESERVATION.id_reservation = $id_reservation;";
		connectPdo::getObjPdo()->exec($sql); 
		$sql = "UPDATE TRAJET SET nb_placeDispo = nb_placeDispo-1 WHERE TRAJET.id_trajet = $id_trajet;";
		connectPdo::getObjPdo()->exec($sql); 
	}


}
?>		