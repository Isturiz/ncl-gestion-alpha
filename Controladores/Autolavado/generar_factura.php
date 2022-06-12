<?php

require_once '../../Modelos/factura.php';
require_once '../../Modelos/factura_servicio.php';
$objfactura = new factura();
$objfactura_s = new factura_servicio();
$objfactura->setid($_GET['id']); 
$r1 = $objfactura->Existefactura();
$objfactura_s->setid_factura($_GET['id']); 
$r2 = $objfactura_s->ExisteServicio();
$mensaje = '';
if ($r1['estatus']) { //verificamos si se ejecuto correctamente el metodo del modelo
	require_once '../../Modelos/fpdf.php';
	$pdf = new FPDF('P', 'mm', 'A4');
	$pdf->SetMargins(10,10,10);
	$pdf->SetAutoPageBreak(true,25);
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	$pdf->Image('../../Recursos/img/logo.jpeg', 5, 5, 30 );
	$pdf->SetFont('Arial','B',15);
	$pdf->Cell(30);
	$pdf->Cell(120,10, 'FACTURA',0,0,'C');
	$pdf->Ln(10);
	$pdf->SetFont('Arial','',15);
	foreach ($r1 as $valor) {
		if (isset($valor["id"])) {
	$n_fecha = date("d/m/Y", strtotime($valor['fecha']));
	$pdf->Cell(100,10, 'Fecha  '.$n_fecha,0,0,'C');
	$pdf->Ln(10);
	$pdf->SetFont('Arial','',15);
	$pdf->Cell(100,10, 'Cliente  '.$valor['nombre'].' '.$valor['apellido'],0,0,'C');
	$pdf->Ln(24);
		}
	}
	$pdf->Cell(30,10, 'SERVICIOS',0,0,'C');
	$pdf->Ln(10);
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(40,6,'Nro. Servicio',1,0,'C',1);
	$pdf->Cell(100,6,'Servicio',1,0,'C',1);
	$pdf->Cell(40,6,'Precio',1,1,'C',1);
	$pdf->SetFont('Arial','',10);

	foreach ($r2 as $rp) {
		if (isset($rp["nombre"])) {
			//$pdf->Cell(20,6,$rp['id_factura'],1,0,'C');
			$pdf->Cell(40,6,($rp['servicio']),1,0,'C');
			$pdf->Cell(100,6,($rp['nombre']),1,0,'C');
			$pdf->Cell(40,6,($rp['precio']),1,1,'C');
		}
	}
	
	$pdf->Output(); //Salida al navegador
} else {//si hay un error al consultar
	$mensaje = 'Error al consultar el factura, contacte con el soporte';
	require_once '../Vistas/mensaje-vista.php';
}
