 <?php
 require_once '../../Modelos/modelo.php';
    $objmodelo = new modelo();
    $objmodelo->setid_marca($_POST['ID_marca']);
    $r1=$objmodelo->consultar_marca_modelo();
?>
  <table class="table linea-striped table-sm" border="1">
  <thead> 
  <tr>
  <td>Codigo</td>
  <td>Marca</td>
  <td>Seleccionar</td>
  </tr>
  </thead>
  <tbody>
  <?php
   if (!empty($r1))  {
    foreach ($r1 as $valor) {
      if (isset($valor["nombre"])){
   	$nombre = $valor["nombre"];
	 $id = $valor['id'];
	?>
   <tr>
	<td>000-<?php echo $id;?></td>
	<td><?php echo $nombre;?></td>
	<td style="display: flex; border-style: none;">
    <div class="d-flex justify-content-between align-items-center">
        <button data-dismiss="modal" onclick="asignar_modelo('<?=$nombre;?>', <?=$id;?>);" class="btn btn-c" ><i class="fa fa-mouse-pointer"></i></button>
	</div>
    </td>
   </tr>
   <?php }}} ?>
  </tbody>
  </table>