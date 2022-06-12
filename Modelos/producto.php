<?php
require_once 'conexion.php'; //incluimos el archivo de php de conexion
// heredamos la clase conexion
class producto extends Conexion
{ 
	//definimo los atributos de nuestra clase
	protected $id;
	protected $nombre;
	protected $id_medida;
	protected $precio;
	protected $existencia;
	protected $status;
	public function __construct()
	{
		//llamamos el metodo de crear la conexion previamente definido en la clase Conexion
		Conexion::realizarConexion();
	}
	//realizamos los metodos  set y get  de cada uno de los atributos
	public function setid($id)
	{
		$this->id = $id;
	}
	public function getid()
	{
		return $this->id;
	}
	public function setNombre($nombre)
	{
		$this->nombre = $nombre;
	}
	public function getNombre()
	{
		return $this->nombre;
	}
	public function setid_medida($id_medida)
	{
		$this->id_medida = $id_medida;
	}
	public function getid_medida()
	{
		return $this->id_medida;
	}
		public function setprecio($precio)
	{
		$this->precio = $precio;
	}
	public function getprecio()
	{
		return $this->precio;
	}
		public function setexistencia($existencia)
	{
		$this->existencia = $existencia;
	}
	public function getexistencia()
	{
		return $this->existencia;
	}
		public function setstatus($status)
	{
		$this->status = $status;
	}
	public function getstatus()
	{
		return $this->status;
	}
	//metodos para operar con la base de datos
	public function registrar()
	{
		if (Conexion::getEstatusConexion()) { //verificamos que la conexion esta activa
			$strSql = 'INSERT INTO producto (nombre, id_medida, precio, existencia, status) VALUES (:nombre, :id_medida, :precio, :existencia, :status)'; //realizamos una cadena de texto con la instruccion sql a realizar
			$respuestaArreglo = '';  //definimos la variable a retornar los datos de la ejecucion de la instruccion sql
			try {
				$strExec = Conexion::prepare($strSql);  
				$strExec->bindValue(':nombre', $this->nombre); 
				$strExec->bindValue(':id_medida', $this->id_medida); 
				$strExec->bindValue(':precio', $this->precio); 
				$strExec->bindValue(':existencia', $this->existencia); 
				$strExec->bindValue(':status', $this->status); 
				$strExec->execute(); //ejecutamos la instruccion sql
				$respuestaArreglo = $strExec->fetchAll(); //retornamos todos los datos de la ejecucion
				$respuestaArreglo += ['estatus' => true];
			} catch (PDOException $e) 
			{  
				$errorReturn = ['estatus' => false];
				$errorReturn += ['info' => "error sql:{$e}"];
				return $errorReturn; //retornamos el contenido de esa variable
			}
			$respuestaI = Conexion::lastInsertId(); //obtenemos ID (clave primaria de la tabla) para implementarlo en otros registros
			return $respuestaArreglo; //retornamos los datos del arreglo
		} else { //sino hay conexion
			$errorReturn = ['estatus' => false];
			$errorReturn += ['info' => 'error sql:'.Conexion::getErrorConexion()];
			return $errorReturn; //retorno el mensaje de error generado
		}
	}

	public function consultar()
	{
		if (Conexion::getEstatusConexion()) {
			$strSql = 'SELECT * FROM producto WHERE id=:id';
			$respuestaArreglo = '';
			try {
				$strExec = Conexion::prepare($strSql);

				$strExec->bindValue(':id', $this->id);
				$strExec->execute();
				$respuestaArreglo = $strExec->fetchAll();
				$respuestaArreglo += ['estatus' => true];
			} catch (PDOException $e) {
				$errorReturn = ['estatus' => false];
				$errorReturn += ['info' => "error sql:{$e}"];
				return $errorReturn;
			}
			return $respuestaArreglo;
		} else {
			$errorReturn = ['estatus' => false];
			$errorReturn += ['info' => 'error sql:'.Conexion::getErrorConexion()];
			return $errorReturn;
		}
	}

	public function Existeproducto()
	{
		if (Conexion::getEstatusConexion()) {
			$strSql = 'SELECT * FROM producto WHERE nombre=:nombre AND id_medida=:id_medida AND precio=:precio AND existencia=:existencia';
			
			$respuestaArreglo = '';
			try {
				$strExec = Conexion::prepare($strSql);
				$strExec->bindValue(':nombre', $this->nombre);
				$strExec->bindValue(':id_medida', $this->id_medida);
				$strExec->bindValue(':precio', $this->precio);
				$strExec->bindValue(':existencia', $this->existencia);
				$strExec->bindValue(':status', $this->status);
				$strExec->execute();
				$respuestaArreglo = $strExec->fetchAll();
				$respuestaArreglo += ['estatus' => true];
			} catch (PDOException $e) {
				$errorReturn = ['estatus' => false];
				$errorReturn += ['info' => "error sql:{$e}"];
				return $errorReturn;
			}
			return $respuestaArreglo;
		} else {
			$errorReturn = ['estatus' => false];
			$errorReturn += ['info' => 'error sql:'.Conexion::getErrorConexion()];
			return $errorReturn;
		}
	}

