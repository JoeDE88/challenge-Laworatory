<?php

// conectar de nuevo
//$conn = new mysqli ($host,$user,$password,$database);

// REVISAR QUE NOMBRE BBDD COINCIDA
//$sql = "SELECT * FROM "prueba_en_code";
//$result = $conn->query($sql);


//  AÑADIR ESTA LINEA ANTES DE LA TR DE LOS TD: <?php foreach ($ventas as $venta): CIERRA PHP
// AÑADIR ESTA LINEA ANTES DE LA TR DE LOS TD: <?php endforeach; CIERRA PHP
//  AÑADIR ESTA LINEA EN value de INPUT FECHA INICIO <?= isset($_GET['fecha_inicio']) ? $_GET['fecha_inicio'] : ''  CIERRA PHP
// AÑADIR ESTA LINEA EN value de INPUT FECHA FIN <?= isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : '' CIERRA PHP

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
            <label for="fecha_inicio">Desde:</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" value="2024-01-02">

            <label for="fecha_fin">Hasta:</label>
            <input type="date" name="fecha_fin" id="fecha_fin" value="2024-03-03">

            <button type="submit">Filtrar</button>
        </form>

        <table>
            <tr>
                <th>Empresa</th>
                <th>Factura num.</th>
                <th>Fecha de Venta</th>
                <th>Comprador</th>
                <th>Valor Total</th>
            </tr>

            <tr>
                <td>Empresa</td>
                <td>1234</td>
                <td>1-1-23</td>
                <td>comprador</td>
                <td>importe total</td>
            </tr>
            <tr>
                <td>Empresa2</td>
                <td>12345</td>
                <td>1-1-23</td>
                <td>comprador3</td>
                <td>importe total</td>
            </tr>

        </table>
    </main>

</body>

</html>