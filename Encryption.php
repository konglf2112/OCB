<?php
	function encrypt($data, $key)
	{
		$char = '';
		$str = '';
		$key	=	md5($key);
		$x		=	0;
		$len	=	strlen($data);
		$l		=	strlen($key);
		for ($i = 0; $i < $len; $i++)
		{
			if ($x == $l) 
			{
				$x = 0;
			}
			$char .= $key{$x};
			$x++;
		}
		for ($i = 0; $i < $len; $i++)
		{
			$str .= chr(ord($data{$i}) + (ord($char{$i})) % 256);
		}
		return utf8_encode($str);
	}
	
	
	function decrypt($data, $key)
	{
		$char = '';
		$str = '';
		$key = md5($key);
		$x = 0;
		$data = utf8_decode($data);
		$len = strlen($data);
		$l = strlen($key);
		for ($i = 0; $i < $len; $i++)
		{
			if ($x == $l) 
			{
				$x = 0;
			}
			$char .= substr($key, $x, 1);
			$x++;
		}
		for ($i = 0; $i < $len; $i++)
		{
			if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1)))
			{
				$str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
			}
			else
			{
				$str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
			}
		}
		return $str;
	}
?>