	public function getAll()
	{
		if (Conexion::getEstatusConexion()) {
			$strSql = 'SELECT *FROM producto';
			$respuestaArreglo = '';
			try {
				$strExec = Conexion::prepare($strSql);

				$strExec->execute();
				$respuestaArreglo = $strExec->fetchAll();
				$respuestaArreglo += ['estatus' => true];
			} catch (PDOException $e) {
				$errorReturn = ['estatus' => false];
				$errorReturn += ['info' => "error sql:{$e}"];

	 			return $errorReturn;
			}

			return $respuestaArreglo;
		} else {
			$errorReturn = ['estatus' => false];
			$errorReturn += ['info' => 'error sql:'.Conexion::getErrorConexion()];

			return $errorReturn;
		}
	}

	public function actualizar()
	{
		if (Conexion::getEstatusConexion()) { //verificamos que la conexion esta activa
		$strSql = 'UPDATE producto SET nombre=:nombre, precio=:precio, status=:status WHERE id=:id'; //realizamos una cadena de texto con la instruccion sql a realizar
			$respuestaArreglo = '';  //definimos la variable a retornar los datos de la ejecucion de la instruccion sql
			try {
				$strExec = Conexion::prepare($strSql); // preparamos la sentencia
				//  http://php.net/manual/es/pdo.prepare.php// http://php.net/manual/es/pdostatement.bindvalue.php
				$strExec->bindValue(':id', $this->id);
				$strExec->bindValue(':nombre', $this->nombre);
				$strExec->bindValue(':precio', $this->precio);
				$strExec->bindValue(':status', $this->status);
				$strExec->execute(); //ejecutamos la instruccion sql
				$respuestaArreglo = $strExec->fetchAll(); //retornamos todos los datos de la ejecucion
				$respuestaArreglo += ['estatus' => true];
			} catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
				$errorReturn = ['estatus' => false];
				$errorReturn += ['info' => "error sql:{$e}"];

				return $errorReturn; //retornamos el contenido de esa variable
			}
			return $respuestaArreglo; //retornamos los datos del arreglo
		} else { //sino hay conexion
			$errorReturn = ['estatus' => false];
			$errorReturn += ['info' => 'error sql:'.Conexion::getErrorConexion()];
			return $errorReturn; //retorno el mensaje de error generado
		}
	}
	public function inventario()
	{
		if (Conexion::getEstatusConexion()) { //verificamos que la conexion esta activa
		$strSql = 'UPDATE producto SET existencia=:existencia WHERE id=:id'; //realizamos una cadena de texto con la instruccion sql a realizar
			$respuestaArreglo = '';  //definimos la variable a retornar los datos de la ejecucion de la instruccion sql
			try {
				$strExec = Conexion::prepare($strSql); // preparamos la sentencia
				//  http://php.net/manual/es/pdo.prepare.php// http://php.net/manual/es/pdostatement.bindvalue.php
				$strExec->bindValue(':id', $this->id);
				$strExec->bindValue(':existencia', $this->existencia);
				$strExec->execute(); //ejecutamos la instruccion sql
				$respuestaArreglo = $strExec->fetchAll(); //retornamos todos los datos de la ejecucion
				$respuestaArreglo += ['estatus' => true];
			} catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
				$errorReturn = ['estatus' => false];
				$errorReturn += ['info' => "error sql:{$e}"];

				return $errorReturn; //retornamos el contenido de esa variable
			}
			return $respuestaArreglo; //retornamos los datos del arreglo
		} else { //sino hay conexion
			$errorReturn = ['estatus' => false];
			$errorReturn += ['info' => 'error sql:'.Conexion::getErrorConexion()];
			return $errorReturn; //retorno el mensaje de error generado
		}
	}
	public function consultarNombreproducto()
	{
		if (Conexion::getEstatusConexion()) {
			$strSql = 'SELECT m.medida as medida, m.nombre as abrev, p.id as id, p.nombre as nombre, p.precio as precio, p.existencia as existencia, p.status as status FROM producto p INNER JOIN medida m ON m.id= p.id_medida ORDER BY id DESC';
			
			$respuestaArreglo = [];
			try {
				$strExec = Conexion::prepare($strSql);
				$strExec->execute();
				$respuestaArreglo = $strExec->fetchAll();
				$respuestaArreglo += ['estatus' => true];
			} catch (PDOException $e) {
				$errorReturn = ['estatus' => false];
				$errorReturn += ['info' => "error sql:{$e}"];

				return $errorReturn;
			}

			return $respuestaArreglo;
		} else {
			$errorReturn = ['estatus' => false];
			$errorReturn += ['info' => 'error sql:'.Conexion::getErrorConexion()];

			return $errorReturn;
		}
	}

	public function eliminar()
	{
		if (Conexion::getEstatusConexion()) {
			$strSql = 'DELETE FROM producto WHERE id=:id';
			$respuestaArreglo = '';
			try {
				$strExec = Conexion::prepare($strSql);

				$strExec->bindValue(':id', $this->id);
				$strExec->execute();
				$respuestaArreglo = $strExec->fetchAll();
				$respuestaArreglo += ['estatus' => true];
			} catch (PDOException $e) {
				$errorReturn = ['estatus' => false];
				$errorReturn += ['info' => "error sql:{$e}"];

				return $errorReturn;
			}

			return $respuestaArreglo;
		} else {
			$errorReturn = ['estatus' => false];
			$errorReturn += ['info' => 'error sql:'.Conexion::getErrorConexion()];

			return $errorReturn;
		}
	}
	public function __destruct()
	{//metodo destructor de la clase
		parent::cerrarConexion(); //ejecutamos la simulacion de cierre de conexion
	}
}