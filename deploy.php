<?php

shell_exec("/var/www/deploy.sh");

$output = shell_exec("/var/www/deploy.sh");
echo "<pre>$output</pre>";