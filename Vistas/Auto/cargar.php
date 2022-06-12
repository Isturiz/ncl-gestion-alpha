<!doctype html>
<html lang="en">
<head>
 <meta charset="utf-8">
  <title>Gestión de Autos</title>
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
          <h1 class="h2">Gestión de Autos</h1>
        </div> 
        <div class="justify-content-between align-items-center">
          <div class="btn-group">
            <button type="button" class="btn btn-c" data-toggle="modal" data-target="#exampleModal">Nuevo</button>
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
                <td>Placa</td>
                <td>Marca</td>
                <td>Modelo</td>
                <td>Cliente</td>
                <td>Status</td>
                <td>Opción</td>
                </tr>
                </thead>
                <tbody>';
            foreach ($r1 as $valor) {
              if (isset($valor["placa"])) {
                $estatus="Desactivo";
                if ($valor['status']) {
                  $estatus="Activo";
                }
                $impr .= '<tr>';
                $impr .= '<td>'.$valor['placa'].'</td>';
                $impr .= '<td>'.$valor['marca'].'</td>';
                $impr .= '<td>'.$valor['modelo'].'</td>';
                $impr .= '<td>'.$valor['nombre'].' '.$valor['apellido'].'</td>';
                $impr .= '<td>'.$estatus.'</td>';

                $impr .= '
                <td style="display: flex; border-style: none;  justify-content: center;">
                  <form action="../Auto/auto.php" method="POST">
                    <div class="d-flex justify-content-between align-items-center">
                      <input type="hidden" name="id" value="'.$valor['id'].'" />
                      <button class="btn btn-c" name="Cargar_Datos" type="submit"><i class="fa fa-edit"></i></button>
                    </div>
                  </form>
                  <form onsubmit="return ConfirmarEliminar();" action="../Auto/auto.php" method="POST">
                    <div class="d-flex justify-content-between align-items-center">
                      <input type="hidden" name="id" value="'.$valor['id'].'" />
                      <button class="btn btn-o" name="Eliminar" type="submit"><i class="fa fa-trash"></i></button>
                    </div>
                  </form>

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
<!--Inicio del Modal Registrar auto --> 
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nueva auto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form class="needs-validation" action="../../Controladores/Auto/auto.php" method="post">
          <div class="form-group row">
            <div class="col-md-6">
              <label for="recipient-name" class="col-form-label">Placa:</label>
              <input type="text" class="form-control" name="placa" id="placa" placeholder="Identifique la placa" required>
            </div>
            <div class="col-md-6">
              <label for="message-text" class="col-form-label">Marca:</label>
              <select class="form-control" name="marcas" id="marcas">
                 <option>--Seleccione--</option>
                      <?php 
                      foreach ($r2 as $resul) {
                        if (isset($resul["nombre"])) {
                          $o='<option value="'.$resul['id'].'" >'.$resul['nombre'].'</option>'; 
                          print_r($o);
                          }
                        } ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-6">
              <label for="message-text" class="col-form-label">Modelo:</label>
              <div class="form-group">
                  <div class="input-group" id="">
                      <input type="text" id="modelo" name="modelo" class="form-control" placeholder="Buscar" disabled="true"> 
                      <input type="text" id="id_mode" name="id_mode" class="form-control"> 
                      <span><button type="button" onclick="select_marca();" class="btn btn-c" data-toggle="modal" data-target="#SeleccionModelos"><i class="fa fa-search"></i></button></span>
                   </div>
              </div> 
            </div>
            <div class="col-md-6">
              <label for="message-text" class="col-form-label">Cliente:</label>
              <select class="form-control" name="id_cliente" id="id_cliente">
                 <option>--Seleccione--</option>
                      <?php 
                      foreach ($r3 as $resul) {
                        if (isset($resul["nombre"])) {
                          $o='<option value="'.$resul['id'].'" >'.$resul['nombre'].'</option>'; 
                          print_r($o);
                          }
                        } ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-6">
              <label for="message-text" class="col-form-label">Status:</label>
              <select name="status" id="status" class="form-control" >
                <option value="1">Activo</option>
                <option value="0">Desactivo</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
           <input class="btn btn-sm btn-c" type="submit" name="Insertar" value="Registrar Auto"/>
           <input class="btn btn-sm btn-o" type="reset" value="Limpiar Campos"/>
          </div> 
        </form>
      </div>
    </div>
  </div>
</div>
<!--Fin del Modal Registrar auto --> 
<div class="modal fade" id="SeleccionModelos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Lista de Modelos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
            <div class="col-md-12"> 
            <div  id="tablaModelos">
           
            </div>
            </div>
          </div>
          <div class="modal-footer">
          <button class="btn btn-sm btn-o">Registrar nuevo cliente</button>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="../../Recursos/js/validacion.js" type="text/javascript"></script>
<script src="../../Recursos/js/jquery.3.3.1.js" type="text/javascript"></script>
<script src="../../Recursos/js/bootstrap.js" type="text/javascript"></script>
</body>
</html>
