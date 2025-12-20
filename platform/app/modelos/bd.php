<?php
if (file_exists(dirname(__FILE__) . '/../config.local.php')) {
    require_once(dirname(__FILE__) . '/../config.local.php');
}

abstract class Conexion
{
  private static $bd_host = null;
  private static $bd_user = null;
  private static $bd_pass = null;
  protected $bd_name = null;
  
  private static function getDbHost() {
      if (self::$bd_host === null) {
          if (defined('DB_HOST')) {
              self::$bd_host = DB_HOST;
          } else {
              self::$bd_host = "localhost";
          }
      }
      return self::$bd_host;
  }
  
  private static function getDbUser() {
      if (self::$bd_user === null) {
          if (defined('DB_USER')) {
              self::$bd_user = DB_USER;
          } else {
              self::$bd_user = "root";
          }
      }
      return self::$bd_user;
  }
  
  private static function getDbPass() {
      if (self::$bd_pass === null) {
          if (defined('DB_PASS')) {
              self::$bd_pass = DB_PASS;
          } else {
              self::$bd_pass = "";
          }
      }
      return self::$bd_pass;
  }
  
  protected function getDbName() {
      if ($this->bd_name === null) {
          if (defined('DB_NAME')) {
              $this->bd_name = DB_NAME;
          } else {
              $this->bd_name = "urglo_local";
          }
      }
      return $this->bd_name;
  }
	protected $conexion;
	protected $codigosql;
	protected $consulta;
	protected $filas_afectadas;
	protected $resultado;
	protected $num_resultados;

	protected function conectar_db()
	{
	    $this->conexion = mysqli_connect(self::getDbHost(), self::getDbUser(), self::getDbPass(), $this->getDbName());
	    if (mysqli_connect_errno()) 
	    {
	      die("Error al conectar con MySQL");
	    }
	    mysqli_set_charset($this->conexion,"utf8");
    }

	protected function desconectar_db()
	{
		mysqli_close($this->conexion);
	}

	protected function consulta_simple()
	{
		$this->conectar_db();
		$this->consulta = mysqli_query($this->conexion, $this->codigosql);
		$this->desconectar_db();
	}

	protected function obtener_resultados()
	{
		unset($this->resultado);
		$this->conectar_db();
		$this->consulta = mysqli_query($this->conexion, $this->codigosql);
		while ($this->resultado[] = mysqli_fetch_array($this->consulta, MYSQLI_ASSOC));
		$this->num_resultados = mysqli_num_rows($this->consulta);
		$this->desconectar_db();
		unset($this->resultado[count($this->resultado)-1]);
	}
}

class db{

  private $dbhost;
  private $dbuser;
  private $dbpass;
  private $dbname;
  private $conn;

//En el constructor de la clase establecemos los parámetros de conexión con la base de datos

  function __construct($dbuser = 'root', $dbpass = '', $dbname = 'base_de_datos', $dbhost = 'localhost'){

    $this->dbhost = $dbhost;
    $this->dbuser = $dbuser;
    $this->dbpass = $dbpass;
    $this->dbname = $dbname;

  }

//El método abrir establece una conexión con la base de datos

  public function abrir(){
    $this->conn = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass,$this->dbname);
    if (mysqli_connect_errno()) {
      die('Error al conectar con mysql');
    }

  }

//El método "consulta" ejecuta la sentencia select que recibe por parámetro "$query" a la base de datos y devuelve un array asociativo con los datos que obtuvo de la base de datos para facilitar su posteiror manejo.

  public function consulta($query){
    $valores = array();

    $result = mysqli_query($this->conn,$query);
    if (!$result) {
      die('Error query BD:' . mysqli_error());
    }else{
      $num_rows= mysqli_num_rows($result);
      for($i=0;$i<$num_rows;$i++){
        $row = mysqli_fetch_assoc($result);
        array_push($valores, $row);
      }
    }

    return $valores;
  }

//La función sql nos permite ejecutar una senetencia sql en la base de datos, se suele utilizar para senetencias insert y update.

  public function sql($sql){
    $resultado=mysqli_query($this->conn,$sql);
    return $resultado;
  }

//La función id nos devuelve el identificador del último registro insertado en la base de datos

  public function id(){
    return mysqli_insert_id($this->conn);
  }

//La función "cerrar" finaliza la conexión con la base de datos.

  public function cerrar(){
    mysqli_close($this->conn);
  }

//La función 'escape' escapa los caracteres especiales de una cadena para usarla en una sentencia SQL

  public function escape($value){
    return mysqli_real_escape_string($this->conn,$value);
  }

}
?>
