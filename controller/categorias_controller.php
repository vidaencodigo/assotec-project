<?php
require_once "model/users.php";
require_once "model/categorias.php";

class CategoriasController
{
    private $url_templates = "view/categorias/";

    private $user;
    private $categorias;
    public function __construct()
    {
        $this->categorias = new CategoriaModel();
        $this->user = new User();
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
        $categorias= $this->categorias->get_all();
        $usuario = $this->user->get_by_username($_SESSION['username']);

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
}
