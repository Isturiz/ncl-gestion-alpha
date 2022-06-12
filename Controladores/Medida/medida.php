<?php
if (!empty($_POST))
{
	if(isset($_POST['Insertar']))
	{
		require_once '../../Modelos/medida.php';
		$medida = new medida(); //definimos la instancia	
		$medida->setmedida($_POST["medida"]);
		$medida->setnombre($_POST["nombre"]); 
		$sql = $medida->registrar();
		if ($sql['estatus']==false) { ////verificamos si se ejecuto correctamente el metodo del modelo
			$mensaje = 'Registro Exitoso';
		} else {//si hay un error al registrar
			$mensaje = 'Error al registrar La medida, contacte con el soporte';
		}
		echo"<script>alert('".$mensaje."');  </script>";
		require_once '../../Controladores/Medida/consultar.php';
	}
    if (isset($_POST["Actualizar"])) 
	{
	 if (isset($_POST["id"])) 
	 {
		require_once '../../Modelos/medida.php';
		$objmedida = new medida();
		$objmedida->setid($_POST["id"]);
		$objmedida->setmedida($_POST["medida"]);
		$objmedida->setnombre($_POST["nombre"]); 
		$r2=$objmedida->consultar();
		$mensaje = '';
		if ($r2['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
			if (count($r2)<1) {  //contamos la cantidad de elemento en el arreglo
				$mensaje="La medida no Existe en la base de Datos";
			 }
			else{ //sino hay mas de 1 registro
				$error = $objmedida->actualizar();
				if ($error['estatus']==false) { ////verificamos si se ejecuto correctamente el metodo del modelo
					$mensaje = 'Actualización Exitosa';
				} else {//si hay un error al registrar
					$mensaje = 'Error al actualizar La medida, contacte con el soporte';
				}
			}
		}else{//si hay un error al consultar
			$mensaje = 'Error al actualizar La medida, contacte con el soporte';
			require_once '../../Vistas/mensaje-vista.php';
		}
		echo"<script>alert('".$mensaje."');  </script>";
		require_once '../../Controladores/Medida/consultar.php';
	  }
    } 
     
    if (isset($_POST["Eliminar"])) 
	{    
    	if (isset($_POST["id"])) 
    	{
			require_once '../../Modelos/medida.php';
			$objmedida = new medida();
			$objmedida->setid($_POST['id']);
			$r1=$objmedida->consultar();
			$mensaje = '';
			if ($r1['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
				if (count($r1)<2) {  //contamos la cantidad de elemento en el arreglo
				$mensaje="La medida no Existe en la base de Datos";
				}
				else{ //sino hay mas de 1 registro
					$error = $objmedida->eliminar();
				if ($error['estatus']==false) { ////verificamos si se ejecuto correctamente el metodo del modelo
					$mensaje = 'medida Eliminado';
				} else {//si hay un error al registrar
					$mensaje = 'Error al Eliminar La medida, contacte con el soporte';
				}
				}
			}	else{//si hay un error al consultar
				$mensaje = 'Error al Eliminar La medida, contacte con el soporte';
				require_once '../../Vistas/mensaje-vista.php';
				}
			echo"<script>alert('".$mensaje."');  </script>";
			require_once '../../Controladores/Medida/consultar.php';
		}
	}
	if (isset($_POST["Cargar_Datos"])) 
	{ if (isset($_POST["id"])) {
		require_once '../../Modelos/medida.php';
		$objmedida = new medida();
		$objmedida->setid($_POST['id']);
		$r2=$objmedida->consultar();
		$mensaje = '';
		if ($r2['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
			require_once '../../Vistas/Medida/actualizar.php';
		}else{//si hay un error al consultar
			$mensaje = 'Error al consultar La medida, contacte con el soporte';
			require_once '../../Vistas/mensaje-vista.php';
		}
	} }
}
 ?>



