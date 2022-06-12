<?php
if (!empty($_POST))
{
	if(isset($_POST['Insertar']))
	{
		require_once '../../Modelos/usuario.php';
		$usuario = new usuario(); //definimos la instancia	
		$usuario->setNombre($_POST["nombre"]); 
		$usuario->setclave($_POST["clave"]); 
		$usuario->settipo($_POST["tipo"]);
		$r1=$usuario->Existeusuario();
		$mensaje = '';
		if ($r1['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
			if (count($r1)>1) {  //contamos la cantidad de elemento en el arreglo
				$mensaje="El usuario ya Existe en la base de Datos";
			}
			else{ //sino hay mas de 1 registro
				$error = $usuario->registrar();
				if ($error['estatus']==false) { ////verificamos si se ejecuto correctamente el metodo del modelo
					$mensaje = 'Registro Exitoso';
				} else {//si hay un error al registrar
					$mensaje = 'Error al registrar el usuario, contacte con el soporte';
				}
			}
		}
		echo"<script>alert('".$mensaje."');  </script>";
		require_once '../../Controladores/Usuario/consultar.php';
	}
    
    if (isset($_POST["Actualizar"])) 
	{
	 if (isset($_POST["id"])) 
	 { 
		require_once '../../Modelos/usuario.php';
		$objusuario = new usuario();
		$objusuario->setid($_POST['id']);
		$objusuario->setnombre($_POST['nombre']);
		$objusuario->setclave($_POST['clave']); 
		$objusuario->settipo($_POST['tipo']);
		$r2=$objusuario->consultar();
		$mensaje = '';
		if ($r2['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
			if (count($r2)<1) {  //contamos la cantidad de elemento en el arreglo
				$mensaje="El usuario no Existe en la base de Datos";
			 }
			else{ //sino hay mas de 1 registro
				$error = $objusuario->actualizar();
				if ($error['estatus']==false) { ////verificamos si se ejecuto correctamente el metodo del modelo
					$mensaje = 'Actualización Exitosa';
				} else {//si hay un error al registrar
					$mensaje = 'Error al actualizar el usuario, contacte con el soporte';
				}
			}
		}else{//si hay un error al consultar
			$mensaje = 'Error al actualizar el usuario, contacte con el soporte';
			require_once '../../Vistas/mensaje-vista.php';
		}
		echo"<script>alert('".$mensaje."');  </script>";
		require_once '../../Controladores/Usuario/consultar.php';
	  }
    } 
     
    if (isset($_POST["Eliminar"])) 
	{    
    	if (isset($_POST["id"])) 
    	{
			require_once '../../Modelos/usuario.php';
			$objusuario = new usuario();
			$objusuario->setid($_POST['id']);
			$r1=$objusuario->consultar();
			$mensaje = '';
			if ($r1['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
				if (count($r1)<2) {  //contamos la cantidad de elemento en el arreglo
				$mensaje="El usuario no Existe en la base de Datos";
				}
				else{ //sino hay mas de 1 registro
					$error = $objusuario->eliminar();
				if ($error['estatus']==false) { ////verificamos si se ejecuto correctamente el metodo del modelo
					$mensaje = 'usuario Eliminado';
				} else {//si hay un error al registrar
					$mensaje = 'Error al Eliminar el usuario, contacte con el soporte';
				}
				}
			}	else{//si hay un error al consultar
				$mensaje = 'Error al Eliminar el usuario, contacte con el soporte';
				require_once '../../Vistas/mensaje-vista.php';
				}
			echo"<script>alert('".$mensaje."');  </script>";
			require_once '../../Controladores/Usuario/consultar.php';
		}
	}
	if (isset($_POST["Cargar_Datos"])) 
	{ if (isset($_POST["id"])) {
		require_once '../../Modelos/usuario.php';
		$objusuario = new usuario();
		$objusuario->setid($_POST['id']);
		$r2=$objusuario->consultar();
		$mensaje = '';
		if ($r2['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
			require_once '../../Vistas/Usuario/actualizar.php';
		}else{//si hay un error al consultar
			$mensaje = 'Error al consultar el usuario, contacte con el soporte';
			require_once '../../Vistas/mensaje-vista.php';
		}
	} }
}
 ?>



