<?php
require('fpdf/fpdf.php');
include 'db.php';

// Crear el documento PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(190, 10, 'Informe de Ventas', 0, 1, 'C');
$pdf->Ln(10);

// Encabezados de la tabla
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Empresa', 1);
$pdf->Cell(30, 10, 'Factura', 1);
$pdf->Cell(40, 10, 'Fecha', 1);
$pdf->Cell(40, 10, 'Comprador', 1);
$pdf->Cell(30, 10, 'Total', 1);
$pdf->Ln();

// Obtener datos de la base de datos
$query = "SELECT empresas.nombre AS empresa, ventas.numero_factura, ventas.fecha_venta, ventas.comprador, ventas.valor_total 
          FROM ventas 
          JOIN empresas ON ventas.empresa_id = empresas.id";
$result = mysqli_query($conn, $query);

$pdf->SetFont('Arial', '', 12);
while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(40, 10, $row['empresa'], 1);
    $pdf->Cell(30, 10, $row['numero_factura'], 1);
    $pdf->Cell(40, 10, $row['fecha_venta'], 1);
    $pdf->Cell(40, 10, $row['comprador'], 1);
    $pdf->Cell(30, 10, $row['valor_total'], 1);
    $pdf->Ln();
}

// Salida del PDF
$pdf->Output('D', 'Informe_Ventas.pdf'); // 'D' para descargar
?>