<!doctype html>
<html lang="en">
<head>
 <meta charset="utf-8">
  <title>Gestión de Productos</title>
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
          <h1 class="h2">Gestión de Inventario</h1>
        </div> 
        <div class="justify-content-between align-items-center">
          <div class="btn-group">
            <button type="button" class="btn btn-c" data-toggle="modal" data-target="#exampleModal">Nuevo Producto</button>
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
                <td>Producto</td>
                <td>Medida</td>
                <td>Precio</td>
                <td>Existencia</td>
                <td>Estado</td>
                <td>Opción</td>
                </tr>
                </thead>
                <tbody>';
            foreach ($r1 as $valor) {

              if (isset($valor["nombre"])) {
                $estatus="Desactivo";
                if ($valor['status']) {
                  $estatus="Activo";
                }
                $impr .= '<tr>';
                $impr .= '<td>'.$valor['nombre'].'</td>';
                $impr .= '<td>'.$valor['medida'].'  '.$valor['abrev'].'</td>';
                $impr .= '<td>'.$valor['precio'].'</td>';
                $impr .= '<td>'.$valor['existencia'].'</td>';
                $impr .= '<td>'.$estatus.'</td>';
                $impr .= '
                <td style="display: flex; border-style: none;  justify-content: center;">
                  <form action="../Producto/producto.php" method="POST">
                    <div class="d-flex justify-content-between align-items-center">
                      <input type="hidden" name="id" value="'.$valor['id'].'" />
                      <button class="btn btn-c" name="Cargar_Datos" type="submit"><i class="fa fa-edit"></i></button>
                    </div>
                  </form>
                  <form onsubmit="return ConfirmarEliminar();" action="../Producto/producto.php" method="POST">
                    <div class="d-flex justify-content-between align-items-center">
                      <input type="hidden" name="id" value="'.$valor['id'].'" />
                      <button class="btn btn-o" name="Eliminar" type="submit"><i class="fa fa-trash"></i></button>
                    </div>
                  </form>
                  <form action="../Producto/producto.php" method="POST">
                    <div class="d-flex justify-content-between align-items-center">
                      <input type="hidden" name="id" value="'.$valor['id'].'" />
                      <button class="btn btn-c" name="Cargar_Datos_Inventario" type="submit">+</button>
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
<!--Inicio del Modal Registrar Producto --> 
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="needs-validation" action="../../Controladores/Producto/producto.php" method="post">
          <div class="form-group row">
            <div class="col-md-6">
              <label for="recipient-name" class="col-form-label">Nombre:</label>
              <input type="text" class="form-control" name="nombre" placeholder="Indique nombre del producto" required>
            </div>
            <div class="col-md-6">
               <label for="message-text" class="col-form-label">Medida del producto:</label>
               <select class="form-control" name="medida" id="medida" >
                <option value="0" selected="true">--Seleccione--</option>
                <?php 
                foreach ($r0 as $medida) {
                  if (isset($medida["nombre"])) {
                    $o='<option value="'.$medida['id'].'" >'.$medida['medida'].'  '.$medida['nombre'].'</option>'; 
                    print_r($o);
                    }
                  } ?>
               </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4">
               <label for="message-text" class="col-form-label">Precio:</label>
                <input type="number" step="0.01" class="form-control" name="precio" placeholder="" required>
            </div>
            <div class="col-md-4">
              <label for="message-text" class="col-form-label">Cantidad:</label>
              <input type="number" step="0.01" class="form-control" name="existencia" placeholder="" required>
            </div>
            <div class="col-md-4">
              <label for="message-text" class="col-form-label">Status:</label>
              <select name="status" class="form-control" >
                <option value="1">Activo</option>
                <option value="0">Desactivo</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <input class="btn btn-sm btn-c" name="Insertar" type="submit" value="Registrar Producto"/>
            <input class="btn btn-sm btn-o" type="reset" value="Limpiar Campos"/>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--Fin del Modal Registrar Producto --> 
<script src="../../Recursos/js/validacion.js" type="text/javascript"></script>
<script src="../../Recursos/js/jquery.3.3.1.js" type="text/javascript"></script>
<script src="../../Recursos/js/bootstrap.js" type="text/javascript"></script>
</body>
</html>
