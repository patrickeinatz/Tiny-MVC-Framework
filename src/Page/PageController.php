<?php

namespace App\Page;
use App\Core\AbstractController;

class PageController extends AbstractController {
	
	public function __construct(PageRepository $pageRepository)
	{
		$this->pageRepository = $pageRepository;
	}	
	
	public function pageview()
	{
		if(!isset($_SERVER['PATH_INFO']))
		{
			$post = $this->pageRepository->getPageBySlug("/home");
		}
		else
		{
			$post = $this->pageRepository->getPageBySlug($_SERVER['PATH_INFO']);
		}
		$this->render("Page/pageview", [
			'post' => $post
		]);
	}
	public function about()
	{
		$this->render("Page/about", [

		]);
	}
}
?>