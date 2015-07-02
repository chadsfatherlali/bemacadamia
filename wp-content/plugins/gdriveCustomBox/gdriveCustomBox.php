<?php
// Plugin Name: beMacadamia
// Plugin URI: http://www.bemacadamia.com/
// Description: Gdrive Selector
// Version: 1.0.0
// Author: Santiago Sánchez
// Author URI: http://www.bemacadamia.com/
// License: Free
// Text Domain: beMacadamia

/**
 * Created by PhpStorm.
 * User: chadsfather
 * Date: 1/7/15
 * Time: 22:56
 */

class gdriveCustomBox
{
    const CONST_TITULO_META_BOX = 'Selector Gdrive';

    public function __construct()
    {
        add_action('add_meta_boxes', function() {
            add_meta_box(
                'gdrive-prefered-img',
                self::CONST_TITULO_META_BOX,
                array($this, 'setupGdriveSelector'),
                'post',
                'side',
                'default'
            );
        });
    }

    public function setupGdriveSelector()
    {
        global $wpdb;

        $result = $wpdb->get_results("select *
        from wp_gdrive", "ARRAY_A");

        print('<pre>');
        print_r($result);
        print('</pre>');

        $html = file_get_contents(dirname(__FILE__) . '/gdriveCustomBox.html');
        echo $html;
    }
}

$gdriveCustomBox = new gdriveCustomBox();