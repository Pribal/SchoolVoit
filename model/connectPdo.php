<?php

class connectPdo 
{
	private static $db; 
	
	private function __construct(){} 
	
	static function getObjPdo() {
		 
		if(!isset(self::$db))
		{ 
		self::$db = new PDO('mysql:Host=mysql-schoolvoit.alwaysdata.net;dbname=schoolvoit_db', '288199', '@SchoolvoiT@'); 
		self::$db ->query('SET NAMES utf8'); 
		self::$db->query('SET CHARACTER SET utf8');   
		} 
		return self::$db; 
    }
}

?>