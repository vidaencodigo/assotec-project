<?php


require_once 'core/crud.php';

class MaestroModel extends Crud
{
    public $id_usuario;
    public $id_materia;
    public $rol;

    const TABLE = 'users';
    const TABLE_2 = 'materias_agenda_table';
    private $pdo;
    public function __construct()
    {
        parent::__construct(self::TABLE);
        $this->pdo = parent::connect();
    }

    public function get_all_subjects()
    {
        /** RETORNA EL ELEMENTO QUE HAGA MATCH CON @user */
        try {
            //code...

            $stm = $this->pdo->prepare("SELECT users_table.id, users_table.name, users_table.last_name, materias_agenda_table.name   FROM " .  self::TABLE . "
            INNER JOIN materias_agenda_table
            ON users_table.id = materias_agenda_table.id_usuario   
            WHERE  users_table.id=? AND  users_table.user_type=?");
            $stm->execute(array(
                $this->id_usuario,
                $this->id_materia,
            ));
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function create()
    {
    }
    public function update()
    {
    }
}
