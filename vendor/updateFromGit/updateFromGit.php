<?php
/**
 * Created by PhpStorm.
 * User: chadsfather
 * Date: 21/6/15
 * Time: 22:38
 */

if($_GET['usu'] == 'winteriscomming') {
    $cambio = shell_exec('cd /var/www/html/test/bemacadamia/');
    if($cambio) {
        $pull = shell_exec('git pull');

        if($pull) {
            die('Actualizado correctamente...');
        }

        else {
            die('Se ha producido un error...');
        }
    }
}

else {
    die('no tienes permisos...');
}

