<?php
require_once 'conexion.php'; //incluimos el archivo de php de conexion
// heredamos la clase conexion
class cliente extends Conexion
{ 
	//definimo los atributos de nuestra clase
	protected $id;
	protected $cedula;
	protected $nombre;
	protected $apellido;
	protected $domicilio;
	protected $telefono;
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
	public function setcedula($cedula)
	{
		$this->cedula = $cedula;
	}
	public function getcedula()
	{
		return $this->cedula;
	}
	public function setNombre($nombre)
	{
		$this->nombre = $nombre;
	}
	public function getNombre()
	{
		return $this->nombre;
	}
	public function setapellido($apellido)
	{
		$this->apellido = $apellido;
	}
	public function getapellido()
	{
		return $this->apellido;
	}
		public function setdomicilio($domicilio)
	{
		$this->domicilio = $domicilio;
	}
	public function getdomicilio()
	{
		return $this->domicilio;
	}
		public function settelefono($telefono)
	{
		$this->telefono = $telefono;
	}
	public function gettelefono()
	{
		return $this->telefono;
	}
	//metodos para operar con la base de datos
	public function registrar()
	{
		if (Conexion::getEstatusConexion()) { //verificamos que la conexion esta activa
			$strSql = 'INSERT INTO cliente (cedula, nombre, apellido, domicilio, telefono) VALUES (:cedula, :nombre, :apellido, :domicilio, :telefono)'; //realizamos una cadena de texto con la instruccion sql a realizar
			$respuestaArreglo = '';  //definimos la variable a retornar los datos de la ejecucion de la instruccion sql
			try {
				$strExec = Conexion::prepare($strSql);  
				$strExec->bindValue(':cedula', $this->cedula); 
				$strExec->bindValue(':nombre', $this->nombre); 
				$strExec->bindValue(':apellido', $this->apellido); 
				$strExec->bindValue(':domicilio', $this->domicilio); 
				$strExec->bindValue(':telefono', $this->telefono); 
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
			$strSql = 'SELECT * FROM cliente WHERE cedula=:cedula';
			$respuestaArreglo = '';
			try {
				$strExec = Conexion::prepare($strSql);

				$strExec->bindValue(':cedula', $this->cedula);
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

	public function Existecliente()
	{
		if (Conexion::getEstatusConexion()) {
			$strSql = 'SELECT * FROM cliente WHERE cedula=:cedula AND nombre=:nombre AND apellido=:apellido AND domicilio=:domicilio AND telefono=:telefono';
			$respuestaArreglo = '';
			try {
				$strExec = Conexion::prepare($strSql);
				$strExec->bindValue(':cedula', $this->cedula);
				$strExec->bindValue(':nombre', $this->nombre);
				$strExec->bindValue(':apellido', $this->apellido);
				$strExec->bindValue(':domicilio', $this->domicilio);
				$strExec->bindValue(':telefono', $this->telefono);
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
			$strSql = 'SELECT *FROM cliente';
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
		$strSql = 'UPDATE cliente SET nombre=:nombre, apellido=:apellido, domicilio=:domicilio, telefono=:telefono WHERE cedula=:cedula'; //realizamos una cadena de texto con la instruccion sql a realizar
			$respuestaArreglo = '';  //definimos la variable a retornar los datos de la ejecucion de la instruccion sql
			try {
				$strExec = Conexion::prepare($strSql); // preparamos la sentencia
				//  http://php.net/manual/es/pdo.prepare.php// http://php.net/manual/es/pdostatement.bindvalue.php
				$strExec->bindValue(':cedula', $this->cedula);
				$strExec->bindValue(':nombre', $this->nombre);
				$strExec->bindValue(':apellido', $this->apellido);
				$strExec->bindValue(':domicilio', $this->domicilio);
				$strExec->bindValue(':telefono', $this->telefono);
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
	public function consultarNombrecliente()
	{
		if (Conexion::getEstatusConexion()) {
			$strSql = 'SELECT id, cedula, nombre, apellido, domicilio, telefono FROM cliente WHERE nombre LIKE :nombre ORDER BY cedula DESC';
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
			$strSql = 'DELETE FROM cliente WHERE cedula=:cedula';
			$respuestaArreglo = '';
			try {
				$strExec = Conexion::prepare($strSql);

				$strExec->bindValue(':cedula', $this->cedula);
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