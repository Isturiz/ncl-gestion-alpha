<?php
if (!empty($_POST))
{
	if(isset($_POST['Insertar']))
	{
		require_once '../../Modelos/cliente.php';
		$cliente = new cliente(); //definimos la instancia	
		$cliente->setcedula($_POST["cedula"]);
		$cliente->setNombre($_POST["nombre"]); 
		$cliente->setapellido($_POST["apellido"]); 
		$cliente->setdomicilio($_POST["direccion"]);
		$cliente->settelefono($_POST["telefono"]);
		$r1=$cliente->Existecliente();
		$mensaje = '';
		if ($r1['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
			if (count($r1)>1) {  //contamos la cantidad de elemento en el arreglo
				$mensaje="El cliente ya Existe en la base de Datos";
			}
			else{ //sino hay mas de 1 registro
				$error = $cliente->registrar();
				if ($error['estatus']==false) { ////verificamos si se ejecuto correctamente el metodo del modelo
					$mensaje = 'Registro Exitoso';
				} else {//si hay un error al registrar
					$mensaje = 'Error al registrar el cliente, contacte con el soporte';
				}
			}
		}
		echo"<script>alert('".$mensaje."');  </script>";
		require_once '../../Controladores/Cliente/consultar.php';
	}
    
    if (isset($_POST["Actualizar"])) 
	{
	 if (isset($_POST["cedula"])) 
	 { 
		require_once '../../Modelos/cliente.php';
		$objcliente = new cliente();
		$objcliente->setcedula($_POST['cedula']);
		$objcliente->setnombre($_POST['nombre']);
		$objcliente->setapellido($_POST['apellido']); 
		$objcliente->setdomicilio($_POST['domicilio']);
		$objcliente->settelefono($_POST['telefono']);
		$r2=$objcliente->consultar();
		$mensaje = '';
		if ($r2['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
			if (count($r2)<1) {  //contamos la cantidad de elemento en el arreglo
				$mensaje="El cliente no Existe en la base de Datos";
			 }
			else{ //sino hay mas de 1 registro
				$error = $objcliente->actualizar();
				if ($error['estatus']==false) { ////verificamos si se ejecuto correctamente el metodo del modelo
					$mensaje = 'Actualización Exitosa';
				} else {//si hay un error al registrar
					$mensaje = 'Error al actualizar el cliente, contacte con el soporte';
				}
			}
		}else{//si hay un error al consultar
			$mensaje = 'Error al actualizar el cliente, contacte con el soporte';
			require_once '../../Vistas/mensaje-vista.php';
		}
		echo"<script>alert('".$mensaje."');  </script>";
		require_once '../../Controladores/Cliente/consultar.php';
	  }
    } 
     
    if (isset($_POST["Eliminar"])) 
	{    
    	if (isset($_POST["cedula"])) 
    	{
			require_once '../../Modelos/cliente.php';
			$objcliente = new cliente();
			$objcliente->setcedula($_POST['cedula']);
			$r1=$objcliente->consultar();
			$mensaje = '';
			if ($r1['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
				if (count($r1)<2) {  //contamos la cantidad de elemento en el arreglo
				$mensaje="El cliente no Existe en la base de Datos";
				}
				else{ //sino hay mas de 1 registro
					$error = $objcliente->eliminar();
				if ($error['estatus']==false) { ////verificamos si se ejecuto correctamente el metodo del modelo
					$mensaje = 'cliente Eliminado';
				} else {//si hay un error al registrar
					$mensaje = 'Error al Eliminar el cliente, contacte con el soporte';
				}
				}
			}	else{//si hay un error al consultar
				$mensaje = 'Error al Eliminar el cliente, contacte con el soporte';
				require_once '../../Vistas/mensaje-vista.php';
				}
			echo"<script>alert('".$mensaje."');  </script>";
			require_once '../../Controladores/Cliente/consultar.php';
		}
	}
	if (isset($_POST["Cargar_Datos"])) 
	{ if (isset($_POST["cedula"])) {
		require_once '../../Modelos/cliente.php';
		$objcliente = new cliente();
		$objcliente->setcedula($_POST['cedula']);
		$r2=$objcliente->consultar();
		$mensaje = '';
		if ($r2['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
			require_once '../../Vistas/Cliente/actualizar.php';
		}else{//si hay un error al consultar
			$mensaje = 'Error al consultar el cliente, contacte con el soporte';
			require_once '../../Vistas/mensaje-vista.php';
		}
	} }
}
 ?>



