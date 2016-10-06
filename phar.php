<?php

if($argv[1] !==null && $argv[2] !==null){
	if($argv[1] == "unphar"){
		unphar($argv[2]);
	}
}

function unphar($phar){
	$folderPath = $phar;
	$folderPath = str_replace('.phar', '', $folderPath);
	$pharPath = "phar://$phar";
	foreach(new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($pharPath)) as $fInfo){
		$path = $fInfo->getPathname();
		@mkdir(dirname($folderPath . str_replace($pharPath, "", $path)), 0755, true);
		file_put_contents($folderPath . str_replace($pharPath, "", $path), file_get_contents($path));
	}
}
