<?php
require_once 'core/crud.php';

class AsesoriaModel extends Crud
{
    public $id;
    public $id_usuario;
    public $id_horario_materia;
    public $tipo;
    public $salon;
    public $descripcion;
    public $url_sesion;
    public $status;
    public $created_at;
    public $updated_at;
    public $dia;
    public $inicio;	
    public $fin;
    const TABLE = 'asesorias_table';
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

    public function save()
    {
        /** save new user in DB */
        try {
            //code...
            $stm = $this->pdo->prepare("INSERT INTO " . self::TABLE .  "
            (id_usuario, id_horario_materia, tipo, salon, descripcion, url_sesion, dia, inicio, fin) 
            VALUES (?,?,?,?,?,?,?,?,?)");
            $stm->execute(array(
                $this->id_usuario,
                $this->id_horario_materia,
                $this->tipo,
                $this->salon,
                $this->descripcion,
                $this->url_sesion,
                $this->dia,
                $this->inicio,
                $this->fin
            ));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
