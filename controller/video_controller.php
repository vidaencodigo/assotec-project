<?php
require_once "model/users.php";
require_once "model/subject.php";
require_once "model/schedule.php";
require_once "model/maestros.php";
require_once "model/videos.php";
class VideoController
{
    private $url_templates = "view/videos/";

    private $user;
    private $video;
    public function __construct()
    {
        $this->user = new User();
        $this->video = new Video();
    }


    public function get_form()
    {
        $_SESSION['token'] =  bin2hex(random_bytes(35));
        if (!isset($_SESSION['session'])) :
            header("Location: index.php?controller=index&action=index");
            exit;
        endif;



        if ($_SESSION['rol'] != "maestro") :
            header("Location: index.php?controller=index&action=index");
            exit;
        endif;
        $usuario = $this->user->get_by_username($_SESSION['username']);

        require_once($this->url_templates . "form.php");
    }
    public function post_save_video()
    {
        if (!isset($_SESSION['session'])) :
            header("Location: index.php?controller=index&action=index");
            exit;
        endif;



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
            $usuario = $this->user->get_by_username($_SESSION['username']);
            $video = new Video();
            $video->id_usuario = $usuario->id;
            $video->titulo= $_REQUEST['titulo'];
            $video->descripcion=$_REQUEST['descripcion'];
            $video->url=urlencode($_REQUEST['url']);;
            $video->create();
            header("Location: index.php?controller=video&action=get_form&msg=success");
        endif;

        
    }
}
