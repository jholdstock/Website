<?php

$logheader = "====================".PHP_EOL."New Request was made".PHP_EOL."====================".PHP_EOL.PHP_EOL;
try
{
	$payload = $_REQUEST['payload'];
	var_dump($payload); die;
	$payload = stripcslashes($payload);
	$payload = json_decode($payload);

	//log the request
	file_put_contents('./logs/github.txt', $logheader, FILE_APPEND);
	file_put_contents('./logs/github.txt', print_r($payload, true), FILE_APPEND);
	file_put_contents('./logs/github.txt', PHP_EOL, FILE_APPEND);

	if ($payload->ref === 'refs/heads/master')
	{
		$deploy = shell_exec("/var/www/deploy.sh");

		file_put_contents('./logs/github.txt', $deploy.PHP_EOL, FILE_APPEND);
	}
}
catch(Exception $e) 
{
	file_put_contents('./logs/github.txt', $e, FILE_APPEND);
	exit(0);
}