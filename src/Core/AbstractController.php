<?php

namespace App\Core;

abstract class AbstractController
{
	protected function render($view, $params)
	{
		extract($params);
		//foreach($params as $key => $value)
		//{
		//	${$key} = $value;
		//}
		include __DIR__."/../../views/{$view}.php";
	}
} 

?>