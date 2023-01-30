<?php
require_once "model/users.php";
require_once "model/subject.php";
require_once "model/schedule.php";

class IndexController
{
    private $url_templates = "view/inicio/";
    private $user;
    private $subject;
    public function __construct()
    {
        $this->user = new User();
        $this->subject = new SubjectModel();
    }

    public function index()
    {
        
        if (!isset($_SESSION['sesion'])) :

            if ($_SESSION['rol'] == "alumno") :
                $maestros = $this->user->get_all_by_rol("maestro", "active");
            endif;
        endif;
        
       
        require_once($this->url_templates . "index.php");
    }
}
