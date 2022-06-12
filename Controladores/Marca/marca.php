<?php
if (!empty($_POST))
{
	if(isset($_POST['Insertar']))
	{
		require_once '../../Modelos/marca.php';
		$marca = new marca(); //definimos la instancia	
		$marca->setNombre($_POST["nombre"]); 
		$sql = $marca->registrar();
		if ($sql['estatus']==false) { ////verificamos si se ejecuto correctamente el metodo del modelo
			$mensaje = 'Registro Exitoso';
		} else {//si hay un error al registrar
			$mensaje = 'Error al registrar La marca, contacte con el soporte';
		}
		echo"<script>alert('".$mensaje."');  </script>";
		require_once '../../Controladores/Marca/consultar.php';
	}
   if (isset($_POST["Actualizar"])) 
	{
	 if (isset($_POST["id"])) 
	 { 
		require_once '../../Modelos/marca.php';
		$objmarca = new marca();
		$objmarca->setid($_POST['id']);
		$objmarca->setNombre($_POST['nombre']);
		$r2=$objmarca->consultar();
		$mensaje = '';
		if ($r2['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
			if (count($r2)<1) {  //contamos la cantidad de elemento en el arreglo
				$mensaje="El cliente no Existe en la base de Datos";
			 }
			else{ //sino hay mas de 1 registro
				$error = $objmarca->actualizar();
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
		require_once '../../Controladores/Marca/consultar.php';
	  }
    } 
     
    if (isset($_POST["Eliminar"])) 
	{    
    	if (isset($_POST["id"])) 
    	{
			require_once '../../Modelos/marca.php';
			$objmarca = new marca();
			$objmarca->setid($_POST['id']);
			$r1=$objmarca->consultar();
			$mensaje = '';
			if ($r1['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
				if (count($r1)<2) {  //contamos la cantidad de elemento en el arreglo
				$mensaje="La marca no Existe en la base de Datos";
				}
				else{ //sino hay mas de 1 registro
					$error = $objmarca->eliminar();
				if ($error['estatus']==false) { ////verificamos si se ejecuto correctamente el metodo del modelo
					$mensaje = 'marca Eliminado';
				} else {//si hay un error al registrar
					$mensaje = 'Error al Eliminar La marca, contacte con el soporte';
				}
				}
			}	else{//si hay un error al consultar
				$mensaje = 'Error al Eliminar La marca, contacte con el soporte';
				require_once '../../Vistas/mensaje-vista.php';
				}
			echo"<script>alert('".$mensaje."');  </script>";
			require_once '../../Controladores/Marca/consultar.php';
		}
	}
	if (isset($_POST["Cargar_Datos"])) 
	{ if (isset($_POST["id"])) {
		require_once '../../Modelos/marca.php';
		$objmarca = new marca();
		$objmarca->setid($_POST['id']);
		$r2=$objmarca->consultar();
		$mensaje = '';
		if ($r2['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
			require_once '../../Vistas/Marca/actualizar.php';
		}else{//si hay un error al consultar
			$mensaje = 'Error al consultar La marca, contacte con el soporte';
			require_once '../../Vistas/mensaje-vista.php';
		}
	} }
}
 ?>



