<?php
// Conexión a la base de datos (reemplaza con tus propios datos)
$servername = "localhost";
$username = "root";
$password = "";
$database = "competiciones";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener todas las competiciones ordenadas por fecha
$sql = "SELECT Modalidad, Competicion, Categoria, Distancia, Fecha FROM listado ORDER BY Fecha";

$result = $conn->query($sql);

// Crear un array asociativo para agrupar las competiciones por mes
$competiciones_por_mes = [];

if ($result->num_rows > 0) {
    // Si hay resultados, agrupar las competiciones por mes
    while ($row = $result->fetch_assoc()) {
        // Obtener el mes de la fecha y convertirlo a un formato legible (nombre del mes)
        $mes = date('F', strtotime($row["Fecha"]));

        // Crear un array si no existe para el mes actual
        if (!isset($competiciones_por_mes[$mes])) {
            $competiciones_por_mes[$mes] = [];
        }

        // Agregar la competición al array del mes correspondiente
        $competiciones_por_mes[$mes][] = $row;
    }
}

// Construir el HTML de los resultados agrupados por mes
$output = '';

foreach ($competiciones_por_mes as $mes => $competiciones) {
    $output .= '<div id="container-listado-competiciones">';
    $output .= '<div class="Mes">';
    $output .= '<h4 id="mes-texto">' . $mes . ' 2024</h4>';
    $output .= '</div>';
    $output .= '<div id="listado-superior">';
    $output .= '<div class="Modalidad">Modalidad</div>';
    $output .= '<div class="Competicion">Competición</div>';
    $output .= '<div class="Categoria">Categoría</div>';
    $output .= '<div class="Distancia">Distancia</div>';
    $output .= '<div class="Fecha">Fecha</div>';
    $output .= '</div>';

    foreach ($competiciones as $competicion) {
        $output .= '<section class="competi">';
        $output .= '<div class="Modalidad">' . $competicion["Modalidad"] . '</div>';
        $output .= '<div class="Competicion">' . $competicion["Competicion"] . '</div>';
        $output .= '<div class="Categoria">' . $competicion["Categoria"] . '</div>';
        $output .= '<div class="Distancia">' . $competicion["Distancia"] . '</div>';
        $output .= '<div class="Fecha">' . $competicion["Fecha"] . '</div>';
        $output .= '</section>';
    }

    $output .= '</div>'; // Cierre de container-listado-competiciones
}

// Mostrar un mensaje si no se encontraron competiciones
if (empty($competiciones_por_mes)) {
    $output .= '<div class="mensaje-vacio">';
    $output .= '<p>No se encontraron competiciones.</p>';
    $output .= '</div>';
}

echo $output;

$conn->close();
?>
