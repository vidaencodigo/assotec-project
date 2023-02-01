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
    public function get_alumnos_by_asesoria()
    {
        $query = "
        SELECT users_table.name as Name, users_table.last_name as Last_name FROM 
        " . self::TABLE .
            " INNER JOIN users_table 
        ON alumno_asesoria.id_usuario = users_table.id 
        WHERE alumno_asesoria.id_asesoria=?;";
        try {
            //code...
            $stm = $this->pdo->prepare($query);
            $stm->execute(array(
                $this->id_asesoria
            ));

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            //throw $e;
            echo $e->getMessage();
        }
    }
    public function get_asesorias_alumno()
    {
        $query = "
        SELECT users_table.name, users_table.last_name, asesorias_table.dia, asesorias_table.inicio, asesorias_table.fin, asesorias_table.id_horario_materia as materia, asesorias_table.id_usuario as maestro
        FROM " .self::TABLE.
        " INNER JOIN users_table
        ON alumno_asesoria.id_usuario = users_table.id
        INNER JOIN asesorias_table
        ON alumno_asesoria.id_asesoria = asesorias_table.id
        WHERE alumno_asesoria.status=? AND alumno_asesoria.id_usuario=?
        ";
        try {
            //code...
            $stm = $this->pdo->prepare($query);
            $stm->execute(array(
                "active",
                $this->id_usuario
            ));

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            //throw $e;
            echo $e->getMessage();
        }
    }
    public function update()
    {
    }
}
