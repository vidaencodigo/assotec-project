<?php


require_once 'core/crud.php';

class SubjectModel extends Crud
{

    public $id;
    public $name;
    public $id_usuario;
    public $created_at;
    public $updated_at;
    public $status;

    const TABLE = 'materias_agenda_table';
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
            (id_usuario, name) 
            VALUES (?,?)");
            $stm->execute(array(
                $this->id_usuario,
                $this->name
            ));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function get_by_subject($subject, $user)
    {
        /** RETORNA EL ELEMENTO QUE HAGA MATCH CON @user */
        try {
            //code...

            $stm = $this->pdo->prepare("SELECT * FROM " .  self::TABLE . " WHERE name=? AND id_usuario=?");
            $stm->execute(array($subject, $user));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function get_all_active($usuario)
    {
        /** RETORNA TODOS LOS ELEMENTOS DE LA TABLAS */
        try {
            //code...
            $stm = $this->pdo->prepare("SELECT * FROM " .  self::TABLE . " WHERE id_usuario=? AND status=?");
            $stm->execute(array($usuario, 'active'));
            return $stm->fetchall(PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function set_to_innactive()
    {
        // inhabilita el usuario, no lo elimina
        try {
            //code...
            $stm = $this->pdo->prepare("UPDATE " . self::TABLE . " SET status=? WHERE id=?");
            $stm->execute(array(

                $this->status,
                $this->id
            ));
        } catch (PDOException $e) {
            //throw $e;
            echo $e->getMessage();
        }
    }
    public function update()
    {
    }
}
