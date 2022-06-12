 <?php
		require_once '../../Modelos/marca.php';
		$objmarca= new marca();
		$r1=$objmarca->consultarnombremarca();
		$mensaje = '';
		if ($r1['estatus'])
		 { //verificamos si se ejecuto correctamente el metodo del modelo
			require_once '../../Vistas/Marca/cargar.php';

		}else{
		print_r($r1);//si hay un error al consultar
			$mensaje = 'Error al consultar el Gasto, contacte con el soporte';
			require_once '../Vistas/mensaje-vista.php';
		}
?>