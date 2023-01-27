<?php


require_once 'core/crud.php';

class ScheduleModel extends Crud
{

    public $id;
    public $id_usuario;
    public $id_materia;
    public $dia;
    public $horaInicio;
    public $horaFin;
    public $created_at;
    public $updated_at;
    public $status;

    const TABLE = 'horarios_asesorias_table';
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
            (id_usuario, id_materia, dia, horaInicio, horaFin) 
            VALUES (?,?,?,?,?)");
            $stm->execute(array(
                $this->id_usuario,
                $this->id_materia,
                $this->dia, 
                $this->horaInicio,
                $this->horaFin
            ));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
   
    public function show_by_username($user, $subject){
        /** RETORNA EL ELEMENTO QUE HAGA MATCH CON @user */
        try { 
            //code...

            $stm = $this->pdo->prepare("SELECT * FROM " .  self::TABLE . " WHERE id_usuario=? AND id_materia=? AND status=?");
            $stm->execute(array($user, $subject, "active"));
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function update()
    {
    }
}
