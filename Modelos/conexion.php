<?php

abstract class Conexion extends PDO
{

	private $host = 'localhost'; 
	private $bd = 'ncl-gestion-alpha'; 
	private $user = 'root'; 
	private $password = ""; 
	
	private $respuestaConexion = false;
	private $errorMensaje = "";
	private $options = [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
		PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING, 
		PDO::ATTR_CASE => PDO::CASE_NATURAL, 
	];

	protected function realizarConexion()
	{
			parent::__construct("mysql:host={$this->host};port=3306 ;dbname={$this->bd}", $this->user, $this->password, $this->options);//ejecutamos la conexion // parent::__construct se utiliza los metodo y atributos de la clase o clases que extendemos/heredamos
		try {
			$this->respuestaConexion = true;
			$this->errorMensaje = "";	
		} catch (PDOException $e) { 
			$this->respuestaConexion = false; 
			$this->errorMensaje = $e;
		}
   
	}

	protected function getEstatusConexion()
	{
		return $this->respuestaConexion;
	}

	protected function getErrorConexion()
	{ 
		return $this->errorMensaje;
	}

	protected function cerrarConexion()
	{
		$this->respuestaConexion = false;
	}
}


?>