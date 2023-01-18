<?php	
	$familia1 = array("cod" => "CONSOL", "nombre" => "Consolas");
	$familia2 = array("cod" => "TV", "nombre" => "Televisores");
	$familias = array($familia1, $familia2);
	$json = json_encode($familias);	
	echo $json;