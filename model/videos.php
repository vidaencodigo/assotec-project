<?php
require_once 'core/crud.php';



class Video extends Crud
{
    public $id;
    public $id_usuario;
    public $titulo;
    public $descripcion;
    public $url;
    public $status;
    public $created_at;
    public $updated_at;

    const TABLE = 'videos_table';
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
            (id_usuario, titulo, descripcion, url) 
            VALUES (?,?,?,?)");
            $stm->execute(array(
                $this->id_usuario,
                $this->titulo,
                $this->descripcion,
                $this->url
            ));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function get_all_by_status()
    {
        /** RETORNA TODOS LOS ELEMENTOS DE LA TABLAS */
        try {
            //code...
            $stm = $this->pdo->prepare("SELECT * FROM " .  self::TABLE . " WHERE id_usuario=? AND status=? ORDER BY id DESC");
            $stm->execute(array(
                $this->id_usuario,
                $this->status
            ));
            return $stm->fetchall(PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function get_last($user)
    {
        /** RETORNA TODOS LOS ELEMENTOS DE LA TABLAS */
        try {
            //code...
            $stm = $this->pdo->prepare("SELECT * FROM " .  self::TABLE . " WHERE id_usuario=? ORDER BY id DESC LIMIT 1");
            $stm->execute(array(
                $user
            ));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function update()
    {
    }
}
