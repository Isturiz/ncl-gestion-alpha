<?php
if (!empty($_POST))
{
	if(isset($_POST['Insertar']))
	{
		require_once '../../Modelos/modelo.php';
		$Objmodelo = new modelo(); //definimos la instancia	
		$Objmodelo->setNombre($_POST["nombre"]); 
		$Objmodelo->setid_marca($_POST["id_marca"]); 

		$sql = $Objmodelo->registrar();
		if ($sql['estatus']==false) { ////verificamos si se ejecuto correctamente el metodo del modelo
			$mensaje = 'Registro Exitoso';
		} else {//si hay un error al registrar
			$mensaje = 'Error al registrar el modelo, contacte con el soporte';
		}
		echo"<script>alert('".$mensaje."');  </script>";
		require_once '../../Controladores/Modelo/consultar.php';
	}
   if (isset($_POST["Actualizar"])) 
	{
	 if (isset($_POST["id"])) 
	 { 
		require_once '../../Modelos/modelo.php';
		$objmodelo = new modelo();
		$objmodelo->setid($_POST['id']);
		$objmodelo->setNombre($_POST['nombre']);
		$r2=$objmodelo->consultar();
		$mensaje = '';
		if ($r2['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
			if (count($r2)<1) {  //contamos la cantidad de elemento en el arreglo
				$mensaje="El cliente no Existe en la base de Datos";
			 }
			else{ //sino hay mas de 1 registro
				$error = $objmodelo->actualizar();
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
		require_once '../../Controladores/Modelo/consultar.php';
	  }
    } 
     
    if (isset($_POST["Eliminar"])) 
	{    
    	if (isset($_POST["id"])) 
    	{
			require_once '../../Modelos/modelo.php';
			$objmodelo = new modelo();
			$objmodelo->setid($_POST['id']);
			$r1=$objmodelo->consultar();
			$mensaje = '';
			if ($r1['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
				if (count($r1)<2) {  //contamos la cantidad de elemento en el arreglo
				$mensaje="El modelo no Existe en la base de Datos";
				}
				else{ //sino hay mas de 1 registro
					$error = $objmodelo->eliminar();
				if ($error['estatus']==false) { ////verificamos si se ejecuto correctamente el metodo del modelo
					$mensaje = 'Modelo Eliminado';
				} else {//si hay un error al registrar
					$mensaje = 'Error al Eliminar el modelo, contacte con el soporte';
				}
				}
			}	else{//si hay un error al consultar
				$mensaje = 'Error al Eliminar el modelo, contacte con el soporte';
				require_once '../../Vistas/mensaje-vista.php';
				}
			echo"<script>alert('".$mensaje."');  </script>";
			require_once '../../Controladores/Modelo/consultar.php';
		}
	}
	if (isset($_POST["Cargar_Datos"])) 
	{ if (isset($_POST["id"])) {
		require_once '../../Modelos/modelo.php';
		$objmodelo = new modelo();
		$objmodelo->setid($_POST['id']);
		$r2=$objmodelo->consultar();
		$mensaje = '';
		if ($r2['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
			require_once '../../Vistas/Modelo/actualizar.php';
		}else{//si hay un error al consultar
			$mensaje = 'Error al consultar el modelo, contacte con el soporte';
			require_once '../../Vistas/mensaje-vista.php';
		}
	} }
}
 ?>



