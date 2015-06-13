<?php
/**
 * Created by PhpStorm.
 * User: chadsfather
 * Date: 9/6/15
 * Time: 23:25
 */

require(dirname(__FILE__) . '/../autoload.php');

class cart
{
    private $wpdb;

    public function __construct($request)
    {
        $this->wpdb = wpdbobject::getwpdobject();
        call_user_func(array($this, $request['accion']), $request);
    }

    public static function getItems($hash)
    {
        global $wpdb;

        if($_COOKIE['cart']) {
            $cart = $wpdb->get_results("select *
            from wp_cart
            where hash = '$hash'", "ARRAY_A");

            return $cart[0];
        }
    }

    public static function getTotalItems()
    {
        global $wpdb;

        $total = 0;

        if($_COOKIE['cart']) {
            $hash = $_COOKIE['cart'];

            $cart = $wpdb->get_results("select *
            from wp_cart
            where hash = '$hash'", "ARRAY_A");

            $array = json_decode($cart[0][json], true);
            $total = 0;

            foreach($array as $item) {

                $total = $total + $item['cantidad'];
            }
        }

        echo $total;

    }

    private function delete($request)
    {
        global $wpdb;

        $hash = $request['hash'];
        $id = $request['id'];

        $delete = $wpdb->get_results("select *
        from wp_cart
        where hash = '$hash'", "ARRAY_A");

        if($delete) {
            $json = json_decode($delete[0]['json'], true);
            unset($json[$id]);

            $producto = json_encode($json);

            $updateObject = $this->wpdb->query("update wp_cart
            set json = '$producto'
            where hash = '$hash'", "ARRAY_A");

            if($updateObject) {
                header('Content-Type: application/json');
                echo $producto;
            }

            else {
                echo 'ko';
            }
        }

        else {
            echo 'ko';
        }
    }

    private function save($request)
    {
        $hash = $request['hash'];

        $prevObj = $this->wpdb->get_results("select *
        from wp_cart
        where hash = '$hash'", "ARRAY_A");

        if($prevObj) {
            $this->compareObjects(json_decode($prevObj[0]['json'], true), $request);
        }

        else {
            $producto = array();
            $producto[] = $request;
            $tosave = json_encode($producto);

            $saveObject = $this->wpdb->query("insert
            into wp_cart
            (hash, json)
            values ('$hash', '$tosave')", "ARRAY_A");

            if($saveObject) {
                header('Content-Type: application/json');
                echo $tosave;
            }

            else {
                echo 'ko';
            }
        }
    }

    private function areEquals(array $arr1, array $arr2) {
        $op1 = $arr1['talla'] === $arr2['talla'];
        $op2 = $arr1['color'] === $arr2['color'];
        $op3= $arr1['producto'] === $arr2['producto'];
        $op4= $arr1['precio'] === $arr2['precio'];

        if($op1 && $op2 && $op3 && $op4) {
            return true;
        }

        return false;
    }

    private function compareObjects ($prev, $current)
    {
        $keyEqual = null;

        foreach($prev as $key => $p) {
            if ($this->areEquals($p, $current)) {
                $keyEqual = $key;
            }
        }

        if($keyEqual > -1) {
            $array = array_merge($prev[$keyEqual], $current);
            $array['cantidad'] = $prev[$keyEqual]['cantidad'] + $current['cantidad'];
            $prev[$keyEqual] = $array;

            $hash = $current['hash'];
            $producto = json_encode($prev);

            $updateObject = $this->wpdb->query("update wp_cart
            set json = '$producto'
            where hash = '$hash'", "ARRAY_A");

            if($updateObject) {
                header('Content-Type: application/json');
                echo $producto;
            }

            else {
                echo 'ko';
            }
        }

        else {
            array_push($prev, $current);

            $hash = $current['hash'];
            $producto = json_encode($prev);

            $updateObject = $this->wpdb->query("update wp_cart
            set json = '$producto'
            where hash = '$hash'", "ARRAY_A");

            if($updateObject) {
                header('Content-Type: application/json');
                echo $producto;
            }

            else {
                echo 'ko';
            }
        }
    }
}

$cart = new cart($_REQUEST);