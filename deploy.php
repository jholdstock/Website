<?php


echo "start";
$output = shell_exec("/scripts/deploy.sh");
echo "<pre>$output</pre>";
echo "end";