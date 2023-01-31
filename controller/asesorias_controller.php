<?php
require_once "model/users.php";
require_once "model/subject.php";
require_once "model/schedule.php";
require_once "model/maestros.php";
require_once "model/asesoria.php";
require_once "model/asesoria_alumno.php";
class AsesoriasController
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
    public function get_new_form()
    {
        $_SESSION['token'] =  bin2hex(random_bytes(35));
        // view
        if (!isset($_SESSION['session'])) :

            header("Location: index.php?controller=index&action=index");
            exit;

        endif;
        if ($_SESSION['rol'] != 'maestro') :
            header("Location: index.php?controller=index&action=index");
            exit;
        endif;
        $usuario = $this->user->get_by_username($_SESSION['username']);
        $materia = $this->subject->get_by_id($_REQUEST['subjectId']);

        require_once $this->url_templates . "new_form.php";
    }

    public function get_asesoria_details()
    {
        $_SESSION['token'] =  bin2hex(random_bytes(35));
        // view
        if (!isset($_SESSION['session'])) :

            header("Location: index.php?controller=index&action=index");
            exit;

        endif;
        if ($_SESSION['rol'] != 'maestro') :
            header("Location: index.php?controller=index&action=index");
            exit;
        endif;
        $usuario = $this->user->get_by_username($_SESSION['username']);
        $asesoria = $this->asesoria->list_asesoria($_REQUEST['id_asesoria']);
        $materia = $this->subject->get_by_id($asesoria->materia_id);


        require_once $this->url_templates . "edita_data.php";
    }
    public function get_quit()
    {
        $_SESSION['token'] =  bin2hex(random_bytes(35));
        // view
        if (!isset($_SESSION['session'])) :

            header("Location: index.php?controller=index&action=index");
            exit;

        endif;
        if ($_SESSION['rol'] != 'maestro') :
            header("Location: index.php?controller=index&action=index");
            exit;
        endif;
        require_once $this->url_templates . "quit.php";
    }

    public function post_save()
    {
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
            $subject = $this->subject->get_by_id($_REQUEST['idmateria']);

            $asesoria = new AsesoriaModel();
            $asesoria->id_usuario = $usuario->id;
            $asesoria->id_horario_materia = $subject->id;
            $asesoria->tipo = $_REQUEST['tipo'];
            $asesoria->salon = $_REQUEST['salon'];
            $asesoria->descripcion = $_REQUEST['descripcion'];
            $asesoria->url_sesion = $_REQUEST['url'];
            $asesoria->dia = $_REQUEST['day'];
            $asesoria->inicio = $_REQUEST['horaInicio'];
            $asesoria->fin = $_REQUEST['horaFin'];
            $asesoria->save();
            header("Location: index.php?controller=subject&action=get_user_subjects");

        endif;
    }
    public function post_edit()
    {
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
            $subject = $this->subject->get_by_id($_REQUEST['idmateria']);

            $asesoria = new AsesoriaModel();
            $asesoria->id = $_REQUEST['id_asesoria'];

            $asesoria->tipo = $_REQUEST['tipo'];
            $asesoria->salon = $_REQUEST['salon'];
            $asesoria->descripcion = $_REQUEST['descripcion'];
            $asesoria->url_sesion = $_REQUEST['url'];
            $asesoria->dia = $_REQUEST['day'];
            $asesoria->inicio = $_REQUEST['horaInicio'];
            $asesoria->fin = $_REQUEST['horaFin'];
            $asesoria->edit();
            header("Location: index.php?controller=asesorias&action=get_all_asesorias");

        endif;
    }
    public function delete_asesoria()
    {
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


            $asesoria = new AsesoriaModel();
            $asesoria->id = $_REQUEST['id'];

            $asesoria->status = "inactive";

            $asesoria->quit_asesoria();
            header("Location: index.php?controller=subject&action=get_user_subjects");

        endif;
    }
    public function get_all_asesorias()
    {
        if (!isset($_SESSION['session'])) :

            header("Location: index.php?controller=index&action=index");
            exit;

        endif;
        if ($_SESSION['rol'] != 'maestro') :
            header("Location: index.php?controller=index&action=index");
            exit;
        endif;
        $usuario = $this->user->get_by_username($_SESSION['username']);
        $asesorias = $this->asesoria->list_asesoria_materias($usuario->id);

       
        
        require_once $this->url_templates . "asesorias.php";
    }

    public function get_all_asesorias_alumo()
    {
        if (!isset($_SESSION['session'])) :

            header("Location: index.php?controller=index&action=index");
            exit;

        endif;
        if ($_SESSION['rol'] != 'alumno') :
            header("Location: index.php?controller=index&action=index");
            exit;
        endif;

        $usuario = $this->user->get_by_id($_REQUEST['id_usuario']);
        $asesorias = $this->asesoria->list_asesoria_materias($usuario->id);

        require_once $this->url_templates . "asesorias_a.php";
    }

    public function get_asesoria_ins()
    {
        if (!isset($_SESSION['session'])) :

            header("Location: index.php?controller=index&action=index");
            exit;

        endif;
        if ($_SESSION['rol'] != 'alumno') :
            header("Location: index.php?controller=index&action=index");
            exit;
        endif;

       
        $asesoria = $this->asesoria->list_asesoria($_REQUEST['id_asesoria']);

        require_once $this->url_templates."inscripcion.php";
        
    }

   
}
