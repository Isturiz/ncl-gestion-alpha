<?php
require_once 'conexion.php'; //incluimos el archivo de php de conexion
// heredamos la clase conexion
class entrada_producto extends Conexion
{ 
	//definimo los atributos de nuestra clase
	protected $id;
	protected $fecha;
	protected $id_producto;
	protected $cantidad;
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
	public function setid_producto($id_producto)
	{
		$this->id_producto = $id_producto;
	}
	public function getid_producto()
	{
		return $this->id_producto;
	}
		public function setcantidad($cantidad)
	{
		$this->cantidad = $cantidad;
	}
	public function getcantidad()
	{
		return $this->cantidad;
	}
	//metodos para operar con la base de datos
	public function registrar()
	{
		if (Conexion::getEstatusConexion()) { //verificamos que la conexion esta activa
			$strSql = 'INSERT INTO entrada_producto (fecha, id_producto, cantidad) VALUES (:fecha, :id_producto, :cantidad)'; //realizamos una cadena de texto con la instruccion sql a realizar
			$respuestaArreglo = '';  //definimos la variable a retornar los datos de la ejecucion de la instruccion sql
			try {
				$strExec = Conexion::prepare($strSql);  
				$strExec->bindValue(':fecha', $this->fecha); 
				$strExec->bindValue(':id_producto', $this->id_producto); 
				$strExec->bindValue(':cantidad', $this->cantidad); 
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
	
	public function __destruct()
	{//metodo destructor de la clase
		parent::cerrarConexion(); //ejecutamos la simulacion de cierre de conexion
	}
}