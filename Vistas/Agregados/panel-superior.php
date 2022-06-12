<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
	<h5 class="col-sm-3 col-md-2 mr-0" style="color: white;">
	<?php
	 session_start();
	 echo "Usuario: ".$_SESSION['nombre']; ?>
	</h5>
	<ul class="navbar-nav px-3">
	  <li class="nav-item text-nowrap">
	    <a
				class="nav-link" 
				style="color:white !important;" 
				href="../../Controladores/Sistema/salir.php">
				Salir
			</a>
	  </li> 
	</ul>
</nav>