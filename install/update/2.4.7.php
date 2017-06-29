<?php
echo "Preparing .....\n";
shell_exec('sudo mkdir -p /home/jeedomtmp >/dev/null 2>&1');
shell_exec('sudo mv /tmp/* /home/jeedomtmp >/dev/null 2>&1');
shell_exec('sudo rm -rf /tmp/jeedom* >/dev/null 2>&1');
echo "OK\n";
echo 'Relance de la mise à jour (normal). A partir de là il faut encore attendre 5 minutes.\n';
echo 'La log peut etre illisible pour suivre l\'avancement allez dans log puis choississez update.\n';
echo 'Relance de la mise à jour (normal). A partir de là il faut encore attendre 5 minutes.\n';
echo 'La log peut etre illisible pour suivre l\'avancement allez dans log puis choississez update.\n';
echo 'Relance de la mise à jour (normal). A partir de là il faut encore attendre 5 minutes.\n';
echo 'La log peut etre illisible pour suivre l\'avancement allez dans log puis choississez update.\n';
echo 'Relance de la mise à jour (normal). A partir de là il faut encore attendre 5 minutes.\n';
echo 'La log peut etre illisible pour suivre l\'avancement allez dans log puis choississez update.\n';
sleep(20);
jeedom::update();
die();
?>
