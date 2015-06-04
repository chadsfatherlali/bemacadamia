<?php
// Plugin Name: beMacadamia
// Plugin URI: http://www.bemacadamia.com/
// Description: Tokens Manager plugin para controlar los textos estaticos del site
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

class tokensManager
{
    const CONST_TITULO_PLUGIN = 'Token Manager';

    public function __construct()
    {
        add_action('admin_menu', array($this, 'setupAdminMenu'));
    }

    public function setupAdminMenu()
    {
        add_object_page(self::CONST_TITULO_PLUGIN, self::CONST_TITULO_PLUGIN, 'activate_plugins', 'token-manager', array($this, 'adminPage'));
    }

    public function adminPage()
    {
        global $wpdb;

        $url = 'http://' . $_SERVER['SERVER_NAME'] . '/wp-content/plugins/tokensManager/tokensDataRequest.php';
        $labels = $wpdb->get_results('select * from wp_text_labels', 'ARRAY_A');

        $html = file_get_contents(dirname(__FILE__) . '/staticFiles/tokensManager.html');
        $html = str_replace('{{ url_request_path }}', $url, $html);
        $html = str_replace('{{ labels }}', json_encode($labels, true), $html);

        echo $html;

    }

    public static function setText($id)
    {
        global $wpdb;

        $result = $wpdb->get_results("select text
	    from wp_text_labels
	    where id = '$id'", "ARRAY_A");

        echo $result[0]['text'];
    }

}

$tokensManager = new tokensManager();