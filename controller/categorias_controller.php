<?php
require_once "model/users.php";
require_once "model/categorias.php";
require_once "model/videos.php";
require_once "libs/YouTubeThumbnail/getYTThumbnail.php";
require_once "model/elemento_caegoria.php";
class CategoriasController
{
    private $url_templates = "view/categorias/";

    private $user;
    private $categorias;
    private $video;
    private $elemento_categoria;
    private $youtubeThumbnail;
    public function __construct()
    {
        $this->elemento_categoria = new ElementoCategoriaModel();
        $this->categorias = new CategoriaModel();
        $this->user = new User();
        $this->video = new Video();
        $this->youtubeThumbnail = new GetThumbnail();
    }

    public function show_index()
    {
        $_SESSION['token'] =  bin2hex(random_bytes(35));
        if (isset($_SESSION['rol'])) :
            if ($_SESSION['rol'] != "maestro") :
                echo "Not allowed to see this site";
                exit;
            endif;
        endif;
        $usuario = $this->user->get_by_username($_SESSION['username']);
        $categorias = $this->categorias->get_all_by_user($usuario->id);


        require_once($this->url_templates . "multimedia.php");
    }

    public function save_categoria()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") :
            $token = $_REQUEST['token'];
            // VALID TOKEN
            if (!$token || $token !== $_SESSION['token']) :
                // show an error message 
                echo '<p class="error">Error: invalid form submission</p>';
                // return 405 http status code
                header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
                exit;

            endif;
            $usuario = $this->user->get_by_username($_SESSION['username']);
            $categoria = new CategoriaModel();
            $categoria->id_usuario = $usuario->id;
            $categoria->name = $_REQUEST['name'];
            $categoria->nueva_categoria();
            header("Location: index.php?controller=categorias&action=show_index");
        endif;
    }

    public function nuevo_elemento()
    {
        /**
         * nuevo video en caegoria especifica
         */
        $_SESSION['token'] =  bin2hex(random_bytes(35));
        if (isset($_SESSION['rol'])) :
            if ($_SESSION['rol'] != "maestro") :
                echo "Not allowed to see this site";
                exit;
            endif;
        endif;
        if ($_REQUEST['id']) :
            $id_categoria_get = $_REQUEST['id'];
            $categoria = $this->categorias->get_by_id($id_categoria_get);
            $usuario = $this->user->get_by_username($_SESSION['username']);
            $elementos_categoria = $this->elemento_categoria->get_video_categoria($categoria->id);
            //print_r($elementos_categoria);
            require_once($this->url_templates . "nuevo_elemento.php");
        else :
            require_once($this->url_templates . "multimedia.php");
        endif;
    }


    public function post_guarda_elemento()
    {
        if ($_SESSION['rol'] != "maestro") :
            header("Location: index.php?controller=index&action=index");
            exit;
        endif;
        if ($_SERVER['REQUEST_METHOD'] = "post") :
            $token = $_REQUEST['token'];
            // VALID TOKEN
            if (!$token || $token !== $_SESSION['token']) {
                // show an error message 
                echo '<p class="error">Error: invalid form submission</p>';
                // return 405 http status code
                header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
                exit;
            }
            //obtenemos la categoria por id
            $categoria = $this->categorias->get_by_id($_REQUEST['id_categoria']);
            $usuario = $this->user->get_by_username($_SESSION['username']);
            $video = new Video();
            $video->id_usuario = $usuario->id;
            $video->titulo = $_REQUEST['titulo'];
            $video->descripcion = $_REQUEST['descripcion'];
            $video->url = urlencode($_REQUEST['url']);;
            $video->create();
            // obtiene el ultimo video al crearlo          
            $ultimo_video = $this->video->get_last($usuario->id);
            $elemento = new ElementoCategoriaModel();
            $elemento->id_categoria = $categoria->id;
            $elemento->id_elemento = $ultimo_video->id;
            $elemento->create();
            header("Location: index.php?controller=categorias&action=nuevo_elemento&id=$categoria->id");
        endif;
    }
}
