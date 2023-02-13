<?php
require_once 'core/crud.php';

class ElementoCategoriaModel extends Crud
{
    public $id;
    public $id_categoria;
    public $id_elemento;
    public $created_at;
    public $updated_at;
    const TABLE = 'elemento_categoria_table';
    private $pdo;
    public function __construct()
    {
        parent::__construct(self::TABLE);
        $this->pdo = parent::connect();
    }
    public function create()
    {
        $query = "INSERT INTO " . self::TABLE . " 
        (id_categoria, id_elemento) VALUES(?,?)";
        try {
            $stm = $this->pdo->prepare($query);
            $stm->execute(array(
                $this->id_categoria,
                $this->id_elemento
            ));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function update()
    {
    }

    public function get_video_categoria($categoria)
    {
        $query = "
        SELECT elemento_categoria_table.id, elemento_categoria_table.id_categoria, videos_table.titulo, videos_table.descripcion, videos_table.url, videos_table.id as id_video
        FROM " . self::TABLE
            . " INNER JOIN `videos_table`
        ON elemento_categoria_table.id_elemento = videos_table.id
        WHERE elemento_categoria_table.id_categoria=?";
        try {
            //code...
            $stm = $this->pdo->prepare($query);
            $stm->execute(array($categoria));
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}
