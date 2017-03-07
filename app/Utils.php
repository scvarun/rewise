<?php

namespace App;

class Utils {
	public static function underscore($str, array $noStrip = [])
	{
    // non-alpha and non-numeric characters become spaces
    $str = preg_replace('/[^a-z0-9' . implode("", $noStrip) . ']+/i', ' ', $str);
    $str = trim($str);
    $str = str_replace(" ", "_", $str);
    $str = strtolower($str);

    return $str;
	}
}

?>
