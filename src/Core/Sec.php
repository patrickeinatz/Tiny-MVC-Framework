<?php

namespace App\Core;

class Sec{

	public function e($str)
	{
		return htmlentities($str, ENT_QUOTES, "UTF-8");		
	}

}

?>