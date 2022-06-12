<?php
if (!empty($_POST))
{
	if(isset($_POST['Insertar']))
	{
		require_once '../../Modelos/auto.php';
		$Objauto = new auto(); //definimos la instancia
		$Objauto->setplaca($_POST['placa']); 
		$Objauto->setid_modelo($_POST['id_mode']); 
		$Objauto->setid_cliente($_POST['id_cliente']);
		$Objauto->setstatus($_POST['status']);
		$r1=$Objauto->Existeauto();
		$mensaje = ''; 
		if ($r1['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
			if (count($r1)>1) {  //contamos la cantidad de elemento en el arreglo
				$mensaje="El auto ya Existe en la base de Datos";
			}
			else{ //sino hay mas de 1 registro
				$error = $Objauto->registrar();
				if ($error['estatus']==false) { ////verificamos si se ejecuto correctamente el metodo del modelo
					$mensaje = 'Registro Exitoso';
				} else {//si hay un error al registrar
					$mensaje = 'Error al registrar el auto, contacte con el soporte';
				}
			}
		}
		echo"<script>alert('".$mensaje."');  </script>";
		require_once '../../Controladores/Auto/consultar.php';
	}
    
    if (isset($_POST["Actualizar"])) 
	{
	 if (isset($_POST["id"])) 
	 { 
		require_once '../../Modelos/auto.php';
		$objauto = new auto();
		$objauto->setplaca($_POST['placa']);
		$objauto->setid_modelo($_POST['id_modelo']); 
		$objauto->setid_cliente($_POST['id_cliente']);
		$objauto->setstatus($_POST['status']);
		$r2=$objauto->consultar();
		$mensaje = '';
		if ($r2['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
			if (count($r2)<1) {  //contamos la cantidad de elemento en el arreglo
				$mensaje="El auto no Existe en la base de Datos";
			 }
			else{ //sino hay mas de 1 registro
				$error = $objauto->actualizar();
				if ($error['estatus']==false) { ////verificamos si se ejecuto correctamente el metodo del modelo
					$mensaje = 'Actualización Exitosa';
				} else {//si hay un error al registrar
					$mensaje = 'Error al actualizar el auto, contacte con el soporte';
				}
			}
		}else{//si hay un error al consultar
			$mensaje = 'Error al actualizar el auto, contacte con el soporte';
			require_once '../../Vistas/mensaje-vista.php';
		}
		echo"<script>alert('".$mensaje."');  </script>";
		require_once '../../Controladores/Auto/consultar.php';
	  }
    } 
     
    if (isset($_POST["Eliminar"])) 
	{    
    	if (isset($_POST["id"])) 
    	{
			require_once '../../Modelos/auto.php';
			$objauto = new auto();
			$objauto->setid($_POST['id']);
			$r1=$objauto->consultar();
			$mensaje = '';
			if ($r1['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
				if (count($r1)<2) {  //contamos la cantidad de elemento en el arreglo
				$mensaje="El auto no Existe en la base de Datos";
				}
				else{ //sino hay mas de 1 registro
					$error = $objauto->eliminar();
				if ($error['estatus']==false) { ////verificamos si se ejecuto correctamente el metodo del modelo
					$mensaje = 'auto Eliminado';
				} else {//si hay un error al registrar
					$mensaje = 'Error al Eliminar el auto, contacte con el soporte';
				}
				}
			}	else{//si hay un error al consultar
				$mensaje = 'Error al Eliminar el auto, contacte con el soporte';
				require_once '../../Vistas/mensaje-vista.php';
				}
			echo"<script>alert('".$mensaje."');  </script>";
			require_once '../../Controladores/Auto/consultar.php';
		}
	}
	if (isset($_POST["Cargar_Datos"])) 
	{ if (isset($_POST["id"])) {
		require_once '../../Modelos/auto.php';
		$objauto = new auto();
		$objauto->setid($_POST['id']);
		$r2=$objauto->consultar();
		$mensaje = '';
		if ($r2['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
			require_once '../../Vistas/Auto/actualizar.php';
		}else{//si hay un error al consultar
			$mensaje = 'Error al consultar el auto, contacte con el soporte';
			require_once '../../Vistas/mensaje-vista.php';
		}
	} }
}
 ?>



