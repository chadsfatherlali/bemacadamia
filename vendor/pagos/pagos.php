<?php
/**
 * Created by PhpStorm.
 * User: chadsfather
 * Date: 12/6/15
 * Time: 23:24
 */

require(dirname(__FILE__) . '/../autoload.php');

class pagos
{
    public function __construct($get)
    {
        $cart = $this->getCart($get['hash']);

        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->Host = 'tls://smtp.gmail.com:587';
        $mail->SMTPAuth = true;
        $mail->Username = 'bemacadamia@gmail.com';
        $mail->Password = 'bemacadamia2015';
        $mail->SMTPDebug = 0;

        $mail->setFrom('info@bemacadamia.com', 'beMacadamia Shopping Cart');
        $mail->addAddress('info@bemacadamia.com');
        $mail->addCC('badia.emma@gmail.com');
        $mail->addBCC('chadsfather@gmail.com');

        $mail->isHTML(true);

        $mail->Subject = 'Contacto desde el formulario de bemacadamia.com';
        $mail->Body = $this->cartComplete($get, $cart);;
        $mail->AltBody = 'Email no soportado por el cliente de correo';

        if(!$mail->send()) {
            echo 'ko';
        }

        else {
            echo 'ok';
        }
    }

    private function cartComplete($get, $cart)
    {
        $html = file_get_contents('pagos.html');

        foreach($get as $k => $v) {
            $html = str_replace('{{ ' . $k . ' }}', $v, $html);
        }

        $total = 0;
        $prod = '';
        foreach($cart as $item) {
            $nombre = $this->getNameById($item['producto']);
            $talla = $item['talla'];
            $cantidad = $item['cantidad'];
            $color = $item['color'];
            $preciou = $item['precio'];
            $precio = ((float) str_replace(',', '.', $preciou)) * $cantidad;
            $total = $total + $precio;

            $prod .= '<tr>';
            $prod .= '<td>' . $nombre . '</td>';
            $prod .= '<td>' . $talla . '</td>';
            $prod .= '<td>' . $cantidad . '</td>';
            $prod .= '<td><div style="border:1px solid black;background-color: ' . $color . ';width:20px; height:20px;"></div></td>';
            $prod .= '<td>' . $preciou . '€</td>';
            $prod .= '<td>' . $precio . '€</td>';
            $prod .= '</tr>';
        }

        $prod .= '<tr></tr><td></td><td></td><td></td><td></td><td><strong>Subtotal</strong></td><td>' . $total . '€</td></tr>';
        $prod .= '<tr></tr><td></td><td></td><td></td><td></td><td><strong>Envio</strong></td><td>4€</td></tr>';
        $prod .= '<tr></tr><td></td><td></td><td></td><td></td><td><strong>Total</strong></td><td>' . ($total + 5) . '€</td></tr>';
        $html = str_replace('{{ table }}', $prod, $html);
        return $html;die;
    }

    private function getCart($hash)
    {
        $result = wpdbobject::getwpdobject()->get_results("select *
        from wp_cart
        where hash = '$hash'", "ARRAY_A");

        return json_decode($result[0]['json'], true);
    }

    private function getNameById($id)
    {
        $result = wpdbobject::getwpdobject()->get_results("select post_title
        from wp_posts
        where ID = $id
        and post_status = 'publish'", "ARRAY_A");

        return $result[0]['post_title'];
    }
}

$pagos = new pagos($_REQUEST);