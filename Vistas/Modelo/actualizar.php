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
        <h1 class="h2">Actualizar Modelo</h1>
      </div>
      <main role="main">
        <div class="container">
          <div class="btn-group">
            <a  class="btn btn-sm btn-c" href="../../Controladores/Modelo/consultar.php">Volver</a>
          </div>
          <br/><br/>
          <?php
          if (isset($r2)) {
            if (!empty($r2)) {
              $impr = '';
              foreach ($r2 as $valor) {
                if (isset($valor['id'])) {
                  $impr = '
            <form action="../Modelo/modelo.php" method="post">
            <div class="form-row">
              <input type="hidden" name="id" value="'.$valor['id'].'" />
              <div class="col-md-12">
                <label for="message-text" class="col-form-label"> Nombre:</label>
                <input type="text" class="form-control" id="validationTooltip01" name="nombre" value="'.$valor['nombre'].'"/>
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
