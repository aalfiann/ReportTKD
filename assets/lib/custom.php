<?php 

//Library
	function curl_get_contents($url)
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,0);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}	

	function integeronly($string)
	{
		$nn = preg_replace("/[^0-9]/", "", $string );
		return $nn;
	}

	//Format number 
	function formatBytes($bytes, $precision = 2) 
	{ 
    	$units = array('B', 'KB', 'MB', 'GB', 'TB'); 

	    $bytes = max($bytes, 0); 
    	$pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
	    $pow = min($pow, count($units) - 1); 

    	// Uncomment one of the following alternatives
	    $bytes /= pow(1024, $pow);
    	// $bytes /= (1 << (10 * $pow)); 

	    return round($bytes, $precision) . ' ' . $units[$pow]; 
	} 

?>