<?php

namespace App\User;

use PDO;
use App\Core\AbstractRepository;

class UserRepository extends AbstractRepository
{

	public function getRequest()
	{
		$request->table = 		"users";
		$request->model = 		"App\\User\\UserModel";
		return $request;
	}
	
	public function findUser($username)
	{
		$r = $this->getRequest();
		$stmt = $this->pdo->prepare("SELECT * FROM `$r->table` WHERE username = :username");
		$stmt->execute([
			"username" => $username
		]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, $r->model);
		$data = $stmt->fetch(PDO::FETCH_CLASS);

		return $data;
	}
	
	public function submitAttempt($user)
	{
		$now = time();
		
		$stmt = $this->pdo->prepare("INSERT INTO `login_attempts` (user, time) VALUES (:username, :time)");
		$stmt->execute([
			"username" => $user,
			"time" => $now
		]);
	}
	
	public function checkbrute($user) 
	{
		// Hole den aktuellen Zeitstempel 
		$now = time();

		// Alle Login-Versuche der letzten zwei Stunden werden gezählt.
		$valid_attempts = $now - (2 * 60 * 60);

		if ($stmt = $this->pdo->prepare(("SELECT time FROM login_attempts WHERE user = :user AND time > :time "))) 
		{

			// Führe die vorbereitet Abfrage aus. 
			$stmt->execute([
				"user" => $user,
				"time" => $valid_attempts
			]);
			// Wenn es mehr als 3 fehlgeschlagene Versuche gab 
			if ($stmt->rowCount() > 3) {
				return true;
			} else {
				return false;
			}
		}
	}
	
}
?>