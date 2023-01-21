<?php
require_once "model/users.php";

class UsersController
{
    private $url_templates = "view/usuarios/";
    private $user;
    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        /** 
         * CSRF TOKEN
         * PREVENT cross-site request ATACKS
         * Using a simple unique code between request 
         * more in https://www.w3.org/Security/wiki/Cross_Site_Attacks
         */

        //  generates the one-time token
        $_SESSION['token'] =  bin2hex(random_bytes(35));
        // view
        if (isset($_SESSION['session'])) :
            header("Location: index.php?controller=index&action=index");
            exit;
        endif;
        require_once($this->url_templates . "user_form.php");
    }

    public function profile()
    {
        /** 
         * CSRF TOKEN
         * PREVENT cross-site request ATACKS
         * Using a simple unique code between request 
         * more in https://www.w3.org/Security/wiki/Cross_Site_Attacks
         */

        //  generates the one-time token
        $_SESSION['token'] =  bin2hex(random_bytes(35));
        // view

        if (!isset($_SESSION['session'])) :
            header("Location: index.php?controller=index&action=index");
            exit;
        endif;
        $usuario = $this->user->get_by_username($_SESSION['username']);


        require_once($this->url_templates . "profile.php");
    }
    public function profile_update()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") :
            $token = $_REQUEST['token'];
            // VALID TOKEN
            if (!$token || $token !== $_SESSION['token']) {
                // show an error message 
                echo '<p class="error">Error: invalid form submission</p>';
                // return 405 http status code
                header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
                exit;
            }

            $usuarioexist = $this->user->get_by_username($_SESSION['username']);
            $id_user = $usuarioexist->id;
            $usuario = new User();
            $usuario->id = $id_user;
            $usuario->name = $_REQUEST['name'];
            $usuario->last_name = $_REQUEST['last_name'];
            $usuario->update_profile();

            header("Location: index.php?controller=users&action=profile");


        endif;
    }
    public function change_image_profile()
    {
        /** 
         * CSRF TOKEN
         * PREVENT cross-site request ATACKS
         * Using a simple unique code between request 
         * more in https://www.w3.org/Security/wiki/Cross_Site_Attacks
         */

        //  generates the one-time token
        $_SESSION['token'] =  bin2hex(random_bytes(35));
        // view
        if (!isset($_SESSION['session'])) :
            header("Location: index.php?controller=index&action=index");
            exit;
        endif;



        $usuario = $this->user->get_by_username($_SESSION['username']);


        require_once($this->url_templates . "image_form.php");
    }

    public function save_image()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") :
            $token = $_REQUEST['token'];
            // VALID TOKEN
            if (!$token || $token !== $_SESSION['token']) {
                // show an error message 
                echo '<p class="error">Error: invalid form submission</p>';
                // return 405 http status code
                header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
                exit;
            }

            $usuarioexist = $this->user->get_by_username($_SESSION['username']);
            $id_user = $usuarioexist->id;
            if ($_FILES['image_profile']['tmp_name']) :
                $image = $_FILES['image_profile']['tmp_name'];
                $imgContenido = file_get_contents($image);
                $usuario = new User();
                $usuario->id = $id_user;
                $usuario->profile_image = $imgContenido;
                $usuario->update_image();
            endif;

            header("Location: index.php?controller=users&action=profile");


        endif;
    }

    public function save_()
    {


        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // GET ACTUAL TOKEN
            $token = $_REQUEST['token'];

            $name = $_REQUEST['name'];
            $lastname = $_REQUEST['lastname'];
            $mail = $_REQUEST['mail'];
            $username = $_REQUEST['username'];
            $password = $_REQUEST['password'];
            $r_password = $_REQUEST['r_password'];

            // VALID TOKEN
            if (!$token || $token !== $_SESSION['token']) {
                // show an error message 
                echo '<p class="error">Error: invalid form submission</p>';
                // return 405 http status code
                header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
                exit;
            }
            if (validPassword($password, $r_password)) { //valida que sea el mismo pwd
                $usuarioexist = $this->user->get_by_username($username);
                $mailexist = $this->user->get_by_mail($mail);
                if ($usuarioexist || $mailexist) {
                    header("Location: index.php?controller=users&action=index&msg=usrerr");
                } else {
                    // SAVE USER
                    $usuario = $this->user;
                    $usuario->username = $username;
                    $usuario->name = $name;
                    $usuario->last_name = $lastname;
                    $usuario->mail = $mail;
                    $usuario->password = password_hash($password, PASSWORD_DEFAULT);
                    $usuario->user_type = "alumno";
                    $usuario->create();
                    header("Location: index.php?controller=users&action=index&msg=success");
                }
            } else {
                header("Location: index.php?controller=users&action=index&msg=pwderr");
            }
        }
    }
}


function validPassword($pwd, $pwd2)
{
    if ($pwd == $pwd2) {
        return true;
    }
    return false;
}
