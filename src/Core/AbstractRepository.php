<?php

namespace App\Core;
use PDO;

abstract class AbstractRepository{
	
	protected $pdo;
	
	public function __construct(PDO $pdo)
	{
		$this->pdo = $pdo;
	}
	
	abstract public function getRequest();
	
	function getComplete()
	{
		$r = $this->getRequest();
	
		$dbquery = "SELECT * FROM `$r->table` $r->order";
		$stmt = $this->pdo->query($dbquery);
		$dbdata = $stmt->fetchAll(PDO::FETCH_CLASS, $r->model);
		
		if(isset($r->cat_table))
		{
			foreach($dbdata as $result)
			{
				$result->cat = $this->fetchCat($result->category, $r->cat_table, $r->cat_model);
			}
		}
		return $dbdata;
	}
	
	function getSpecific($id)
	{
		$r = $this->getRequest();
		
		$dbquery = "SELECT * FROM `$r->table` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($dbquery);
		$stmt->execute(["id" => $id]);
		
		/* PDO::FETCH_CLASS baut ein Objekt nach dem angegebenem Model*/
		$stmt->setFetchMode(PDO::FETCH_CLASS, $r->model);
		$result = $stmt->fetch(PDO::FETCH_CLASS);
		
		if(isset($r->cat_table))
		{
			$result->cat = $this->fetchCat($result->category, $r->cat_table, $r->cat_model);
		}
		return $result;
	}
	
	function getChildren($id)
	{
		$r = $this->getRequest();
		
		$dbquery = "SELECT * FROM $r->table WHERE $r->parentid = :id";
		$stmt = $this->pdo->prepare($dbquery);
		$stmt->execute(["id" => $id]);
		
		/* PDO::FETCH_CLASS baut ein Objekt nach dem angegebenem Model*/
		$result = $stmt->fetchAll(PDO::FETCH_CLASS, $r->model);

		return $result;
	}
	
	//Return the Category-Dependencies of a Post
	function fetchCat($id, $table, $model)
	{		
		
		$dbquery = "SELECT * FROM `$table` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($dbquery);
		$stmt->execute(["id" => $id]);
		
		$stmt->setFetchMode(PDO::FETCH_CLASS, $model);
		$cat = $stmt->fetch(PDO::FETCH_CLASS);
		
		return $cat;
	}
	
	function deleteEntry($table, $id)
	{
		
		$dbquery = "DELETE FROM `$table` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($dbquery);
		$stmt->execute([
			"id" => $id
		]);
		
		return true;
	}
	
	function emailNotifier($carry, $subject, $message)
	{
		$to = "";
		$from = "";
		$headers = "";

		mail($to, $subject, $message, $headers);
	}
}
?>