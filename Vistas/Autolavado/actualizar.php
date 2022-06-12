<!doctype html>
<html lang="en">
<head>
  <?php require_once('../../Vistas/Agregados/head.php'); ?>
  <link href="../../recursos/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../recursos/css/dashboard.css" rel="stylesheet">
  <link href="../../recursos/css/estilo.css" rel="stylesheet">
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
        <h1 class="h2">Actualizar Gasto</h1>
      </div>
      <main role="main">
        <div class="container">
          <div class="btn-group">
            <a  class="btn btn-sm btn-c" href="../../Controladores/Gasto/consultar-gasto-controlador.php">Volver</a>
          </div>
          <br/><br/>
          <?php
          if (isset($r1)) {
            if (!empty($r1)) {
              $impr = '';
              foreach ($r1 as $valor) {
                if (isset($valor['id'])) {
                  $impr = '
            <form action="../Gasto/actualizar-gasto-controlador.php" method="post">
            <div class="form-row">
              <input type="hidden" name="id" value="'.$valor['id'].'" />
              <div class="col-md-5 mb-5">
              <label for="validationTooltip01">Fecha:</label>
              <input type="date" class="form-control" id="validationTooltip01" name="fecha" value="'.$valor['fecha'].'" placeholder="Introduzca la fecha" required/>
              </div>
              <div class="col-md-5 mb-5">
              <label for="validationTooltip01">Nombre:</label>
              <select class="form-control" name="nombre" id="nombre">
                <option disabled="true">--Seleccione--</option>
                <option value="Marketing">Marketing</option>
                <option value="Transporte">Transporte</option>
                <option value="Materiales de Producción">Materiales de Producción</option>
              </select>
              </div>
              </div>
              <div class="form-row">
              <div class="col-md-8 mb-8">
              <label for="validationTooltip01">Descripción:</label>
              <textarea name="descripcion" class="form-control" id="validationTooltip01" placeholder="Introduzca la descripción" required>'.$valor['descripcion'].'</textarea>
              </div>
               <div class="col-md-2 mb-2">
              <label for="validationTooltip01">Monto:</label>
              <input type="text" name="monto" class="form-control" id="validationTooltip01" value="'.$valor['monto'].'" placeholder="Introduzca el monto" required/>
              </div>
              </div>
              <hr>
              <input class="btn btn-sm btn-c" type="submit" value="Actualizar" />
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
<script src="../../recursos/js/jquery-3.3.1.min.js" type="text/javascript"></script>
<script src="../../recursos/js/jquery.numeric.js" type="text/javascript"></script>
<script src="../../recursos/js/validacion.js" type="text/javascript"></script>
</body>
</html>
