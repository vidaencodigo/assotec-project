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
        /** save new user in DB */
        try {
            //code...
            $stm = $this->pdo->prepare("INSERT INTO " . self::TABLE .  "
            (id_usuario, id_asesoria) 
            VALUES (?,?)");
            $stm->execute(array(
                $this->id_usuario,
                $this->id_asesoria
            ));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function get_by_asesoria($id_asesoria, $id_usuario)
    {
        try {
            //code...
            $stm = $this->pdo->prepare("SELECT * FROM " . self::TABLE . "  WHERE id_asesoria=? AND id_usuario=?");
            $stm->execute(array(
                $id_asesoria,
                $id_usuario
            ));

            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            //throw $e;
            echo $e->getMessage();
        }
    }
    public function get_total($id_asesoria)
    {
        try {
            //code...
            $stm = $this->pdo->prepare("SELECT COUNT(id) as Total FROM " . self::TABLE . "  WHERE id_asesoria=?");
            $stm->execute(array(
                $id_asesoria
            ));

            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            //throw $e;
            echo $e->getMessage();
        }
    }
    public function update()
    {
    }
}
