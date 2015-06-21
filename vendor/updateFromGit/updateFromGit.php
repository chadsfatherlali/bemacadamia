<?php
/**
 * Created by PhpStorm.
 * User: chadsfather
 * Date: 21/6/15
 * Time: 22:38
 */

if($_GET['usu'] == 'winteriscomming') {
    $cambio = shell_exec('cd /var/www/html/test/bemacadamia/');
    var_dump($cambio);
    var_dump('1) Cambio hecho...');
    if($cambio) {
        $pull = shell_exec('git pull');
        var_dump($pull);
        if($pull) {
            die('2) Actualizado correctamente...');
        }

        else {
            die('Se ha producido un error...');
        }
    }
}

else {
    die('no tienes permisos...');
}

