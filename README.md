# challenge-Laworatory

Para ejecutar este proyecto, debes tener los siguientes componentes instalados:

    PHP: Se recomienda PHP 7.0 o superior.
    MySQL: Se recomienda MySQL 5.7 o superior.
    Servidor Web: Se puede usar XAMP MAMP, o cualquier servidor que sea compatible con PHP.
    Conexión a Internet: Para descargar las dependencias necesarias si fuera el caso.

 El proyecto tiene la siguiente estructura de archivos y directorios:

/proyecto
  /assets
    /css
      - styles.css
  db.php
  index.php
  README.md

                            Descripción de los Archivos

    /assets/css/styles.css: Archivo CSS que contiene los estilos para la presentación del informe de ventas.
    db.php: Script PHP que se encarga de establecer la conexión con la base de datos, crear las tablas necesarias si no existen, y rellenar las tablas con datos de ejemplo.
    index.php: Es el archivo principal que genera el informe de ventas. Contiene la lógica para consultar los datos de la base de datos y mostrar los resultados de acuerdo con los filtros seleccionados por el usuario.
    README.md: Este archivo contiene una descripción general del proyecto y las instrucciones de uso.

                                    Base de Datos
Estructura de la Base de Datos
El proyecto utiliza una base de datos MySQL llamada base_de_datos, que incluye tres tablas: empresas, productos y ventas.

Tabla empresas
id_empresa	INT	Identificador único de la empresa (PK, AUTO_INCREMENT).
nombre	VARCHAR	Nombre de la empresa.
direccion	VARCHAR	Dirección de la empresa.
nif	VARCHAR	Número de identificación fiscal de la empresa.

Tabla productos
Campo	Tipo	Descripción
id_producto	INT	Identificador único del producto (PK, AUTO_INCREMENT).
producto	VARCHAR	Nombre del producto.
precio	DECIMAL	Precio del producto.

Tabla ventas
Campo	Tipo	Descripción
id_venta	INT	Identificador único de la venta (PK, AUTO_INCREMENT).
empresa_id	INT	Identificador de la empresa asociada (FK).
producto_id	INT	Identificador del producto asociado (FK).
cantidad	INT	Cantidad del producto vendido.
numero_factura	VARCHAR	Número de la factura.
fecha_venta	DATE	Fecha en la que se realizó la venta.
comprador	VARCHAR	Nombre del comprador.
valor_total	DECIMAL	Valor total de la venta.

Inserción de Datos
El archivo db.php contiene los scripts necesarios para crear la base de datos, las tablas y llenar las tablas.

    El script crea la base de datos base_de_datos si no existe.
    Luego, crea las tablas empresas, productos y ventas.
    Inserta registros de ejemplo en cada una de las tablas.

Creación de la Base de Datos y Tablas
El archivo db.php incluye la creación de las tablas si no existen,y de manera similar para las tablas productos y ventas.

                                    Lógica del Proyecto

Conexión a la Base de Datos
La conexión a la base de datos se establece en el archivo db.php mediante mysqli_connect. Si la conexión falla, se muestra un error.

Consulta de Datos
El archivo index.php realiza una consulta SQL para obtener los datos de las ventas de la base de datos, con un filtro opcional por fecha.

La consulta SQL es la siguiente:

$query = "SELECT id_venta, empresas.nombre AS empresa, ventas.numero_factura, ventas.fecha_venta, productos.producto AS producto, ventas.comprador, ventas.valor_total 
          FROM ventas 
          JOIN empresas ON ventas.empresa_id = empresas.id_empresa
          JOIN productos ON ventas.producto_id = productos.id_producto";

if (!empty($fecha_inicio) && !empty($fecha_fin)) {
    $query .= " WHERE ventas.fecha_venta BETWEEN '$fecha_inicio' AND '$fecha_fin'";
}

Esta consulta obtiene todas las ventas, con los detalles de la empresa y el producto asociados. Si se proporcionan fechas de inicio y fin, la consulta filtrará los resultados dentro de ese rango.

                            Generación del Informe HTML

En index.php, los datos obtenidos de la base de datos se muestran en una tabla HTML.
Los datos son procesados mediante mysqli_fetch_all() y presentados en una tabla HTML, con las fechas y los valores escapados para evitar vulnerabilidades XSS.

Filtros de Fecha
En el formulario de la página principal (index.php), los usuarios pueden ingresar un rango de fechas para filtrar los resultados. El formulario utiliza GET para enviar las fechas seleccionadas al servidor, lo que permite que los resultados se actualicen dinámicamente cuando el usuario haga clic en "Filtrar".

                                            Estilos CSS

El archivo assets/css/styles.css contiene los estilos para darle una presentación clara al informe. La tabla tiene un diseño básico pero ordenado.