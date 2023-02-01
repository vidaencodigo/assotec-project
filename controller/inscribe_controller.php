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
    public function get_alumnos()
    {
        if (!isset($_SESSION['session'])) :
            exit;
        endif;
        if ($_SESSION['rol']!=="maestro") :
            exit;
        endif;
        $usuario=$this->user->get_by_username($_SESSION['username']);
        $lista_alumnos = new AsesoriaAlumnoModel();
        $lista_alumnos->id_asesoria = $_REQUEST['id_asesoria'];
        $alumnos = $lista_alumnos->get_alumnos_by_asesoria();
        $materia = $this->subject->get_by_id($_REQUEST['materia']);
        require_once $this->url_templates."lista_alumnos.php";
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
                $asesoriaAlumnExists = $this->asesoriaAlumno->get_by_asesoria($asesoria->id, $usuario->id);
                if ($asesoriaAlumnExists) :
                    echo "Error: ya se encuentra registrado";
                    exit;
                endif;
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
