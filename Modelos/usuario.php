<?php
require_once 'conexion.php'; //incluimos el archivo de php de conexion
// heredamos la clase conexion
class usuario extends Conexion
{ 
	//definimo los atributos de nuestra clase
	protected $id;
	protected $nombre;
	protected $clave;
	protected $tipo;
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
	public function setclave($clave)
	{
		$this->clave = $clave;
	}
	public function getclave()
	{
		return $this->clave;
	}
		public function settipo($tipo)
	{
		$this->tipo = $tipo;
	}
	public function gettipo()
	{
		return $this->tipo;
	}
	//metodos para operar con la base de datos
	public function registrar()
	{
		if (Conexion::getEstatusConexion()) { //verificamos que la conexion esta activa
			$strSql = 'INSERT INTO usuario ( nombre, clave, tipo) VALUES (:nombre, :clave, :tipo)'; //realizamos una cadena de texto con la instruccion sql a realizar
			$respuestaArreglo = '';  //definimos la variable a retornar los datos de la ejecucion de la instruccion sql
			try {
				$strExec = Conexion::prepare($strSql);  
				$strExec->bindValue(':nombre', $this->nombre); 
				$strExec->bindValue(':clave', $this->clave); 
				$strExec->bindValue(':tipo', $this->tipo); 
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
	public function validar()
	{
		if (Conexion::getEstatusConexion()) {
			$strSql = 'SELECT *FROM usuario WHERE clave=:clave AND nombre=:nombre';
			$respuestaArreglo = '';
			try {
				$strExec = Conexion::prepare($strSql);

				$strExec->bindValue(':clave', $this->clave);
				$strExec->bindValue(':nombre', $this->nombre);
				$strExec->execute();
				$respuestaArreglo = $strExec->fetchAll();
				$totalrs =count($respuestaArreglo);
				$respuestaArreglo += ['total' => $totalrs];
			} catch (PDOException $e) {
				$errorReturn = ['total' => 0];
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
	public function consultarPornombre($var)
	{
		if (Conexion::getEstatusConexion()) {
			$strSql = 'SELECT id, nombre FROM usuario WHERE nombre="'.$var.'" ';
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
	public function consultar()
	{
		if (Conexion::getEstatusConexion()) {
			$strSql = 'SELECT * FROM usuario WHERE id=:id';
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

	public function Existeusuario()
	{
		if (Conexion::getEstatusConexion()) {
			$strSql = 'SELECT * FROM usuario WHERE  nombre=:nombre AND clave=:clave AND tipo=:tipo';
			$respuestaArreglo = '';
			try {
				$strExec = Conexion::prepare($strSql);
				$strExec->bindValue(':nombre', $this->nombre);
				$strExec->bindValue(':clave', $this->clave);
				$strExec->bindValue(':tipo', $this->tipo);
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
			$strSql = 'SELECT *FROM usuario';
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
		$strSql = 'UPDATE usuario SET nombre=:nombre, clave=:clave, tipo=:tipo WHERE id=:id'; //realizamos una cadena de texto con la instruccion sql a realizar
			$respuestaArreglo = '';  //definimos la variable a retornar los datos de la ejecucion de la instruccion sql
			try {
				$strExec = Conexion::prepare($strSql); // preparamos la sentencia
				$strExec->bindValue(':nombre', $this->nombre);
				$strExec->bindValue(':clave', $this->clave);
				$strExec->bindValue(':tipo', $this->tipo);
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
	public function consultarNombreusuario()
	{
		if (Conexion::getEstatusConexion()) {
			$strSql = 'SELECT id, nombre, clave, tipo FROM usuario WHERE nombre LIKE :nombre ORDER BY id DESC';
			$respuestaArreglo = [];
			try {
				$strExec = Conexion::prepare($strSql);
				$strExec->bindValue(':nombre', "$this->nombre%");
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
			$strSql = 'DELETE FROM usuario WHERE id=:id';
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