<?php
include 'db.php';

$fecha_inicio = isset($_GET['fecha_inicio']) ? $_GET['fecha_inicio'] : ''; // Valor predeterminado
$fecha_fin = isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : '';

$query = "SELECT id_venta, empresas.nombre AS empresa, ventas.numero_factura, ventas.fecha_venta,productos.producto AS producto, ventas.comprador, ventas.valor_total 
          FROM ventas 
          JOIN empresas ON ventas.empresa_id = id_empresa
          JOIN productos ON ventas.producto_id = productos.id_producto";

if (!empty($fecha_inicio) && !empty($fecha_fin)) {
    $query .= " WHERE ventas.fecha_venta BETWEEN '$fecha_inicio' AND '$fecha_fin'";
}
$result = mysqli_query($conn, $query);
$ventas = mysqli_fetch_all($result, MYSQLI_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Informe de ventas</title>
</head>

<body>
    <header>
        <h1>
            Informe de ventas
        </h1>
    </header>
    <main>
        <form method="GET">
            <label for="fecha_inicio">Fecha de inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio">

            <label for="fecha_fin">Fecha de fin:</label>
            <input type="date" id="fecha_fin" name="fecha_fin">
            <button type="submit">Filtrar</button>
        </form>

        <table>
            <tr>
                <th>Empresa</th>
                <th>Factura num.</th>
                <th>Fecha de Venta</th>
                <th>Comprador</th>
                <th>Producto</th>
                <th>Valor Total</th>
            </tr>

            <tr>
                <?php foreach ($ventas as $venta): ?>
                    <td><?= htmlspecialchars($venta['empresa']) ?></td>
                    <td><?= htmlspecialchars($venta['numero_factura']) ?></td>
                    <td><?= htmlspecialchars($venta['fecha_venta']) ?></td>
                    <td><?= htmlspecialchars($venta['comprador']) ?></td>
                    <td><?= htmlspecialchars($venta['producto']) ?></td>
                    <td><?= htmlspecialchars($venta['valor_total']) ?></td>
            </tr>
        <?php endforeach; ?>
        </table>
    </main>

</body>

</html>