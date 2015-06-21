<?php
/**
 * Created by PhpStorm.
 * User: chadsfather
 * Date: 21/6/15
 * Time: 22:38
 */

print_r($_REQUEST);
die;
if($_GET['usu'] == 'winteriscomming') {
    try {
        $cambio = exec('cd /var/www/html/test/bemacadamia/ && git pull git@github.com:chadsfatherlali/bemacadamia.git');
        die('Actualizado correctamente...');
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

