<?php
/**
 * Created by PhpStorm.
 * User: chadsfather
 * Date: 29/5/15
 * Time: 19:46
 */

require(__DIR__ . '/../../../vendor/autoload.php');

/**
 * Classe que se encarga de comunicar el frotn con el back
 *
 * Class tokensDataRequest
 */
class tokensDataRequest
{
    /**
     * Constructor de la classe
     *
     * @param $get
     */
    public function __construct($get)
    {
        call_user_func(array($this, $get['accion']), $get['data']);
    }

    /**
     * Se guardan los textos en la base de datos
     *
     * @param $data
     */
    private function save($data)
    {
        $wpdb = wpdbobject::getwpdobject();

        $id = $data['id'];
        $text = $data['text'];
        $reference = $data['reference'];

        $update = $wpdb->query("update wp_text_labels
		set text = '$text', reference = '$reference'
		where id = '$id'", "ARRAY_A");

        echo $update;
    }
}

/** @var  $tokensDataRequest */
$tokensDataRequest = new tokensDataRequest($_REQUEST);