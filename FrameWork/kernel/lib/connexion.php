<?php
//Charlie Fuseau
//class connexion
//permet de fournir la fonction connex a toute les fonctions read, delete,... 
//afin de centraliser les informations de connexion dans ce fichier 

class connexion
{
	public function connex()
	{
		$dbh = new PDO("mysql:dbname=NAMEBDD;host=localhost","LOGIN"," PASSWORD"); 
		return($dbh);
	}
}


?>