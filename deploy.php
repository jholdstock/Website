<?php

shell_exec("/scripts/deploy.sh");

echo "start";
$output = shell_exec("/var/www/deploy.sh");
echo "<pre>$output</pre>";
echo "end";