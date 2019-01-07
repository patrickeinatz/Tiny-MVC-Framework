<?php

namespace App\User;

class LoginService
{
	public function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}
	
	public function attempt($username, $password)
	{
		$user = $this->userRepository->findUser($username);
		
		// User gibt es nicht
		if(empty($user))
		{
			return false;
		}
		
		
		if(password_verify($password, $user->password))
		{
			$_SESSION['login'] = $user->username;
			session_regenerate_id(true);

			return true;
		}
		else
		{
			$this->userRepository->submitAttempt($user->username);
			return false;
		}
	}
	
	public function check()
	{
		if(isset($_SESSION['login']))
		{
			return true;
		}
		else
		{
			header("Location: lgn");
			die();
		}
	}

	
	public function logout()
	{
		unset($_SESSION['login']);
		session_regenerate_id(true);
	}
}


?>