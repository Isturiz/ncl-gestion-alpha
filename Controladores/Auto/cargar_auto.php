 <?php
 require_once '../../Modelos/auto.php';
    $objauto = new auto();
    $objauto->setid_cliente($_POST['ID_cliente']);
    $r2=$objauto->consultarautos();
?>
  <table class="table linea-striped table-sm" border="1">
  <thead> 
  <tr>
  <td>Placa</td>
  <td>Marca</td>
  <td>Modelo</td>
  <td>Seleccionar</td>
  </tr>
  </thead>
  <tbody>
  <?php
   if (!empty($r2))  {
    foreach ($r2 as $valor) {
      if (isset($valor["id"])){
   	$placa = $valor["placa"];
    $marca = $valor["marca"];
    $modelo = $valor["modelo"];
	 $id = $valor['id'];
	?>
   <tr>
	<td><?php echo $placa;?></td>
	<td><?php echo $marca;?></td>
  <td><?php echo $modelo;?></td>
	<td style="display: flex; border-style: none;">
    <div class="d-flex justify-content-between align-items-center">
        <button data-dismiss="modal" onclick="asignar_auto('<?=$placa;?>', <?=$id;?>);" class="btn btn-c" ><i class="fa fa-mouse-pointer"></i></button>
	</div>
    </td>
   </tr>
   <?php }}} ?>
  </tbody>
  </table>