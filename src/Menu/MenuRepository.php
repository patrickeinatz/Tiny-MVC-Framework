<?php
namespace App\Menu;

use PDO;
use App\Core\AbstractRepository;

class MenuRepository extends AbstractRepository
{
	public function getRequest()
	{
		$request = new \stdClass();
		$request->table = "menu";
		$request->order = "";
		$request->model = "App\\Menu\\MenuModel";
		return $request;
	}
	
	//FUNCTIONS - MENU
	public function fetchMenuItems($pos)
	{
		$dbquery = "SELECT * FROM `menu` WHERE `pos` = {$pos}";
		return $this->pdo->query($dbquery);
	}
	
	public function updateMenuItem($id, $obj)
	{
		$r = $this->getRequest();
		
		$stmt = $this->pdo->prepare("UPDATE `{$r->table}` SET title = :title, slug = :slug, pos = :pos WHERE id = :id");
		
		$stmt->execute([
			"id" => $id,
			"title" => $obj["title"],
			"slug" => $obj["slug"],
			"pos" => $obj["pos"]
		]);
		
		header("Location: adm-menu-view");
	}

	public function addMenuItem($obj)
	{
		$r = $this->getRequest();
		
		$stmt = $this->pdo->prepare("INSERT INTO {$r->table} (title, slug, pos) VALUES (:title, :slug, :pos)");
		
		$stmt->execute([
			"title" => $obj["title"],
			"slug" => $obj["slug"],
			"pos" => $obj["pos"]
		]);
		
		header("Location: adm-menu-view");
	}
	
	public function deleteMenuItem($id)
	{
		$r = $this->getRequest();
		
		$stmt =$this->pdo->prepare("DELETE FROM {$r->table} WHERE id = :id");
		$stmt->execute([
			"id" => $id
		]);
	}
	
}


?>