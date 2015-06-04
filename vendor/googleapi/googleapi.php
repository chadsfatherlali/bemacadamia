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
    /** @var array Scopes del APi */
    static $scopes = array('https://www.googleapis.com/auth/drive');

    /** @var  Access token */
    private $accessToken;
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
        $client->setRedirectUri(self::CONST_REDIRECT_URI);
        $client->setScopes(self::$scopes);
        $client->setAccessType('offline');

        $this->files = $this->getImages($client, $folderId);
    }

    /**
     * Metodo que retorna las rutas de Gdrive
     *
     * @return Array
     */
    public function getFiles()
    {
        return $this->files;
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

        if($this->accessToken) {
            return $this->exec($client, $folderId);
        }

        else {
            if (isset($_GET['code'])) {
                $client->authenticate($_GET['code']);
                //$this->accessToken = $client->getAccessToken();
                return $this->exec($client, $folderId);
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

        return $this->doAction($client, $folderId);
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

        /*$query = array(
            '"' . $folderId . '" in parents',
            'mimeType contains "image/jpeg"'
        );*/

        $service = new Google_Service_Drive($client);

        $list = $service->children->listChildren($folderId);
        print_r($list);die;
        foreach($list->getItems() as $folder) {
            $folders[] = $folder->id;
        }

        foreach($folders as $folder) {
            $files = array($service->files->listFiles(array(
                'q' => '"' . $folder . '" in parents'
            )));

            $this->todb($folder, $files);
        }
    }

    /**
     * @param $key
     * @param $array
     */
    private function todb($key, $array)
    {   $todb = array();

        foreach($array as $items) {
            $todb[$key] = $this->extractItems($key, $items);
        }

        $this->save($todb);
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
            if(!$item->explicitlyTrashed) {
                $files[] = array(
                    'name' => $item->originalFilename,
                    'thumb' => $item->thumbnailLink,
                    'img' => 'http://googledrive.com/host/' . $key . '/' . $item->originalFilename
                );
            }
        }

        return $files;
    }


    /**
     * Guarda un array con el esquema de imagenes de gDrive
     *
     * @param $array
     */
    private function save($array)
    {
        $res = false;

        foreach($array as $key => $value) {
            $result = $this->wpdb->get_results("select id
            from wp_gdrvie
            where folder_id = '$key'", "ARRAY_A");

            if($result) {
                $value = json_encode($value, true);

                $res = $this->wpdb->query("update wp_gdrive
                set Json = '$value'", "ARRAY_A");
            }

            else {
                $value = json_encode($value, true);

                $res = $this->wpdb->query("insert
                into wp_gdrive
                (folder_id, Json)
                values ('$key', '$value')", "ARRAY_A");
            }
        }

        header('location: http://' . $_SERVER['SERVER_NAME'] . '/wp-admin/admin.php?page=gDrive-manager&updatedb=' . $res);
    }
}

$gDrive = new googleapi();