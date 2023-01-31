<?php
require_once "model/users.php";
require_once "model/subject.php";
class SubjectController
{
    private $url_templates = "view/subject/";
    private $user;
    private $subject;
    public function __construct()
    {
        $this->user = new User();
        $this->subject = new SubjectModel();
    }
    public function get_index()
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

        // valid only maestros
        if ($_SESSION['rol'] != "maestro") :
            header("Location: index.php?controller=index&action=index");
            exit;
        endif;
        require_once($this->url_templates . "nueva_materia.php");
    }

    public function get_user_subjects()
    {
        //  generates the one-time token
        $_SESSION['token'] =  bin2hex(random_bytes(35));
        // view

        if (!isset($_SESSION['session'])) :
            header("Location: index.php?controller=index&action=index");
            exit;
        endif;
        if (isset($_SESSION['rol']) != "maestro") :
            header("Location: index.php?controller=index&action=index");
            exit;
        endif;

        $usuario = $this->user->get_by_username($_SESSION['username']);
        $user_subject = $this->subject->get_all_active($usuario->id);

        require_once($this->url_templates . "profile_subjects.php");
    }


    public function post_save_subject()
    {
        if (!isset($_SESSION['session'])) :
            header("Location: index.php?controller=index&action=index");
            exit;
        endif;
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
            $materia = html_entity_decode($_REQUEST['name'], ENT_QUOTES | ENT_HTML5, "UTF-8");
            $usuario = $this->user->get_by_username($_SESSION['username']);
            $materiaExists = $this->subject->get_by_subject($materia, $usuario->id);
            // valida si materia existe, al no eliminar materia y solo 
            // poner en status inactive (por coherencia en la bd)
            // se puede crear la misma materia para cada y el mismo usuario
            // if ($materiaExists) :
            //     header("Location: index.php?controller=subject&action=get_index&msg=subject_exists");
            //     exit;
            // endif;

            $subject = new SubjectModel();
            $subject->id_usuario = $usuario->id;
            $subject->name = $materia;
            $subject->create();
            header("Location: index.php?controller=subject&action=get_index&msg=success");
        endif;
    }

    public function get_form_delete()
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

        // valid only maestros
        if ($_SESSION['rol'] != "maestro") :
            header("Location: index.php?controller=index&action=index");
            exit;
        endif;

        $usuario = $this->user->get_by_username($_SESSION['username']);
        $subject = $this->subject->get_by_id($_REQUEST['subjectId']);

        require_once($this->url_templates . "delete_.php");
    }
    public function delete_subject()
    {
        if (!isset($_SESSION['session'])) :
            header("Location: index.php?controller=index&action=index");
            exit;
        endif;

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

            $materia = new SubjectModel();
            // falta agregar post method para guardar
            $materia->id = $_REQUEST['id_materia'];
            $materia->status = "inactive";
            $materia->set_to_innactive();

            header("Location: index.php?controller=subject&action=get_user_subjects&msg=success_delete_subject");
        endif;
    }
}
