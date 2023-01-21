<?php
require_once "model/users.php";
class LoginController
{
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
        require_once('view/login/login.php');
    }


    public function login()
    {


        if ($_SERVER['REQUEST_METHOD'] = "post") {

            $token = $_REQUEST['token'];
            // VALID TOKEN
            if (!$token || $token !== $_SESSION['token']) {
                // show an error message 
                echo '<p class="error">Error: invalid form submission</p>';
                // return 405 http status code
                header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
                exit;
            }

            $usuario = $_REQUEST['username'];
            $password = $_REQUEST['password'];
            $usuarioexist = $this->user->get_by_username($usuario);

            if ($usuarioexist) {

                if (password_verify($password,  $usuarioexist->password)) {
                    // sessiones con valor
                    $_SESSION['session'] = true;
                    $_SESSION["username"] = $usuarioexist->user;
                    $_SESSION["name"] = $usuarioexist->name;
                    $_SESSION["rol"] = $usuarioexist->user_type;

                    header("Location: index.php?controller=index&action=index");
                } else {
                    header("Location: index.php?controller=login&action=index&msg=pwderr");
                }
            } else {

                header("Location: index.php?controller=login&action=index&msg=pwderr");
            }
        }
    }

    public function logout()
    {
        // remove all session variables
        session_unset();

        // destroy the session
        session_destroy();

        header("Location: index.php?controller=login&action=index");
    }
}
