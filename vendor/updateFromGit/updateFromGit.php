<?php
/**
 * Created by PhpStorm.
 * User: chadsfather
 * Date: 21/6/15
 * Time: 22:38
 */

if($_GET['usu'] == 'winteriscomming') {
    try {
        $cambio = shell_exec('cd /var/www/html/test/bemacadamia/');
        var_dump('1) Cambio hecho...');
        $pull = shell_exec('git pull');
        die('2) Actualizado correctamente...');
    }

    catch(Exception $e)
    {
        var_dump($e);
        die('Se ha producido un error');
    }
}

else {
    die('no tienes permisos...');
}

