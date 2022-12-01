<?php
include 'connectPdo.php';

class DbReservation{
	//Récuperer les annonces publiés de l'utilisateur
	public static function getAnnoncebyID($id)
	{
		$sql = "SELECT * from trajet, vehicule where trajet.id_car = vehicule.id_car and trajet.id_user = $id;";		
		$objResultat = connectPdo::getObjPdo()->query($sql);	
		$result = $objResultat->fetchAll();
		return $result;    
	}

	//Récuperer les annonces réservé par l'utilisateur
	public static function getReservationbyID($id)
	{
		$sql = "SELECT *
		FROM reservation, user, trajet
		WHERE reservation.id_trajet = trajet.id_trajet
		AND trajet.id_user = user.id_user
		AND reservation.id_user = $id";
		$objResultat = connectPdo::getObjPdo()->query($sql);	
		$result = $objResultat->fetchAll();
		return $result;   
	}

	//Récuperer les demandes de validation des annonces de l'utilisateur
	public static function getDemandeValidAnnonce($id)
	{
		$sql = "SELECT * FROM reservation, trajet, user 
		WHERE reservation.id_trajet = trajet.id_trajet
		AND trajet.id_user = user.id_user
		AND trajet.id_user = $id
		AND reservation.reserve = 0";
		$objResultat = connectPdo::getObjPdo()->query($sql);	
		$result = $objResultat->fetchAll();
		return $result;   
	}

	public static function RefuserDemande($id_reservation)
	{
		$sql = "DELETE FROM reservation WHERE reservation.id_reservation = $id_reservation;";
		connectPdo::getObjPdo()->exec($sql);    
	}

	//Change la valeur de reserve a 1 (Reservation validé) dans la table Reservation quand le créateur de l'annonce
	//accepter et diminue le nb de place dispo dans la ligne du trajet
	public static function AccepterDemande($id_reservation)
	{
		$sql ="UPDATE reservation SET reserve = 1 WHERE reservation.id_reservation = $id_reservation;";
		connectPdo::getObjPdo()->exec($sql); 
	}

	public static function SoustraitnbPlace($id_trajet)
	{
		$sql = "UPDATE trajet SET nb_placeDispo = nb_placeDispo - 1 WHERE trajet.id_trajet = $id_trajet;";
		connectPdo::getObjPdo()->exec($sql); 
	}


}
?>		