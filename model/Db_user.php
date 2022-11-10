<?php
include 'connectPdo.php';

class DbUser{
	
    public static function getUser($email,$password)
	{
		$sql = "SELECT email,mdp FROM USER WHERE email = '$email' AND mdp = '$password';";		
		$objResultat = connectPdo::getObjPdo()->query($sql);	
		$result = $objResultat->fetch();
		return $result;    
	}

	public static function getInfoUser($email)
	{
		$sql = "SELECT email, nom, prenom FROM USER WHERE email = '$email';";		
		$objResultat = connectPdo::getObjPdo()->query($sql);	
		$result = $objResultat->fetchAll();
		return $result;
	}

	public static function getCarUser($email)
	{
		$sql = "SELECT matricule, marque, modele,id_car
		FROM USER, VEHICULE
		WHERE USER.id_user = VEHICULE.id_user
		AND USER.email = '$email';";		
		$objResultat = connectPdo::getObjPdo()->query($sql);	
		$result = $objResultat->fetchAll();
		return $result;  
	}

	public static function AddCarUser($email,$matricule,$marque,$modele)
	{
		$sql = "INSERT INTO VEHICULE (id_car, matricule, marque, modele, id_user) VALUES (NULL, '$matricule', '$marque', '$modele', 
		(SELECT id_user
		FROM USER 
		WHERE email='$email'));";		
    	connectPdo::getObjPdo()->exec($sql);
	}

	public static function DelCarUser($id_car)
	{
		$sql = "DELETE FROM VEHICULE WHERE VEHICULE.id_car = $id_car;";	
    	connectPdo::getObjPdo()->exec($sql);
	}

	public static function getModifCar($id_car)
	{
		$sql = "SELECT matricule,marque,modele,id_car FROM USER,VEHICULE WHERE USER.id_user = VEHICULE.id_user AND VEHICULE.id_car = $id_car";	
		$objResultat = connectPdo::getObjPdo()->query($sql);	
		$result = $objResultat->fetchAll();
		return $result;  
	}

	public static function modifCar($id_car,$matricule,$marque,$modele)
	{
		$sql = "UPDATE VEHICULE SET matricule = '$matricule', marque = '$marque', modele = '$modele' WHERE VEHICULE.id_car = $id_car;";
		$objResultat = connectPdo::getObjPdo()->exec($sql);
	}

}
?>
