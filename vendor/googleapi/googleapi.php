<?php
/**
 * Created by PhpStorm.
 * User: chadsfather
 * Date: 2/6/15
 * Time: 21:46
 */

require(dirname(__FILE__) . '/../autoload.php');

/**
 * Classe contenedor del cliente php de Gdrive
 *
 * Class googleapi
 */
class googleapi
{
    /** Id cliente Gdrvie */
    const CONST_CLIENT_ID = '604915825306-i8103o0l80hlmhqrah8jssrftkpd7lbc.apps.googleusercontent.com';
    /** Secret cleinte Gdrvie */
    const CONST_CLIENT_SECRET = 'vmVoHH5OkUiY_THYsQQA14uB';
    /** Punto de entrada del API */
    const CONST_REDIRECT_URI = 'http://bemacadamia.cdxperience.com/vendor/googleapi/googleapi.php';
    /** Punto de entrada del API de produccion */
    const CONST_REDIRECT_URI_PROD = 'http://www.bemacadamia.com/vendor/googleapi/googleapi.php';
    /** @var array Scopes del APi */
    static $scopes = array('https://www.googleapis.com/auth/drive');
    /** @var  Array con las rutas devueltas por Gdrvie */
    private $files;
    private $wpdb;

    /**
     * @param string $folderId
     * @throws Exception
     */
    public function __construct($folderId = '0B6cc8HdeC7Mqfk8yalZuMFYwcWZiOW4zQUc4X2Jxall5S2JzSlEyaWZ2TkZqRkQ1bXU0ajQ')
    {
        $this->wpdb = wpdbobject::getwpdobject();
        $client = new Google_Client();

        $client->setClientId(self::CONST_CLIENT_ID);
        $client->setClientSecret(self::CONST_CLIENT_SECRET);
        if(strpos($_SERVER['SERVER_NAME'], 'cdxperience') !== false) {
            $client->setRedirectUri(self::CONST_REDIRECT_URI);
        }

        else {
            $client->setRedirectUri(self::CONST_REDIRECT_URI_PROD);
        }
        $client->setScopes(self::$scopes);
        $client->setAccessType('offline');

        $this->files = $this->getImages($client, $folderId);
    }

    /**
     * Proceso backend para obtener las imagenes de Gdrive
     *
     * @param Google_Client $client
     * @param $folderId
     * @return array
     * @throws Exception
     */
    public function getImages(Google_Client $client, $folderId)
    {
        if(!$folderId) {
            throw new Exception('Debe estar establecido el id del folder contenedor de las imagenes');
        }

        else {
            if (isset($_GET['code'])) {
                try {
                    $client->authenticate($_GET['code']);
                    //$this->accessToken = $client->getAccessToken();
                    $this->exec($client, $folderId);
                }

                catch(Exception $e) {
                    echo 'Debes estar logado con <a href="https://www.gmail.com">bemacadamia@gmail.com</a>';

                    throw new Exception('Debe estar logado con bemacadamia@gmail.com');
                }
            }

            else {
                echo '<a href="' . $client->createAuthUrl() . '">REDIRECCIONANDO AUTOMATICAMENTE A GDRIVE, SI NO LO HACE DAR UN CLICK AQUI...</a>';
                echo '<script>window.location = "' . $client->createAuthUrl() . '";</script>';
            }
        }
    }

    /**
     * Guarda el access token en base de datos
     *
     * @param $accessToken
     * @return mixed
     */
    private function storeAccessToken($accessToken)
    {
        if(file_put_contents($this->path . CONST_ACCESS_TOKEN, $accessToken)) {
            return true;
        }

        return false;
    }

    /**
     * Retorna la ultima access token guardada en la base de datos
     *
     * @return mixed
     */
    private function getAccessToken()
    {
        return file_get_contents($this->path . CONST_ACCESS_TOKEN);
    }

    /**
     * Se realizar el setup del cliente de Gdrive
     *
     * @param Google_Client $client
     * @param $folderId
     * @return array
     */
    private function exec(Google_Client $client, $folderId)
    {
        $client->setAccessToken($client->getAccessToken());
        //$client->refreshToken($client->getRefreshToken());

        $this->doAction($client, $folderId);
    }

    /**
     * Ejecutamos el cliente
     *
     * @param Google_Client $client
     * @param $folderId
     * @return array
     */
    private function doAction(Google_Client $client, $folderId)
    {
        $folders= array();
        $res = 0;

        /*$query = array(
            '"' . $folderId . '" in parents',
            'mimeType contains "image/jpeg"'
        );*/

        $service = new Google_Service_Drive($client);

        $list = $service->children->listChildren($folderId);

        foreach($list->getItems() as $folder) {
            $folders[] = $folder->id;
        }

        foreach($folders as $folder) {
            $files = array($service->files->listFiles(array(
                'q' => '"' . $folder . '" in parents and trashed = false'
            )));

            $res = $this->todb($folder, $files);

            sleep(1);
        }
        die;
        header('location: http://' . $_SERVER['SERVER_NAME'] . '/wp-admin/admin.php?page=gDrive-manager&updatedb=' . $res);
    }

    /**
     * @param $key
     * @param $array
     * @return bool
     */
    private function todb($key, $array)
    {
        $todb = array();

        foreach($array as $items) {
            $todb[$key] = $this->extractItems($key, $items);
        }

        return $this->save($todb);
    }


    /**
     * @param $key
     * @param Google_Service_Drive_FileList $items
     * @return array
     */
    private function extractItems($key, Google_Service_Drive_FileList $items)
    {
        $files = array();

        foreach($items->getItems() as $item) {
            $files[] = array(
                'name' => $item->originalFilename,
                'thumb' => $item->thumbnailLink,
                'img' => 'http://googledrive.com/host/' . $key . '/' . $item->originalFilename
            );
        }

        return $files;
    }


    /**
     * @param $array
     * @return bool
     */
    private function save($array)
    {
        $res = 0;

        $key = key($array);
        $value = serialize($array[$key]);

        $result = $this->wpdb->get_results("select id
        from wp_gdrive
        where folder_id = '$key'", "ARRAY_A");

        if($result) {
            $res = $this->wpdb->query("update wp_gdrive
            set Json = '$value'
            where folder_id = '$key'", "ARRAY_A");
        }

        else {
            $value = serialize($value);

            $res = $this->wpdb->query("insert
            into wp_gdrive
            (folder_id, Json)
            values ('$key', '$value')", "ARRAY_A");
        }

        return $res;
    }
}

$gDrive = new googleapi();