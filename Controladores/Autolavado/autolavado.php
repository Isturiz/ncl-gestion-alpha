<?php
if (!empty($_POST))
{
	if(isset($_POST['Insertar']))
	{
		require_once '../../Modelos/factura.php';
		require_once '../../Modelos/factura_servicio.php';
		$contar= count($_POST['id_servicio']);
		$factura = new factura(); //definimos la instancia
		$factura_servicio = new factura_servicio(); //definimos la instancia
		$factura->setfecha($_POST['fecha']); 
		$factura->setid_usuario($_POST['userId']); 
		$factura->setid_auto($_POST["id_auto"]); 
		$factura->settotal($_POST["subTotal"]);
		$error = $factura->registrar();
		if ($error['estatus']==false) { ////verificamos si se ejecuto correctamente el metodo del modelo
			$mensaje = 'Registro Exitoso';
			$id_fact= $factura->ExtraerId();
			for ($i = 0; $i < $contar; $i++) {
				$factura_servicio->setid_factura($id_fact[0][0]); 
				$factura_servicio->setid_servicio($_POST['id_servicio'][$i]);
				$factura_servicio->setprecio($_POST['total'][$i]);
				$factura_servicio->registrar();
			} 
			
		} else {//si hay un error al registrar
			$mensaje = 'Error al registrar el factura, contacte con el soporte';
		}
		echo"<script>alert('".$mensaje."');  </script>";
		require_once '../../Controladores/Autolavado/consultar.php';
	}
    
    if (isset($_POST["Actualizar"])) 
	{
	 if (isset($_POST["id"])) 
	 { 
		require_once '../../Modelos/factura.php';
		$objfactura = new factura();
		$objfactura->setid($_POST['id']);
		$objfactura->setnombre($_POST['nombre']);
		$objfactura->setcosto($_POST['costo']); 
		$objfactura->setstatus($_POST['status']);
		$r2=$objfactura->consultar();
		$mensaje = '';
		if ($r2['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
			if (count($r2)<1) {  //contamos la cantidad de elemento en el arreglo
				$mensaje="El factura no Existe en la base de Datos";
			 }
			else{ //sino hay mas de 1 registro
				$error = $objfactura->actualizar();
				if ($error['estatus']==false) { ////verificamos si se ejecuto correctamente el metodo del modelo
					$mensaje = 'Actualización Exitosa';
				} else {//si hay un error al registrar
					$mensaje = 'Error al actualizar el factura, contacte con el soporte';
				}
			}
		}else{//si hay un error al consultar
			$mensaje = 'Error al actualizar el factura, contacte con el soporte';
			require_once '../../Vistas/mensaje-vista.php';
		}
		echo"<script>alert('".$mensaje."');  </script>";
		require_once '../../Controladores/Autolavado/consultar.php';
	  }
    } 
     
    if (isset($_POST["Eliminar"])) 
	{    
    	if (isset($_POST["id"])) 
    	{
			require_once '../../Modelos/factura.php';
			$objfactura = new factura();
			$objfactura->setid($_POST['id']);
			$r1=$objfactura->consultar();
			$mensaje = '';
			if ($r1['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
				if (count($r1)<2) {  //contamos la cantidad de elemento en el arreglo
				$mensaje="El factura no Existe en la base de Datos";
				}
				else{ //sino hay mas de 1 registro
					$error = $objfactura->eliminar();
				if ($error['estatus']==false) { ////verificamos si se ejecuto correctamente el metodo del modelo
					$mensaje = 'factura Eliminado';
				} else {//si hay un error al registrar
					$mensaje = 'Error al Eliminar el factura, contacte con el soporte';
				}
				}
			}	else{//si hay un error al consultar
				$mensaje = 'Error al Eliminar el factura, contacte con el soporte';
				require_once '../../Vistas/mensaje-vista.php';
				}
			echo"<script>alert('".$mensaje."');  </script>";
			require_once '../../Controladores/Autolavado/consultar.php';
		}
	}
	if (isset($_POST["Cargar_Datos"])) 
	{ if (isset($_POST["id"])) {
		require_once '../../Modelos/factura.php';
		$objfactura = new factura();
		$objfactura->setid($_POST['id']);
		$r2=$objfactura->consultar();
		$mensaje = '';
		if ($r2['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
			require_once '../../Vistas/Autolavado/actualizar.php';
		}else{//si hay un error al consultar
			$mensaje = 'Error al consultar el factura, contacte con el soporte';
			require_once '../../Vistas/mensaje-vista.php';
		}
	} }
}
 ?>



