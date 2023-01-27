<?php
require_once "model/users.php";
require_once "model/subject.php";
require_once "model/schedule.php";

class ScheduleController
{
    private $url_templates = "view/schedule/";
    private $user;
    private $subject;
    private $schedule;
    public function __construct()
    {
        $this->user = new User();
        $this->subject = new SubjectModel();
        $this->schedule = new ScheduleModel();
    }


    public function get_form_schedule()
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
        $schedule = $this->schedule->show_by_username($usuario->id, $subject->id);
        require_once($this->url_templates . "new_form.php");
    }

    public function post_save_schedule()
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
            $user = $this->user->get_by_username($_SESSION['username']);
            $subject = $this->subject->get_by_id($_REQUEST['id_materia']);
            if ($_REQUEST['horaInicio'] >= $_REQUEST['horaFin']) :
                header("Location: index.php?controller=schedule&action=get_form_schedule&msg=time&subjectId={$subject->id}");
                exit;
            endif;
            $horario = new ScheduleModel();
            // falta agregar post method para guardar
            $horario->id_usuario = $user->id;
            $horario->id_materia = $subject->id;
            $horario->dia = $_REQUEST['day'];
            $horario->horaInicio = $_REQUEST['horaInicio'];
            $horario->horaFin = $_REQUEST['horaFin'];
            $horario->create();



            header("Location: index.php?controller=schedule&action=get_form_schedule&msg=success&subjectId={$subject->id}");
        endif;
    }
}
