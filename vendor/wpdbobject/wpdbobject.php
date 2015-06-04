<?php
/**
 * Created by PhpStorm.
 * User: chadsfather
 * Date: 29/5/15
 * Time: 23:55
 */

class wpdbobject
{
    public static function getwpdobject() {
        $name = explode(".", $_SERVER["HTTP_HOST"]);
        $name = $_SERVER["DOCUMENT_ROOT"] . "/" . $name[0] . "/wp-load.php";
        include_once($name);

        global $wpdb;

        return $wpdb;
    }
}