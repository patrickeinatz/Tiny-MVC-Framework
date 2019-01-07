<?php

namespace App\User;
use App\Core\AbstractController;

class LoginController extends AbstractController
{
	public function __construct(LoginService $loginService)
	{
    	$this->loginService = $loginService;	
	}
	
	public function logout()
	{
		$this->loginService->logout();
		header("Location: lgn");
	}
	
	public function dashboard()
	{
		$this->loginService->check();
		$this->render("User/dashboard", []);
	}
	
	public function login()
	{
		$error = false;
		if (!empty($_POST['user']) AND !empty($_POST['pass'])) 
		{
		  	$username = $_POST['user'];
		  	$password = $_POST['pass'];

			// Checken ob es in den letzten 2 Stunden mehr als 3 gescheiterte anmeldeversuche gab
			if ($this->loginService->userRepository->checkbrute($username)) 
			{
				// Konto ist blockiert 
				// Schicke E-Mail an Benutzer, dass Konto blockiert ist
				/*
				$carry = "security"; 
				$subject = "possible brute force attack";
				$message = "Für den User: {$username} wurde mehr als 3 fehlgeschlagene Anmeldeversuche innerhalb der letzten 2 Stunden registriert. Das Konto wurde vorübergehend gesperrt";
				$this->loginService->userRepository->emailNotifier($carry, $subject, $message);
				*/
					
				//post error message
				$error = "Too many attempts. Account has been locked &#128274;";
			} 
			else 
			{
				if($this->loginService->attempt($username, $password))
				{
					header("Location: dashboard");
					return;
				}
				else
				{
					$error = "Wrong Login Credentials!";
				}
			}
		}
		$this->render("User/login", [
			'error' => $error
		]);
	}
}

?>