<?php
/**
 * Created by PhpStorm.
 * User: chadsfather
 * Date: 21/6/15
 * Time: 22:38
 */

if($_GET['usu'] == 'winteriscomming') {
    try {
        print_r($_REQUEST);
        $cambio = exec('cd /var/www/html/test/bemacadamia/ && git pull', $proceso);
        print_r($proceso);
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

