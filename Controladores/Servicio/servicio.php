<?php
if (!empty($_POST))
{
	if(isset($_POST['Insertar']))
	{
		require_once '../../Modelos/servicio.php';
		$servicio = new servicio(); //definimos la instancia	
		$servicio->setNombre($_POST["nombre"]); 
		$servicio->setcosto($_POST["costo"]); 
		$servicio->setstatus($_POST["status"]);
		$r1=$servicio->Existeservicio();
		$mensaje = '';
		if ($r1['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
			if (count($r1)>1) {  //contamos la cantidad de elemento en el arreglo
				$mensaje="El servicio ya Existe en la base de Datos";
			}
			else{ //sino hay mas de 1 registro
				$error = $servicio->registrar();
				if ($error['estatus']==false) { ////verificamos si se ejecuto correctamente el metodo del modelo
					$mensaje = 'Registro Exitoso';
				} else {//si hay un error al registrar
					$mensaje = 'Error al registrar el servicio, contacte con el soporte';
				}
			}
		}
		echo"<script>alert('".$mensaje."');  </script>";
		require_once '../../Controladores/Servicio/consultar.php';
	}
    
    if (isset($_POST["Actualizar"])) 
	{
	 if (isset($_POST["id"])) 
	 { 
		require_once '../../Modelos/servicio.php';
		$objservicio = new servicio();
		$objservicio->setid($_POST['id']);
		$objservicio->setnombre($_POST['nombre']);
		$objservicio->setcosto($_POST['costo']); 
		$objservicio->setstatus($_POST['status']);
		$r2=$objservicio->consultar();
		$mensaje = '';
		if ($r2['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
			if (count($r2)<1) {  //contamos la cantidad de elemento en el arreglo
				$mensaje="El servicio no Existe en la base de Datos";
			 }
			else{ //sino hay mas de 1 registro
				$error = $objservicio->actualizar();
				if ($error['estatus']==false) { ////verificamos si se ejecuto correctamente el metodo del modelo
					$mensaje = 'Actualización Exitosa';
				} else {//si hay un error al registrar
					$mensaje = 'Error al actualizar el servicio, contacte con el soporte';
				}
			}
		}else{//si hay un error al consultar
			$mensaje = 'Error al actualizar el servicio, contacte con el soporte';
			require_once '../../Vistas/mensaje-vista.php';
		}
		echo"<script>alert('".$mensaje."');  </script>";
		require_once '../../Controladores/Servicio/consultar.php';
	  }
    } 
     
    if (isset($_POST["Eliminar"])) 
	{    
    	if (isset($_POST["id"])) 
    	{
			require_once '../../Modelos/servicio.php';
			$objservicio = new servicio();
			$objservicio->setid($_POST['id']);
			$r1=$objservicio->consultar();
			$mensaje = '';
			if ($r1['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
				if (count($r1)<2) {  //contamos la cantidad de elemento en el arreglo
				$mensaje="El servicio no Existe en la base de Datos";
				}
				else{ //sino hay mas de 1 registro
					$error = $objservicio->eliminar();
				if ($error['estatus']==false) { ////verificamos si se ejecuto correctamente el metodo del modelo
					$mensaje = 'servicio Eliminado';
				} else {//si hay un error al registrar
					$mensaje = 'Error al Eliminar el servicio, contacte con el soporte';
				}
				}
			}	else{//si hay un error al consultar
				$mensaje = 'Error al Eliminar el servicio, contacte con el soporte';
				require_once '../../Vistas/mensaje-vista.php';
				}
			echo"<script>alert('".$mensaje."');  </script>";
			require_once '../../Controladores/Servicio/consultar.php';
		}
	}
	if (isset($_POST["Cargar_Datos"])) 
	{ if (isset($_POST["id"])) {
		require_once '../../Modelos/servicio.php';
		$objservicio = new servicio();
		$objservicio->setid($_POST['id']);
		$r2=$objservicio->consultar();
		$mensaje = '';
		if ($r2['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
			require_once '../../Vistas/Servicio/actualizar.php';
		}else{//si hay un error al consultar
			$mensaje = 'Error al consultar el servicio, contacte con el soporte';
			require_once '../../Vistas/mensaje-vista.php';
		}
	} }
}
 ?>



