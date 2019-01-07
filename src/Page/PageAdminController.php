<?php

namespace App\Page;

use App\Core\AbstractController;
use App\User\LoginService;

class PageAdminController extends AbstractController{
	
	public function __construct (PageRepository $pageRepository, LoginService $loginService)
	{
		
		$this->pageRepository = $pageRepository;
		$this->loginService = $loginService;
	}
	
	
	public function listPages()
	{
		$this->loginService->check();
		
		$pageItems = $this->pageRepository->getComplete();
		
		$this->render("Page/adm/adm-page-view",[
			"pageItems" => $pageItems
		]);
	}
	
	public function editPage()
	{
		
		$this->loginService->check();
		
		$id = $_GET["id"];
		
		$pageItem = $this->pageRepository->getSpecific($id);
		
		if(isset($_POST["title"]) AND isset($_POST["slug"]))
		{
			$this->pageRepository->updatePageItem($id, $_POST);
		}
		
		
		$this->render("Page/adm/adm-page-edit",[
			"pageItem" => $pageItem
		]);
	}
	
	public function addPage()
	{
		$this->loginService->check();
		
		if(isset($_POST["title"]) AND isset($_POST["slug"]))
		{
			$this->pageRepository->addPageItem($_POST);
		}
		
		$this->render("Page/adm/adm-page-add",[
			
		]);
	}
	
	public function deletePage()
	{
		$this->loginService->check();
		
		$id = $_GET["id"];
		
		$this->pageRepository->deletePageItem($id);
		
		header("Location: adm-page-view");
	}
}

?>