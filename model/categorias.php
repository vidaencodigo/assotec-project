<?php
require_once 'core/crud.php';

class CategoriaModel extends Crud
{
    public $id;
    public $name;
    public $id_usuario;
    public $status;
    public $created_at;
    public $updated_at;
    const TABLE = 'categorias_table';
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
    public function get_all()
    {
        try {
            //code...
            $stm = $this->pdo->prepare("SELECT * FROM ". self::TABLE ." WHERE status=?");
            $stm->execute(array('active'));
            return $stm->fetchall(PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function nueva_categoria()
    {
        $query = "INSERT INTO " . self::TABLE . "(nombre, id_usuario) VALUES (?,?)";

        try {
            $stm = $this->pdo->prepare($query);
            $stm->execute(array(
                $this->name,
                $this->id_usuario
            ));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
