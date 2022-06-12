<?php
require_once 'conexion.php'; //incluimos el archivo de php de conexion
// heredamos la clase conexion
class factura_servicio extends Conexion
{ 
	//definimo los atributos de nuestra clase
	protected $id;
	protected $id_factura;
	protected $id_servicio;
	protected $precio;
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
	public function setid_factura($id_factura)
	{
		$this->id_factura = $id_factura;
	}
	public function getid_factura()
	{
		return $this->id_factura;
	}
		public function setid_servicio($id_servicio)
	{
		$this->id_servicio = $id_servicio;
	}
	public function getid_servicio()
	{
		return $this->id_servicio;
	}
		public function setprecio($precio)
	{
		$this->precio = $precio;
	}
	public function getprecio()
	{
		return $this->precio;
	}
	
	//metodos para operar con la base de datos
	public function registrar()
	{
		if (Conexion::getEstatusConexion()) { //verificamos que la conexion esta activa
			$strSql = 'INSERT INTO factura_servicio (id_factura, id_servicio, precio) VALUES (:id_factura, :id_servicio , :precio)'; //realizamos una cadena de texto con la instruccion sql a realizar
			$respuestaArreglo = '';  //definimos la variable a retornar los datos de la ejecucion de la instruccion sql
			try {
				$strExec = Conexion::prepare($strSql);   
				$strExec->bindValue(':id_factura', $this->id_factura); 
				$strExec->bindValue(':id_servicio', $this->id_servicio); 
				$strExec->bindValue(':precio', $this->precio); 
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
	public function ExisteServicio()
	{
		if (Conexion::getEstatusConexion()) {
			$strSql = 'SELECT s.id as servicio, s.nombre as nombre, fs.precio as precio FROM factura f INNER JOIN factura_servicio fs ON f.id=fs.id_factura INNER JOIN servicio s ON s.id=fs.id_servicio WHERE f.id=id_factura';
			$respuestaArreglo = '';
			try {
				$strExec = Conexion::prepare($strSql);
				$strExec->bindValue(':id_factura', $this->id_factura);
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
			$strSql = 'SELECT * FROM factura_servicio WHERE id=:id';
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
			$strSql = 'SELECT *FROM factura_servicio';
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
	public function eliminar()
	{
		if (Conexion::getEstatusConexion()) {
			$strSql = 'DELETE FROM factura_servicio WHERE id=:id';
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