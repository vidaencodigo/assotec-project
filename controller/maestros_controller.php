<?php
require_once "model/users.php";
require_once "model/subject.php";
require_once "model/schedule.php";
require_once "model/maestros.php";

class MaestrosController
{
    private $url_templates = "view/maestros/";
    
    private $user;
    private $subject;
    private $techers;
    public function __construct()
    {
        $this->user = new User();
        $this->subject = new SubjectModel();
        $this->techers = new MaestroModel();
    }

   
    public function get_asesores()
    {
        if (!isset($_SESSION['session'])) :
            header("Location: index.php?controller=index&action=index");
            exit;
        endif;



        if ($_SESSION['rol'] != "alumno") :
            header("Location: index.php?controller=index&action=index");
            exit;
        endif;
        $maestros = $this->user->get_all_by_rol("maestro", "active");

        require_once($this->url_templates . "lista_asesores.php");
    }
}
