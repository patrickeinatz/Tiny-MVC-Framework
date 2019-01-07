<?php

namespace App\Core;

use ArrayAccess;

abstract class AbstractModel implements ArrayAccess{
	
	public function createExcerpt($limit)
	{		
		$tok = strtok($this->content, " ");
		while ($tok !== false) {
			$text .= " ".$tok;
			$words++;
			if (($words >= $limit) && ((substr($tok, -1) == "!") || (substr($tok, -1) == ".") || (substr($tok, -1) == "?"))) 
			{
				break;
			}
		$tok = strtok(" ");
		}
		return $text;
	}
	
	//ARRAY ACCESS STUFF
    public function offsetExists($offset) 
	{
		return isset($this->$offset);
    }
	
	public function offsetGet($offset)
	{
		return $this->$offset;
    }
	
	public function offsetSet($offset, $value) 
	{
		$this->$offset = $value;
    }

    public function offsetUnset($offset)
	{
		unset($this->$offset);
    }
}


?>