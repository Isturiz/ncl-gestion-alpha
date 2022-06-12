 <?php
		require_once '../../Modelos/cliente.php';
		require_once '../../Modelos/servicio.php';
		$objcliente= new cliente();
		$objservicio= new servicio();
		$r1=$objcliente->consultarNombrecliente();
		$r3=$objservicio->serviciosActivos();
		$mensaje = '';
		if ($r1['estatus'])
		 { //verificamos si se ejecuto correctamente el metodo del modelo
			require_once '../../Vistas/Autolavado/registrar.php';

		}else{
		print_r($r1);//si hay un error al consultar
			$mensaje = 'Error al consultar el Gasto, contacte con el soporte';
			require_once '../Vistas/mensaje-vista.php';
		}
?>