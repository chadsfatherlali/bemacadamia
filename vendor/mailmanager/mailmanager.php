<?php
/**
 * Created by PhpStorm.
 * User: chadsfather
 * Date: 5/6/15
 * Time: 22:47
 */

require(dirname(__FILE__) . '/../autoload.php');

class mailmanager
{
    public function __construct($get = null)
    {
        $success = array(
            'success' => 0
        );
        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->SMTPSecure = 'tsl';
        $mail->Host = 'smtp.1and1.es';
        $mail->Port = 25;
        $mail->SMTPAuth = true;
        $mail->Username = '439486552';
        $mail->Password = 'beMacadamia2015';
        $mail->SMTPDebug = 0;

        $mail->setFrom('info@bemacadamia.com', 'Formulario de contacto');
        $mail->addAddress('info@bemacadamia.com');

        $mail->isHTML(true);

        $mail->Subject = 'Contacto desde el formulario de bemacadamia.com';
        $mail->Body    = $this->proccesMail($get);
        $mail->AltBody = 'Email no soportado por el cliente de correo';

        header('Content-Type: application/json');
        if(!$mail->send()) {
            echo json_encode($success);
        }

        else {
            $success['success'] = 1;
            echo json_encode($success);
        }
    }

    private function proccesMail($get)
    {
        $html = file_get_contents('templates/' . $get['template'] . '.html');

        foreach($get as $key => $value) {
            $html = str_replace('{{ ' . $key . ' }}', $value, $html);
        }

        return $html;
    }
}

$mailmanager = new mailmanager($_GET);