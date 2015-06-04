<?php
// Plugin Name: beMacadamia
// Plugin URI: http://www.bemacadamia.com/
// Description: Gdrive manager para manejar las fotos almacenada em gdrive
// Version: 1.0.0
// Author: Santiago Sánchez
// Author URI: http://www.bemacadamia.com/
// License: Free
// Text Domain: beMacadamia

/**
 * Created by PhpStorm.
 * User: chadsfather
 * Date: 26/5/15
 * Time: 22:22
 */

class gDriveManager
{
    const CONST_TITULO_PLUGIN = 'gDrive Manager';

    public function __construct()
    {
        add_action('admin_menu', array($this, 'setupAdminMenu'));
    }

    public function setupAdminMenu()
    {
        add_object_page(self::CONST_TITULO_PLUGIN, self::CONST_TITULO_PLUGIN, 'activate_plugins', 'gDrive-manager', array($this, 'adminPage'));
    }

    public function adminPage()
    {
        global $wpdb;

        $url = 'http://' . $_SERVER['SERVER_NAME'] . '/wp-content/plugins/tokensManager/tokensDataRequest.php';
        $url_gdrive = 'http://' . $_SERVER['SERVER_NAME'] . '/vendor/googleapi/googleapi.php';

        $images = $wpdb->get_results('select * from wp_gdrive', 'ARRAY_A');
        $result_db = $_GET['updatedb']? $_GET['updatedb'] : 'noaction';

        $html = file_get_contents(dirname(__FILE__) . '/staticFiles/gDriveManager.html');
        $html = str_replace('{{ url_request_path }}', $url, $html);
        $html = str_replace('{{ images }}', json_encode($images, true), $html);
        $html = str_replace('{{ result_db }}', $result_db, $html);
        $html = str_replace('{{ url_gdrive }}', $url_gdrive, $html);

        echo $html;
    }

}

$gDriveManager = new gDriveManager();