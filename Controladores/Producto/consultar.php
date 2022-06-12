 <?php
		require_once '../../Modelos/producto.php';
		require_once '../../Modelos/medida.php';
		$objproducto= new producto();
		$objmedida = new medida();
		$r1=$objproducto->consultarNombreproducto();
		$r0=$objmedida->consultarNombremedida();
		$mensaje = '';
		if ($r1['estatus'])
		 { //verificamos si se ejecuto correctamente el metodo del producto  
			require_once '../../Vistas/Producto/cargar.php';

		}else{
		print_r($r1);//si hay un error al consultar
			$mensaje = 'Error al consultar el producto, contacte con el soporte';
			require_once '../Vistas/mensaje-vista.php';
		}
?>