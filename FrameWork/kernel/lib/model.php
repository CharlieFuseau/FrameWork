<?php
require_once(LIB."connexion.php");
class model extends connexion
{
	
	protected $table;
	protected $primary;
	
	
	public function __construct($t,$p)
	{
			$this->table = $t;
			$this->primary = $p;
			$this->arraysis = array("table","primary","arraysis");
			
	}
	
	public function Find($cond=1) //fonctionne avec 1 argument
	{
		//je prepare la requete
		$sql = "SELECT * FROM {$this->table} where $cond"; 
		// si $cond commence par SELECT remplacer $sql par $cond 
		if (substr($cond, 0, 6) == "SELECT")
		{
			// echo $cond;
			if(strpos($cond,"WHERE"))
			{
				$id = 0;
				// $id = str_replace(6,$id,$cond);
				$cond = str_replace("WHERE*","WHERE {$this->primary}=$id;",$cond);
				
				// echo $cond;
			} 
			
			$sql = $cond;	
		} 
		//je me co
		
		$dbh = $this->connex();
		// j'execute la requete
		$resultat = $dbh->query($sql);
		// je me deco
		$dbh = null;
		//traitement parcours du curseur
		while ($data = $resultat->fetch(PDO::FETCH_ASSOC))
		{
			$tableau[] = $data;	
		}
		return($tableau);
	}	
	
	public function Read($id) //fonctionne
	{
		
		$sql  = "SELECT * FROM  {$this->table} where {$this->primary}=$id;";
		// si $id commence par SELECT remplacer $sql par $id 
		// if (substr($id, 0, 6) == "SELECT")  {$sql = $id;}
		$dbh = $this->connex(); 
		$res = $dbh->query($sql);	
		$dbh = null;
		
		$data = $res->fetch(PDO::FETCH_ASSOC);
		foreach ($data as $key => $val)
		{
		$this->$key = $val;	
		}	
	}
	
	public function Del($id) //fonctionne
	{
		//je prepare la requete
		$sql = "Delete FROM {$this->table} where {$this->primary}=$id;";
		//je me co
		$dbh = $this->connex();
		// j'execute la requete
		$res = $dbh->exec($sql);
		// je me deco
		$dbh = null;
	}	
	
	public function Create() //fonctionne
	{	
		$cols = "";
		$vals = "";
		$sql = " INSERT INTO {$this->table} ";
		foreach ($this as $k => $v)
		{
			if (!in_array($k,$this->arraysis)&&($k != $this->primary))
			{
				$cols = $cols.$k.',' ;
				$vals = $vals."'".$v."'".',' ;
			}
		}
		$cols = substr($cols,0,-1);
		$vals = substr($vals,0,-1);
		$sql = $sql."(".$cols.")". "VALUES" ."(". $vals.")";
		$dbh = $this->connex();
		// j'execute la requete
		$res = $dbh->exec($sql);
		// je me deco
		$dbh = null;
	}
	
	public function Update() //fonctionne
	{	
		$key =$this->primary;
		$id = $this->$key;
	  
		$sql  = " Update {$this->table} SET "; 
		foreach($this as $k => $v)
		{
			if (!in_array($k, $this->arraysis))
			{
				$sql = $sql.$k."='".$v."',";
			}
		}
		$sql = substr($sql,0,-1);
		$sql = $sql."where {$this->primary} = '$id'"; 
		$dbh = $this->connex(); 
		$res = $dbh->exec($sql);	
		$dbh = null;	
	}
	
	
	 
	public function postToModel() //fonctionne
	{
		foreach( $_POST as $k=>$v )
		{
		$this->$k = $v;
		}
	}
	
	public function totable () //fonctionne
	{
		foreach ($this as $k => $v)
		{
			$data[$k] = $v;
		}
		return $data;
	}
	
	
}
?>
