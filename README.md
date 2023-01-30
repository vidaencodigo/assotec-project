# ASESOTEC 


### Para desarrolladores

- Requiere Bootstrap 5 (./libs)
- Se requier del archivo const (leet const_templat.txt) en la ruta ./core/const.php
- PHP 5 o superior
- MYSQL
- La carpeta modelos contiene los modelos de cada modulo 
- Los controladores tienen que ser nombrados ``` nombreControllador_controller.php ```
- Las clases de controladores se deben nombrar ``` NombreController {}  ```
- Utiliza PDO para las conexion a la BD
- Se trabaja con POO (programación orientada a objetos) por lo tanto todas las respuestas de la BD se devuelven como objeto, lo mismo que para hacer consultas
ejemplo:
```php
<?php 
require_once "model/modelo.php"
// llamada de modelo

claseController {
    private $modelo;
    public function __construct()
    {
        // se crea primer objeto al invocar a la clase
        $this->modelo = new ModeloEjemplo();
    }
    public function example()
    {
        // para metodo post se valida antes
        if ($_SERVER['REQUEST_METHOD'] == "POST") :
            //ejemplo buscar usuario
            $usuario = $this->modelo->get_by_id($_REQUEST['id_user']);
            // ... con un if se puede validar si retorna respesta
            //como almacenar, editar, borrar
            $nuevo_usuario = new ModeloEjemplo();
            $nuevo_usuario->name = $_REQUEST['name'];
            $nuevo_usuario->create(); // update, delete respectivamente
        endif;
    }

} 
/*
 *  para recorrer una consulta se utiliza foreaach
 *  al ser un objeto se llaman directamaente sus atributos
 **/
$usuarios = $this->modelo->get_all();

foreach($usuarios as $usuario):
    echo $usuario->name;
endforeach;
```

- Se utuliza CSRF Token para prevenir ataques cruzados

```php
<?php 
require_once "model/modelo.php"
// llamada de modelo

claseController {
    private $modelo;
    private $url_templates = "view/viewFolder/";
    public function __construct()
    {
        // se crea primer objeto al invocar a la clase
        $this->modelo = new ModeloEjemplo();
    }
    public function get_view()
    {
        /** 
         * CSRF TOKEN
         * PREVENT cross-site request ATACKS
         * Using a simple unique code between request 
         * more in https://www.w3.org/Security/wiki/Cross_Site_Attacks
         */

        //  Genera un token a la vez
        $_SESSION['token'] =  bin2hex(random_bytes(35));
        // view
        require_once($this->url_templates . "new_view.php");
    }
    public function example()
    {
        // para metodo post se valida antes
        if ($_SERVER['REQUEST_METHOD'] == "POST") :
            $token = $_REQUEST['token'];
            // Se valida el token (que viene desde el formulario)
            if (!$token || $token !== $_SESSION['token']) :
                // show an error message 
                echo '<p class="error">Error: invalid form submission</p>';
                // return 405 http status code
                header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
                exit; // termina nates de ejecutar el codigo siguiente
            endif;
            //ejemplo buscar usuario
            $usuario = $this->modelo->get_by_id($_REQUEST['id_user']);
            // ... con un if se puede validar si retorna respesta
            //como almacenar, editar, borrar
            $nuevo_usuario = new ModeloEjemplo();
            $nuevo_usuario->name = $_REQUEST['name'];
            $nuevo_usuario->create(); // update, delete respectivamente
        endif;
    }

} 

```