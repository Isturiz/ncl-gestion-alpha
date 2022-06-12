 <?php 
if (!empty($_POST))
{
	if (isset($_POST["nombre"])) 
	{
	    require_once '../../Modelos/usuario.php';
			
			$usuario= new usuario();
			$usuario->setnombre($_POST["nombre"]);
			$usuario->setClave($_POST["clave"]);
			$rsUsuario=$usuario->validar();
			if ($rsUsuario['total']>0) 
			{ 	
				session_start();
				$acceso=$usuario->consultarPornombre($_POST["nombre"]);
				$_SESSION['nombre'] = $acceso[0][1];
			    $_SESSION['id'] = $acceso[0][0];

			    /*if ($acceso[0][1]==3) {
					require_once '../../Vistas/sistema/principal.php';
			    }
			    else */
					//require_once '../../Vistas/Sistema/principal.php';
					header("Location: ../../Vistas/Sistema/principal.php ");
			}
			
			else
			{
				header("Location: ../../Vistas/Sistema/mensaje_error.php");
			}
 	}
}


 ?>