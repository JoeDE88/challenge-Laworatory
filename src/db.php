<?php

$host = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($host, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

$sql = "CREATE DATABASE IF NOT EXISTS prueba_en_code;
USE prueba_en_code;";
if (!mysqli_multi_query($conn, $sql)) {
    die("Error al crear la base de datos: " . mysqli_error($conn));
}
while (mysqli_next_result($conn)) {;};

echo "Base de datos seleccionada correctamente...<br>";

mysqli_select_db($conn, "prueba_en_code");

$tabla_empresas = "CREATE TABLE IF NOT EXISTS empresas (
    id_empresa INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(200) NOT NULL,
    direccion VARCHAR(200) NOT NULL,
    nif VARCHAR(20) NOT NULL
)";

$tabla_productos = "CREATE TABLE IF NOT EXISTS productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    producto VARCHAR(200) NOT NULL,
    precio DECIMAL(10,2) NOT NULL
)";

$tabla_ventas = "CREATE TABLE IF NOT EXISTS ventas (
    id_venta INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT,
    producto_id INT,
    cantidad INT,
    numero_factura VARCHAR(50) NOT NULL,
    fecha_venta DATE NOT NULL,
    comprador VARCHAR(200) NOT NULL,
    valor_total DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (empresa_id) REFERENCES empresas(id_empresa),
    FOREIGN KEY (producto_id) REFERENCES productos(id_producto)
)";

mysqli_query($conn, $tabla_empresas) or die("Error al crear la tabla 'empresas': " . mysqli_error($conn));
mysqli_query($conn, $tabla_productos) or die("Error al crear la tabla 'productos': " . mysqli_error($conn));
mysqli_query($conn, $tabla_ventas) or die("Error al crear la tabla 'ventas': " . mysqli_error($conn));

echo "Tablas 'creadas' creada con éxito...<br>";

$empresas_sql = "INSERT IGNORE INTO empresas (nombre, direccion, nif) VALUES
    ('Empresa A', 'Calle Lagasca 105, Madrid', 'A11111'),
    ('Empresa B', 'Gran Via, Madrid', 'B22222'),
    ('Empresa C', 'Plaza Mayor, Madrid', 'C33333')";

$productos_sql = "INSERT IGNORE INTO productos (producto, precio) VALUES
    ('Producto 1', 10.00),
    ('Producto 2', 20.10),
    ('Producto 3', 15.99)";

$ventas_sql = "INSERT IGNORE INTO ventas (empresa_id, producto_id, cantidad, numero_factura, fecha_venta, comprador, valor_total) VALUES
    (1, 1, 2, 'FAC-000001', '2025-03-05', 'Cliente 1', 20.00),
    (1, 2, 1, 'FAC-000002', '2025-03-05', 'Cliente 1', 20.10),
    (2, 3, 3, 'FAC-000003', '2025-03-01', 'Cliente 7', 47.97),
    (3, 1, 1, 'FAC-000004', '2025-02-27', 'Cliente 4', 10.00),
    (2, 2, 2, 'FAC-000005', '2025-02-17', 'Cliente 2', 40.20),
    (2, 1, 1, 'FAC-000006', '2025-03-02', 'Cliente 5', 10.00),
    (3, 2, 1, 'FAC-000007', '2025-03-03', 'Cliente 1', 20.10),
    (1, 3, 1, 'FAC-000008', '2025-01-10', 'Cliente 10', 15.99),
    (3, 2, 1, 'FAC-000009', '2025-02-25', 'Cliente 9', 20.10),
    (1, 1, 4, 'FAC-000010', '2025-01-12', 'Cliente 10', 40.00),
    (1, 3, 2, 'FAC-000011', '2025-03-05', 'Cliente 11', 31.98),
    (2, 2, 1, 'FAC-000012', '2025-03-07', 'Cliente 2', 20.10),
    (3, 1, 2, 'FAC-000013', '2025-03-02', 'Cliente 5', 20.00),
    (4, 1, 3, 'FAC-000014', '2025-01-02', 'Cliente X', 30.00);";

mysqli_close($conn);
echo "Conexión cerrada. El proceso ha finalizado correctamente.<br>";
?>