<?php
echo "Preparing .....\n";
shell_exec('sudo mkdir -p /home/jeedomtmp');
shell_exec('sudo mv /tmp /home/jeedomtmp');
jeedom::update();
die();
?>