<?php

$logLocation    = "/var/www/logs/github.txt";
$scriptLocation = "/var/www/deploy.sh"

try
{
	echo("begin");
	$logheader = "====================".PHP_EOL."New Request was made".PHP_EOL."====================".PHP_EOL.PHP_EOL;
	echo("end");
	$payload = $_REQUEST['payload'];
	$payload = stripcslashes($payload);
	$payload = json_decode($payload);
echo("end2");
	//log the request
	file_put_contents($logLocation, $logheader, FILE_APPEND);
	file_put_contents($logLocation, print_r($payload, true), FILE_APPEND);
	file_put_contents($logLocation, PHP_EOL, FILE_APPEND);

	if ($payload->ref === 'refs/heads/master')
	{
		$deploy = shell_exec($scriptLocation);

		file_put_contents($logLocation, $deploy.PHP_EOL, FILE_APPEND);
	}
}
catch(Exception $e) 
{
	file_put_contents($logLocation, $e, FILE_APPEND);
	exit(0);
}