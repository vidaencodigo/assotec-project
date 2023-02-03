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
    public function update()
    {
    }
}
