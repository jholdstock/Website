<?php

$scriptLocation = "/var/www/deploy.sh";

try
{
	$payload = $_REQUEST['payload'];
	$payload = stripcslashes($payload);
	$payload = json_decode($payload);

	if ($payload->ref === 'refs/heads/master')
	{
		$deploy = shell_exec($scriptLocation);
	}
}
catch(Exception $e) 
{
	exit(0);
}