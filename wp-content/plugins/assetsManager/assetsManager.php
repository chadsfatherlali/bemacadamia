<?php
// Plugin Name: beMacadamia
// Plugin URI: http://www.bemacadamia.com/
// Description: Assets Manager for beMacadamia Web site
// Version: 1.0.0
// Author: Santiago Sánchez
// Author URI: http://www.bemacadamia.com/
// License: Free
// Text Domain: beMacadamia

/**
 * Created by PhpStorm.
 * User: chadsfather
 * Date: 17/5/15
 * Time: 18:40
 */


use MatthiasMullie\Minify;


require(__DIR__ . '/../../../vendor/autoload.php');

/**
 * Classe encargada de administrar los fichreos JS y CSS de las paginas
 *
 * Class assetsManager
 */
class assetsManager
{
    /** @var string Caminos hacia los assets js o css */
    private $pathAssets;
    /** @var  Camino a los Js minificados */
    private $JSminifier;
    /** @var  Camino a los Css minificados */
    private $CSSminifier;
    /** @var  Objeto  $wp_query_object */
    private $pageName;
    /**
     * Constructor de la classe
     */
    public function __construct()
    {
        add_action('wp', function() {
            global $wp_query;

            $this->pageName = $wp_query->query['pagename'];
            //$this->pathAssets = __DIR__ . '/../../../wp-content/themes/twentyfifteen/customAssets/';
            //$this->MinCss();
            //$this->MinJs();
            $this->setAssetsToHeader();
        });
    }

    /**
     * Inicio del minificado del html
     */
    public static function __obStart() {
        if(!isset($_GET['minhtml'])) {
            ob_start(function ($buffer) {
                $search = array(
                    '/\>[^\S ]+/s',
                    '/[^\S ]+\</s',
                    '/(\s)+/s'
                );

                $replace = array(
                    '>',
                    '<',
                    '\\1'
                );

                $buffer = preg_replace($search, $replace, $buffer);

                return $buffer;
            });
        }
    }

    /**
     * Fin del minificado del html
     */
    public static function __obEnd() {
        if(!isset($_GET['minhtml'])) {
            ob_end_flush();
        }
    }

    /**
     * Establece en el header los Css y Js minificados
     */
    private function setAssetsToHeader()
    {

        $pageName = $this->pageName? $this->pageName : 'index';
        $pageName = is_single()? 'post' : $pageName;

        $assetsCss = '<link rel=\'stylesheet\' href=\'/wp-content/themes/twentyfifteen/customAssets/css/' . $pageName . '.css\'/>';
        $assetsJs = '<script src=\'/wp-content/themes/twentyfifteen/customAssets/js/' . $pageName . '.js\'></script>';

        add_action('wp_head', function() use($assetsCss) {
            echo $assetsCss;
        });

        add_action('wp_footer', function() use($assetsJs) {
            echo $assetsJs;
        });
    }

    /**
     * Minifica los Css
     */
    private function MinCss()
    {
        $css = array(
            'css/bootstrap.css',
            'css/common.css',
            $this->getPageAssets('css')
        );

        foreach($css as $file) {
            $f = $this->pathAssets . $file;

            if(!$this->CSSminifier) {
                $this->CSSminifier = new MatthiasMullie\Minify\CSS($f);
            }

            else {
                $this->CSSminifier->add($f);
            }
        }

        $this->CSSminifier->minify($this->pathAssets . 'css/common.min.css');
    }

    /**
     * Minifica los Js
     */
    private function MinJs()
    {
        $js = array(
            'js/bootstrap.js',
            'js/plugins.js',
            'js/common.js',
            $this->getPageAssets('js')
        );

        foreach($js as $file) {
            $f = $this->pathAssets . $file;

            if(!$this->JSminifier) {
                $this->JSminifier = new MatthiasMullie\Minify\JS($f);
            }

            else {
                $this->JSminifier->add($f);
            }
        }

        $this->JSminifier->minify($this->pathAssets . 'js/common.min.js');
    }

    /**
     * Obtiene los assets de cada pagina
     *
     * @param $key
     * @return string
     */
    private function getPageAssets($key)
    {
        $pageName = $this->pageName? $this->pageName : 'index';
        $pageName = is_single()? 'post' : $pageName;

        if($_REQUEST['page_name'] == '1') var_dump($pageName);

        $result = '';

        switch($key) {
            case 'css':
                $result = 'css/' . $pageName . '.css';
                break;

            case 'js';
                $result = 'js/' . $pageName . '.js';
                break;
        }

        return $result;
    }

    /**
     * Retorna la imagen pedida
     *
     * @param $folder
     * @param $file
     * @return string
     */
    public static function getPathImages($folder, $file)
    {
        return '/wp-content/themes/' . wp_get_theme() . '/images/' . $folder . '/' . $file;
    }


    /**
     * Retorna la imagen svg
     *
     * @param $folder
     * @param $file
     * @return string
     */
    public static function getSvgImages($folder, $file)
    {
        $dir = dirname(__FILE__) . '/../../../wp-content/themes/' . wp_get_theme() . '/images/' . $folder . '/' . $file . '.svg';
        echo file_get_contents($dir);
    }

    public static function getGdriveImages($id)
    {
        $wpdb = wpdbobject::getwpdobject();

        if(is_int($id)) {
            $result = $wpdb->get_results("select Json
            from wp_gdrive
            where id = $id", "ARRAY_A");
        }

        else {
            $result = $wpdb->get_results("select Json
            from wp_gdrive
            where folder_id = '$id'", "ARRAY_A");
        }

        return unserialize($result[0]['Json']);
    }

    /**
     * Anade variables js la pagina
     *
     * @param $key
     * @param $value
     */
    public static function addJsVar($key, $value)
    {
        if(!is_int($value)) {
            $value = '"' . $value . '"';
        }

        $content = '<script>var ' . $key . ' = ' . $value . ";</script>";

        add_action('wp_head', function() use($content) {
            echo $content;
        });
    }
}

/** @var  $assetsManager */
$assetsManager = new assetsManager();