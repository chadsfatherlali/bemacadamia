<?php
// Plugin Name: beMacadamia
// Plugin URI: http://www.bemacadamia.com/
// Description: Redirect Temporal
// Version: 1.0.0
// Author: Santiago Sánchez
// Author URI: http://www.bemacadamia.com/
// License: Free
// Text Domain: beMacadamia

/**
 * Created by PhpStorm.
 * User: chadsfather
 * Date: 25/5/15
 * Time: 2:03
 */

class RedirectTemp
{
    public function __construct()
    {
        if(strpos($_SERVER['HTTP_HOST'], 'bemacadamia.com') !== false
                || strpos($_SERVER['HTTP_HOST'], 'bemacadamia.es') !== false) {
            header('Location: https://instagram.com/be_macadamia/');
            exit;
        }
    }
}

$redirect = new RedirectTemp();