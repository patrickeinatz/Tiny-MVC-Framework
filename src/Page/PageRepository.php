<?php

namespace App\Page;

use PDO;
use App\Core\AbstractRepository;

class PageRepository extends AbstractRepository
{
	public function getRequest()
	{
		$request = new \stdClass();
		$request->table = "pages";
		$request->order = "";
		$request->model = "App\\Page\\PageModel";
		return $request;
	}
	
	public function getPageBySlug($slug)
	{
		$r = $this->getRequest();
		
		$dbquery = "SELECT * FROM `$r->table` WHERE `slug` = :slug";
		$stmt = $this->pdo->prepare($dbquery);
		$stmt->execute([
			"slug" => $slug
		]);
		/* PDO::FETCH_CLASS baut ein Objekt nach dem angegebenem Model*/
		$stmt->setFetchMode(PDO::FETCH_CLASS, $r->model);
		$result = $stmt->fetch(PDO::FETCH_CLASS);
		
		return $result;
	}
	
	public function updatePageItem($id, $obj)
	{	
		$r = $this->getRequest();
		
		$stmt = $this->pdo->prepare("UPDATE `{$r->table}` SET title = :title, content = :content, slug = :slug WHERE id = :id");
		
		$stmt->execute([
			"id" => $id,
			"title" => $obj["title"],
			"content" => $obj["content"],
			"slug" => $obj["slug"]
		]);
		
		header("Location: adm-page-view");
	}
	
	public function addPageItem($obj)
	{
		$r = $this->getRequest();
		
		$stmt = $this->pdo->prepare("INSERT INTO {$r->table} (title, content, slug) VALUES (:title, :content, :slug)");
		
		$stmt->execute([
			"title" => $obj["title"],
			"content" => $obj["content"],
			"slug" => $obj["slug"]
		]);
		
		header("Location: adm-page-view");
	}
	
	public function deletePageItem($id)
	{
		$r = $this->getRequest();
		
		$stmt =$this->pdo->prepare("DELETE FROM {$r->table} WHERE id = :id");
		$stmt->execute([
			"id" => $id
		]);
	}
	
}
?>