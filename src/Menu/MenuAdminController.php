<?php

namespace App\Menu;

use App\Core\AbstractController;
use App\User\LoginService;

class MenuAdminController extends AbstractController{
	
	public function __construct (MenuRepository $menuRepository, LoginService $loginService)
	{
		
		$this->menuRepository = $menuRepository;
		$this->loginService = $loginService;
	}
	
	public function listMenu()
	{
		$this->loginService->check();
		
		$menuItems = $this->menuRepository->getComplete();
		
		$this->render("Menu/adm/adm-menu-view",[
			"menuItems" => $menuItems
		]);
	}
	
	public function editMenu()
	{
		$this->loginService->check();
		
		$id = $_GET["id"];
		
		$menuItem = $this->menuRepository->getSpecific($id);
		
		if(isset($_POST["title"]) AND isset($_POST["slug"]))
		{
			$this->menuRepository->updateMenuItem($id, $_POST);
		}
		
		
		$this->render("Menu/adm/adm-menu-edit",[
			"menuItem" => $menuItem
		]);
	}
	
	public function addMenu()
	{
		$this->loginService->check();
		
		if(isset($_POST["title"]) AND isset($_POST["slug"]))
		{
			$this->menuRepository->addMenuItem($_POST);
		}
		
		$this->render("Menu/adm/adm-menu-add",[
			
		]);
	}
	
	public function deleteMenu()
	{
		$this->loginService->check();
		
		$id = $_GET["id"];
		
		$this->menuRepository->deleteMenuItem($id);
		
		header("Location: adm-menu-view");
	}
	
}
?>