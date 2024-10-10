<?php

try {
	include __DIR__ . '/../includes/autoloader.php';


	$route= ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');

	$entrypoint= new \Ninja\EntryPoint($route, $_SERVER['REQUEST_METHOD'], new \ams\amsRoutes());
	$entrypoint->run();
} catch(PDOException $e) {
	$output= 'An error occured!' . $e;
	include __DIR__ . '/../templates/layout.html.php';
}