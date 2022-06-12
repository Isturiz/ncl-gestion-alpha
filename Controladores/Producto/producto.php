<?php
if (!empty($_POST))
{
	if(isset($_POST['Insertar']))
	{
		require_once '../../Modelos/producto.php';
		$Objproducto = new producto(); //definimos la instancia	
		$Objproducto->setNombre($_POST["nombre"]); 
		$Objproducto->setid_medida($_POST["medida"]); 
		$Objproducto->setprecio($_POST["precio"]); 
		$Objproducto->setexistencia($_POST["existencia"]); 
		$Objproducto->setstatus($_POST["status"]); 

		$sql = $Objproducto->registrar();
		if ($sql['estatus']==false) { ////verificamos si se ejecuto correctamente el metodo del producto
			$mensaje = 'Registro Exitoso';
		} else {//si hay un error al registrar
			$mensaje = 'Error al registrar el producto, contacte con el soporte';
		}
		echo"<script>alert('".$mensaje."');  </script>";
		require_once '../../Controladores/Producto/consultar.php';
	}
   if (isset($_POST["Actualizar"])) 
	{
	 if (isset($_POST["id"])) 
	 { 
		require_once '../../Modelos/producto.php';
		$objproducto = new producto();
		$objproducto->setid($_POST['id']);
		$objproducto->setNombre($_POST['nombre']);
		$objproducto->setprecio($_POST['precio']);
		$objproducto->setstatus($_POST['status']);
		$r2=$objproducto->consultar();
		$mensaje = '';
		if ($r2['estatus']) { //verificamos si se ejecuto correctamente el metodo del producto
			if (count($r2)<1) {  //contamos la cantidad de elemento en el arreglo
				$mensaje="El producto no Existe en la base de Datos";
			 }
			else{ //sino hay mas de 1 registro
				$error = $objproducto->actualizar();
				if ($error['estatus']==false) { ////verificamos si se ejecuto correctamente el metodo del producto
					$mensaje = 'Actualización Exitosa';
				} else {//si hay un error al registrar
					$mensaje = 'Error al actualizar el producto, contacte con el soporte';
				}
			}
		}else{//si hay un error al consultar
			$mensaje = 'Error al actualizar el producto, contacte con el soporte';
			require_once '../../Vistas/mensaje-vista.php';
		}
		echo"<script>alert('".$mensaje."');  </script>";
		require_once '../../Controladores/Producto/consultar.php';
	  }
    } 
     if (isset($_POST["Inventario"])) 
	{
	 if (isset($_POST["id"])) 
	 { 
		require_once '../../Modelos/producto.php';
		$objproducto = new producto();
		require_once '../../Modelos/entrada_producto.php';
		$objentrada_producto = new entrada_producto();
		$objproducto->setid($_POST['id']);
		$fecha=date("Y-m-d");
		$objentrada_producto->setfecha($fecha);
		$objentrada_producto->setcantidad($_POST['cantidad']);
		$objentrada_producto->setid_producto($_POST['id']);

		$r2=$objproducto->consultar();
		$mensaje = '';
		if ($r2['estatus']) { //verificamos si se ejecuto correctamente el metodo del producto
			if (count($r2)<1) {  //contamos la cantidad de elemento en el arreglo
				$mensaje="El producto no Existe en la base de Datos";
			 }
			else{ //sino hay mas de 1 registro
				$error = $objentrada_producto->registrar();
				if ($error['estatus']==false) { ////verificamos si se ejecuto correctamente el metodo del producto
					$inventario= $_POST['cant_antes']+$_POST['cantidad'];
					$objproducto->setexistencia($inventario);
					$objproducto->inventario();
					$mensaje = 'Inventario actualizado';
				} else {//si hay un error al registrar
					$mensaje = 'Error al actualizar el producto, contacte con el soporte';
				}
			}
		}else{//si hay un error al consultar
			$mensaje = 'Error al actualizar el producto, contacte con el soporte';
			require_once '../../Vistas/mensaje-vista.php';
		}
		echo"<script>alert('".$mensaje."');  </script>";
		require_once '../../Controladores/Producto/consultar.php';
	  }
    } 
     
    if (isset($_POST["Eliminar"])) 
	{    
    	if (isset($_POST["id"])) 
    	{
			require_once '../../Modelos/producto.php';
			$objproducto = new producto();
			$objproducto->setid($_POST['id']);
			$r1=$objproducto->consultar();
			$mensaje = '';
			if ($r1['estatus']) { //verificamos si se ejecuto correctamente el metodo del producto
				if (count($r1)<2) {  //contamos la cantidad de elemento en el arreglo
				$mensaje="El producto no Existe en la base de Datos";
				}
				else{ //sino hay mas de 1 registro
					$error = $objproducto->eliminar();
				if ($error['estatus']==false) { ////verificamos si se ejecuto correctamente el metodo del producto
					$mensaje = 'producto Eliminado';
				} else {//si hay un error al registrar
					$mensaje = 'Error al Eliminar el producto, contacte con el soporte';
				}
				}
			}	else{//si hay un error al consultar
				$mensaje = 'Error al Eliminar el producto, contacte con el soporte';
				require_once '../../Vistas/mensaje-vista.php';
				}
			echo"<script>alert('".$mensaje."');  </script>";
			require_once '../../Controladores/Producto/consultar.php';
		}
	}
	if (isset($_POST["Cargar_Datos"])) 
	{ if (isset($_POST["id"])) {
		require_once '../../Modelos/producto.php';
		$objproducto = new producto();
		$objproducto->setid($_POST['id']);
		$r2=$objproducto->consultar();
		$mensaje = '';
		if ($r2['estatus']) { //verificamos si se ejecuto correctamente el metodo del producto
			require_once '../../Vistas/producto/actualizar.php';
		}else{//si hay un error al consultar
			$mensaje = 'Error al consultar el producto, contacte con el soporte';
			require_once '../../Vistas/mensaje-vista.php';
		}
	} }
	if (isset($_POST["Cargar_Datos_Inventario"])) 
	{ if (isset($_POST["id"])) {
		require_once '../../Modelos/producto.php';
		$objproducto = new producto();
		$objproducto->setid($_POST['id']);
		$r2=$objproducto->consultar();
		$mensaje = '';
		if ($r2['estatus']) { //verificamos si se ejecuto correctamente el metodo del producto
			require_once '../../Vistas/Producto/inventario.php';
		}else{//si hay un error al consultar
			$mensaje = 'Error al consultar el producto, contacte con el soporte';
			require_once '../../Vistas/mensaje-vista.php';
		}
	} }
}
 ?>



