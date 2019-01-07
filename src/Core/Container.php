<?php

namespace App\Core;

use PDO;
use Exception;
use PDOException;

use App\Blog\BlogRepository;
use App\Blog\BlogController;
use App\Blog\CommentsRepository;
use App\Blog\BlogAdminController;

use App\Menu\MenuRepository;
use App\Menu\MenuAdminController;

use App\Work\WorkController;
use App\Work\WorkRepository;
use App\Work\WorkAdminController;

use App\Page\PageController;
use App\Page\PageRepository;
use App\Page\PageAdminController;

use App\User\UserRepository;
use App\User\LoginController;
use App\User\LoginService;

class Container
{

	private $r = [];
	private $instances = []; //build instances array
	
	public function __construct()
	{
		$this->r = [
			"MenuAdminController" => function(){
				return new MenuAdminController(
					$this->make("MenuRepository"),
					$this->make("LoginService")
				);	
			},
			"PageAdminController" => function(){
				return new PageAdminController(
					$this->make("PageRepository"),
					$this->make("LoginService")
				);	
			},
			"LoginController" => function(){
				return new LoginController(
					$this->make("LoginService")
				);	
			},
			"LoginService" => function(){
				return new LoginService(
					$this->make("UserRepository")
				);	
			},
			"BlogController" => function(){
				return new BlogController(
					$this->make("BlogRepository"),
					$this->make("CommentsRepository")
				);	
			},
			"PageController" => function(){
				return new PageController(
					$this->make("PageRepository")
				);	
			},
			"MenuRepository" => function(){
				return new MenuRepository(
					$this->make("pdo")
				);
			},
			"PageRepository" => function(){
				return new PageRepository(
					$this->make("pdo")
				);
			},
			"UserRepository" => function(){
				return new UserRepository(
					$this->make("pdo")
				);
			},
			"pdo" => function(){
				// DB SECURE DATA
				$dbserver = "";
				$dbname = ""; // ;charset=utf8 should prevent sql injection via unknown chars
				$dbuser = "";
				$dbsecret = "";

				// DB CREATE PDO FOR DATABASE ACCESS
				try{
				$pdo = new PDO(
					"mysql:host={$dbserver};dbname={$dbname}",
					$dbuser, 
					$dbsecret
					);
				}
				catch (PDOException $e){
					echo "connection to Database not possible.";
					die();
				}
				$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
				return $pdo;
			}
		];
	}
	
	public function make($name)
	{
		if(!empty($this->instances[$name]))
		{
			return $this->instances[$name];
		}
		if(isset($this->r[$name]))
		{
			$this->instances[$name] = $this->r[$name]();
		}
		return $this->instances[$name];
		
	}
}

?>