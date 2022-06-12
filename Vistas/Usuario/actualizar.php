<!doctype html>
<html lang="en">
<head>
  <?php require_once('../../Vistas/Agregados/head.php'); ?>
  <link href="../../Recursos/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../Recursos/css/dashboard.css" rel="stylesheet">
  <link href="../../Recursos/css/estilo.css" rel="stylesheet">
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
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Actualizar Cliente</h1>
      </div>
      <main role="main">
        <div class="container">
          <div class="btn-group">
            <a  class="btn btn-sm btn-c" href="../../Controladores/Cliente/consultar.php">Volver</a>
          </div>
          <br/><br/>
          <?php
          if (isset($r2)) {
            if (!empty($r2)) {
              $impr = '';
              foreach ($r2 as $valor) {
                if (isset($valor['cedula'])) {
                  $impr = '
            <form action="../Cliente/cliente.php" method="post">
            <div class="form-row">
              <input type="hidden" name="cedula" value="'.$valor['cedula'].'" />
              <div class="col-md-6 mb-6">
                <label for="validationTooltip01">Nombre:</label>
                <input type="text" class="form-control" id="validationTooltip01" name="nombre" value="'.$valor['nombre'].'"/>
              </div>
              <div class="col-md-6 mb-6">
                <label for="validationTooltip01">Apellido:</label>
                <input type="text" class="form-control" id="validationTooltip01" name="apellido" value="'.$valor['apellido'].'"/>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-8 mt-4">
                <label>Dirección:</label>
                <textarea class="form-control" name="domicilio" >'.$valor['domicilio'].'</textarea>
              </div>
              <div class="col-md-4 mt-4">
                <label>Teléfono:</label>
                <input type="text" class="form-control" name="telefono" value="'.$valor['telefono'].'"/>
              </div>
            </div>
              <hr>
              <button class="btn btn-c" name="Actualizar" type="submit">Actualizar</button>
            </form>
          ';
                }
              }
              printf($impr);
            }
          }
          ?>
        </div>
      </main>
    </main>
  </div>
</div>
<script src="../../Recursos/js/jquery-3.3.1.min.js" type="text/javascript"></script>
<script src="../../Recursos/js/jquery.numeric.js" type="text/javascript"></script>
<script src="../../Recursos/js/validacion.js" type="text/javascript"></script>
</body>
</html>
