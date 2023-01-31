<?php
require_once "model/users.php";
require_once "model/subject.php";
require_once "model/schedule.php";
require_once "model/maestros.php";
require_once "model/asesoria.php";
require_once "model/asesoria_alumno.php";
class InscribeController
{
    private $url_templates = "view/asesorias/";
    private $asesoria;
    private $user;
    private $subject;
    private $techers;
    private $asesoriaAlumno;
    public function __construct()
    {
        $this->user = new User();
        $this->subject = new SubjectModel();
        $this->techers = new MaestroModel();
        $this->asesoria = new AsesoriaModel();
        $this->asesoriaAlumno =  new AsesoriaAlumnoModel();
    }

    public function inscribe()
    {
        /**
         * inscribe alumno a asesoria
         */
        if (!isset($_SESSION['session'])) :
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
            $usuario = $this->user->get_by_username($_SESSION['username']);
            $asesoria = $this->asesoria->get_by_id($_REQUEST['id']);
            if ($asesoria) :
                $inscribe = new AsesoriaAlumnoModel();
                $inscribe->id_usuario = $usuario->id;
                $inscribe->id_asesoria =  $asesoria->id;
                $inscribe->create();
                header("Location: index.php");
            endif;

            header("Location: index.php");

        endif;
    }
}