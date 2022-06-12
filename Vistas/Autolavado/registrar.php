<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Registrar Autolavado</title>
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
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 pb-5">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Registro de Nuevo Autolavado</h1>
          </div>
          <main role="main">
            <div class="container">
              <form action="../../Controladores/Autolavado/autolavado.php" id="invoice-form" method="post"> 
<div class="load-animate animated fadeInUp">
<input id="currency" type="hidden" value="$">
<div class="row">
<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
    <div class="form-group">
        <input type="hidden" value="<?php echo $_SESSION['id']; ?>" class="form-control" name="userId" id="userId">
        <input data-loading-text="Guardando factura..." type="submit" name="Insertar" value="Guardar Factura" class="btn btn-success  btn-c invoice-save-btm">           
    </div>
    
</div>
</div>
<br>
<div class="form-row">
  <div class="col-md-3 mb-2">
    <label>Fecha</label>
    <input type="date" class="form-control"  name="fecha" id="fecha" value="<?php echo date("Y-m-d"); ?>" placeholder="Fecha" required>
  </div>
  <div class="col-md-5 mb-2">
    <label for="message-text">Cliente:</label>
    <select class="form-control" name="cliente" id="cliente">
       <option>--Seleccione--</option>
            <?php 
            foreach ($r1 as $resul) {
              if (isset($resul["nombre"])) {
                $o='<option value="'.$resul['id'].'" >('.$resul['cedula'].') '.$resul['nombre'].' '.$resul['apellido'].'</option>'; 
                print_r($o);
                }
              } ?> 
    </select>
  </div>
  <div class="col-md-4 mb-2">
    <label for="">Automóvil</label>
    <div class="form-group">
      <div class="input-group" id="">
          <input type="text" id="auto" name="auto" class="form-control" placeholder="Buscar" disabled="true"> 
          <input type="hidden" id="id_auto" name="id_auto" class="form-control"> 
          <span><button type="button" onclick="select_cliente();" class="btn btn-c" data-toggle="modal" data-target="#SeleccionClientes"><i class="fa fa-search"></i></button></span>
       </div>
  </div> 
  </div>
</div>
<hr>
<div class="row">
<h5>Servicios Registrados</h5>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <table class="table table-bordered table-hover"> 
        <tr>
            <th width="15%">Servicio. No</th>
            <th width="38%">Nombre del Servicio</th>               
            <th width="15%">Precio $</th>
        </tr>             
        <?php 
            foreach ($r3 as $valor) {
              if (isset($valor["nombre"])) {
                $impr = '<tr>';
                $impr .= '<th>'.$valor['id'].'</th>';
                $impr .= '<th>'.$valor['nombre'].'</th>';
                $impr .= '<th>'.$valor['costo'].'</th>';
                $impr .= '</tr>';
                printf($impr);
              }
            }
         ?>          
    </table>
</div>
</div>

<div class="row">
<h5>Servicios a facturar</h5>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <table class="table table-bordered table-hover" id="invoiceItem"> 
        <tr>
            <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
            <th width="15%">Servicio. No</th>
            <th width="38%">Nombre del Servicio</th>               
            <th width="15%">Precio</th>
        </tr>             
        <tr>
            <td><input class="itemRow" type="checkbox"></td>
            <td><input type="text" name="id_servicio[]" id="id_servicio_1" class="form-control" autocomplete="off"></td>
            <td><input type="text" name="nombre[]" id="nombre_1" class="form-control" autocomplete="off"></td>
            <td><input type="number" name="total[]" id="total_1" class="form-control total" autocomplete="off"></td>
        </tr>           
    </table>
</div>
</div>

<div class="row"> 
<div class="">
    <button class="btn btn-o delete" id="removeRows" type="button">- Borrar</button>
    <button class="btn btn-c" id="addRows" type="button">+ Agregar Más</button>
</div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
    <span class="form-inline">
        <div class="form-group">
            <label>Subtotal: &nbsp;</label>
            <div class="input-group">
                <input type="number" class="form-control" name="subTotal" id="subTotal">
            </div>
        </div>
    </span>
</div>
</div>
<div class="clearfix"></div>            
</div>
</form> 
            </div>
          </main>
        </main>
      </div>
    </div>
  </div>
<div class="modal fade" id="SeleccionClientes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Lista de Autos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
            <div class="col-md-12"> 
            <div  id="tablaClientes">
           
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
  <script src="../../Recursos/js/jquery.3.3.1.js" type="text/javascript"></script>
  <script src="../../Recursos/js/validacion.js" type="text/javascript"></script>
  <script src="../../Recursos/js/bootstrap.js" type="text/javascript"></script>
  <script src="../../Recursos/js/jquery.numeric.js" type="text/javascript"></script>
  <script src="../../Recursos/js/factura.js" type="text/javascript"></script>
</body>
</html>
