<?php
require_once 'core/crud.php';

class User extends Crud
{
  public $id;
  public $username;
  public $name;
  public $last_name;
  public $mail;
  public $password;
  public $user_type; 
  public $profile_image;
  public $created_at;
  public $updated_at;
  public $status;
  const TABLE = 'users_table';
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
        (user,	name, last_name, mail, password, user_type) 
        VALUES (?,?,?,?,?,?)");
      $stm->execute(array(
        $this->username,
        $this->name,
        $this->last_name,
        $this->mail,
        $this->password,
        $this->user_type,
      ));
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function update()
  {
    return;
  }
  public function editPassword()
  {
    try {
      //code...
      $stm = $this->pdo->prepare("UPDATE " . self::TABLE . " SET password=? WHERE users=?");
      $stm->execute(array(
        $this->password,
        $this->username
      ));
    } catch (PDOException $e) {
      //throw $e;
      echo $e->getMessage();
    }
  }
  public function get_by_username($user)
  {
    /** RETORNA EL ELEMENTO QUE HAGA MATCH CON @user */
    try {
      //code...

      $stm = $this->pdo->prepare("SELECT * FROM " .  self::TABLE . " WHERE user=?");
      $stm->execute(array($user));
      return $stm->fetch(PDO::FETCH_OBJ);
    } catch (\PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function get_by_mail($mail)
  {
    /** RETORNA EL ELEMENTO QUE HAGA MATCH CON @mail */
    try {
      //code...

      $stm = $this->pdo->prepare("SELECT * FROM " .  self::TABLE . " WHERE mail=?");
      $stm->execute(array($mail));
      return $stm->fetch(PDO::FETCH_OBJ);
    } catch (\PDOException $e) {
      echo $e->getMessage();
    }
  }

  public function get_all_active($estatus)
  {
    /** RETORNA TODOS LOS ELEMENTOS DE LA TABLA usando el parametro @status*/
    try {
      //code...

      $stm = $this->pdo->prepare("SELECT * FROM " .  self::TABLE . " WHERE status=?" );
      $stm->execute(array($estatus));
      return $stm->fetchAll(PDO::FETCH_OBJ);
    } catch (\PDOException $e) {
      echo $e->getMessage();
    }
  }


  public function update_image()
  {
    // Modidica la imagen del usuario
    try {
      //code...
      $stm = $this->pdo->prepare("UPDATE " . self::TABLE . " SET profile_image=? WHERE id=?");
      $stm->execute(array(
       
        $this->profile_image,
        $this->id
      ));
    } catch (PDOException $e) {
      //throw $e;
      echo $e->getMessage();
    }
  }

  public function update_profile()
  {
    // modifica los campos no sencibles del usuario
    try {
      //code...
      $stm = $this->pdo->prepare("UPDATE " . self::TABLE . " SET name=?, last_name=? WHERE id=?");
      $stm->execute(array(
       
        $this->name,
        $this->last_name,
        $this->id
      ));
    } catch (PDOException $e) {
      //throw $e;
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

  public function set_new_password()
  {
    // inhabilita el usuario, no lo elimina
    try {
      //code...
      $stm = $this->pdo->prepare("UPDATE " . self::TABLE . " SET password=? WHERE id=?");
      $stm->execute(array(
       
        $this->password,
        $this->id
      ));
    } catch (PDOException $e) {
      //throw $e;
      echo $e->getMessage();
    }
  }
  public function get_all_by_rol($rol, $estatus)
  {
    /** RETORNA TODOS LOS ELEMENTOS DE LA TABLA usando el parametro @status*/
    try {
      //code...

      $stm = $this->pdo->prepare("SELECT * FROM " .  self::TABLE . " WHERE user_type=? AND status=? " );
      $stm->execute(array($rol, $estatus));
      return $stm->fetchAll(PDO::FETCH_OBJ);
    } catch (\PDOException $e) {
      echo $e->getMessage();
    }
  }
}