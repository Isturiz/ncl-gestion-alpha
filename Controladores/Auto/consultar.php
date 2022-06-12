 <?php
		require_once '../../Modelos/auto.php';
		require_once '../../Modelos/marca.php';
		require_once '../../Modelos/cliente.php';
		$objauto= new auto();
		$objmarca= new marca();
		$objcliente= new cliente();
		$r1=$objauto->consultarplacaauto();
		$r2=$objmarca->consultarNombremarca();
		$r3=$objcliente->consultarNombrecliente();
		$mensaje = '';
		if ($r1['estatus'])
		 { //verificamos si se ejecuto correctamente el metodo del modelo
			require_once '../../Vistas/Auto/cargar.php';

		}else{
		print_r($r1);//si hay un error al consultar
			$mensaje = 'Error al consultar el Gasto, contacte con el soporte';
			require_once '../Vistas/mensaje-vista.php';
		}
?>