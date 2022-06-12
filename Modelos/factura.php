<?php
require_once 'conexion.php'; //incluimos el archivo de php de conexion
// heredamos la clase conexion
class factura extends Conexion
{ 
	//definimo los atributos de nuestra clase
	protected $id;
	protected $fecha;
	protected $id_usuario;
	protected $id_auto;
	protected $total;

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
	public function setfecha($fecha)
	{
		$this->fecha = $fecha;
	}
	public function getfecha()
	{
		return $this->fecha;
	}
	public function setid_usuario($id_usuario)
	{
		$this->id_usuario = $id_usuario;
	}
	public function getid_usuario()
	{
		return $this->id_usuario;
	}
		public function setid_auto($id_auto)
	{
		$this->id_auto = $id_auto;
	}
	public function getid_auto()
	{
		return $this->id_auto;
	}
	public function settotal($total)
	{
		$this->total = $total;
	}
	public function gettotal()
	{
		return $this->total;
	}
	
	//metodos para operar con la base de datos
	public function registrar()
	{
		if (Conexion::getEstatusConexion()) { //verificamos que la conexion esta activa
			$strSql = 'INSERT INTO factura (fecha, id_usuario, id_auto, total) VALUES (:fecha, :id_usuario, :id_auto, :total)'; //realizamos una cadena de texto con la instruccion sql a realizar
			$respuestaArreglo = '';  //definimos la variable a retornar los datos de la ejecucion de la instruccion sql
			try {
				$strExec = Conexion::prepare($strSql);   
				$strExec->bindValue(':fecha', $this->fecha); 
				$strExec->bindValue(':id_usuario', $this->id_usuario); 
				$strExec->bindValue(':id_auto', $this->id_auto); 
				$strExec->bindValue(':total', $this->total); 
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
			$strSql = 'SELECT * FROM factura WHERE id=:id';
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
		public function ExtraerId()
	{
		if (Conexion::getEstatusConexion()) {
			$strSql = 'SELECT id FROM `factura` order by id desc LIMIT 1';
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
	public function Existefactura()
	{
		if (Conexion::getEstatusConexion()) {
			$strSql = 'SELECT f.fecha AS fecha, f.id AS id, c.nombre AS nombre, c.apellido AS apellido, a.placa AS placa, f.total AS total FROM factura f INNER JOIN auto a ON f.id_auto=a.id INNER JOIN cliente c ON c.id=a.id_cliente WHERE f.id=:id';
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

	public function getAll()
	{
		if (Conexion::getEstatusConexion()) {
			$strSql = 'SELECT *FROM factura';
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
		$strSql = 'UPDATE factura SET fecha=:fecha, id_usuario=:id_usuario, id_auto=:id_auto, total=:total WHERE id=:id'; //realizamos una cadena de texto con la instruccion sql a realizar
			$respuestaArreglo = '';  //definimos la variable a retornar los datos de la ejecucion de la instruccion sql
			try {
				$strExec = Conexion::prepare($strSql); // preparamos la sentencia
				//  http://php.net/manual/es/pdo.prepare.php// http://php.net/manual/es/pdostatement.bindvalue.php
				$strExec->bindValue(':fecha', $this->fecha);
				$strExec->bindValue(':id_usuario', $this->id_usuario);
				$strExec->bindValue(':id_auto', $this->id_auto);
				$strExec->bindValue(':total', $this->total);
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

		public function consultarfechafactura()
	{
		if (Conexion::getEstatusConexion()) {
			$strSql = 'SELECT f.fecha AS fecha, f.id AS id, c.nombre AS nombre, c.apellido AS apellido, a.placa AS placa, f.total AS total FROM factura f INNER JOIN auto a ON f.id_auto=a.id INNER JOIN cliente c ON c.id=a.id_cliente';
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
			$strSql = 'DELETE FROM factura WHERE id=:id';
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