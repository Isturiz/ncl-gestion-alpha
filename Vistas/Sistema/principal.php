<!doctype html>
<html>
<head>
 <meta charset="utf-8"> 
  <title>Gestión</title>
  <?php require_once('../../Vistas/Agregados/head.php'); ?> <!-- Modificar -->
</head>
<body>
<!-- Parte superior de la pagina --> 
<?php require_once('../../Vistas/Agregados/panel-superior.php'); ?>
<div class="container-fluid">
  <div class="row">
  <!-- Panel izquierdo del menu --> 
  <?php require_once('../../Vistas/Agregados/panel.php'); ?>
  <!-- FIN del Panel izquierdo del menu -->
  <!-- Parte central de la pagina --> 
    <div class="container">
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="pt-3 pb-2 mb-3 border-bottom" style="text-align:center;">
        <center><a  class="btn btn-sm btn-c" href="../../Controladores/Autolavado/registrar.php">Facturar autolavado</a></center>
         
        </div> 
        <div style="text-align: center;">
          <img  src="../../Recursos/img/logo.jpg" alt="Logo" class="img-fluid">
        </div>
      </main>
    </div>
  </div>
</div>
</body>
</html>
