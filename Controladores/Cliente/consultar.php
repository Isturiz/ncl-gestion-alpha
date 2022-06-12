 <?php
		require_once '../../Modelos/cliente.php';
		$objcliente= new cliente();
		$r1=$objcliente->consultarNombrecliente();
		$mensaje = '';
		if ($r1['estatus'])
		 { //verificamos si se ejecuto correctamente el metodo del modelo
			require_once '../../Vistas/Cliente/cargar.php';

		}else{
		print_r($r1);//si hay un error al consultar
			$mensaje = 'Error al consultar el Gasto, contacte con el soporte';
			require_once '../Vistas/mensaje-vista.php';
		}
?>