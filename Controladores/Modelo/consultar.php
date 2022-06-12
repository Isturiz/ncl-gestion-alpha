 <?php
		require_once '../../Modelos/modelo.php';
		require_once '../../Modelos/marca.php';
		$objmodelo= new modelo();
		$objmarca = new marca();
		$r1=$objmodelo->consultarNombremodelo();
		$r0=$objmarca->consultarNombremarca();
		$mensaje = '';
		if ($r1['estatus'])
		 { //verificamos si se ejecuto correctamente el metodo del modelo
			require_once '../../Vistas/Modelo/cargar.php';

		}else{
		print_r($r1);//si hay un error al consultar
			$mensaje = 'Error al consultar el modelo, contacte con el soporte';
			require_once '../Vistas/mensaje-vista.php';
		}
?>