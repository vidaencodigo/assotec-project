<?php
require_once 'core/crud.php';
require_once 'model/users.php';
require_once 'model/subject.php';
class AsesoriaAlumnoModel extends Crud
{
    public $id;
    public $id_usuario;
    public $id_asesoria;
 
    public $status;
    public $created_at;
    public $updated_at;
   
    const TABLE = 'alumno_asesoria';
    private $pdo;
    public function __construct()
    {
        parent::__construct(self::TABLE);
        $this->pdo = parent::connect();
    }
    public function create()
    {
    }
    public function update()
    {
    }

}