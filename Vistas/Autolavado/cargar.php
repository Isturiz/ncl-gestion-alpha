<!doctype html>
<html lang="en">
<head>
 <meta charset="utf-8">
  <title>Gestión de Autolavado</title>
  <?php require_once('../../Vistas/Agregados/head.php'); ?>
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
      <main role="main" class="col-md-10 ml-sm-auto col-lg-10">
        <div class="pt-3 pb-2 mb-3 border-bottom" style="text-align:center;">
          <h1 class="h2">Gestión de Autolavado</h1>
        </div> 
        <div class="justify-content-between align-items-center">
          <div class="btn-group">
            <a class="btn btn-c" href="registrar.php">Facturar Autolavado</a>
          </div> 
        </div>
        <br/>
        <div class="table-responsive">
           <?php
           if (isset($r1)) {
             if (!empty($r1)) {
              $impr = ' <table class="table table-striped table-sm" style="text-align:center;" border=1>
                <thead>
                <tr style="-webkit-text-stroke-width: medium;">
                <td>Fecha</td>
                <td>Nro de Factura</td>
                <td>Cliente</td>
                <td>Automóvil</td>
                <td>Monto total</td>
                <td>Opción</td>
                </tr>
                </thead>
                <tbody>';
              foreach ($r1 as $valor) {
              if (isset($valor["fecha"])) {
                $n_fecha = date("d/m/Y", strtotime($valor['fecha']));
                $impr .= '<tr>';
                $impr .= '<td>'.$n_fecha.'</td>';
                $impr .= '<td>000-'.$valor['id'].'</td>';
                $impr .= '<td>'.$valor['nombre'].'</td>';
                $impr .= '<td>'.$valor['placa'].'</td>';
                $impr .= '<td>'.$valor['total'].'</td>';

                $impr .= '
                <td style="display: flex; border-style: none;  justify-content: center;">
                    <div class="d-flex justify-content-between align-items-center">
                      <a class="btn btn-c" href="../../Controladores/Autolavado/generar_factura.php?id='.$valor["id"].'""><i class="fa fa-print"></i></a>
                    </div>

                </td>';
                $impr .= '</tr>';
              }
            }
            $impr .= '</tbody>';
            $impr .= '</table>';
            printf($impr);
            }
          }
          ?>
        </div>
        <hr>
        </main>
    </div>
  </div>
</div>
<script src="../../Recursos/js/validacion.js" type="text/javascript"></script>
<script src="../../Recursos/js/jquery.3.3.1.js" type="text/javascript"></script>
<script src="../../Recursos/js/bootstrap.js" type="text/javascript"></script>
</body>
</html>
