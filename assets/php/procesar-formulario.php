<?php
session_start(); // Inicia la sesión si aún no se ha iniciado

$servidor = "localhost";
$usuario = "root";
$pass = "";
$bd = "pruebas";

$conexion = mysqli_connect($servidor, $usuario, $pass, $bd);

if (!$conexion){
    $_SESSION["mensaje"] = "No se puede conectar con el servidor";
} else {  
    // Parte 1: Manejar la inserción de datos
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $categoria = $_POST['categoria'];
        $club = $_POST['club'];
        $genero = $_POST['genero'];

        // Introducimos los valores del formulario en la BD:
        $sql = "INSERT INTO participantes (nombre, apellidos, categoria, club, genero)
        VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sssss", $nombre, $apellidos, $categoria, $club, $genero);

        if ($stmt->execute()) {
            $_SESSION["mensaje"] = "Datos introducidos correctamente";
        } else {
            $_SESSION["mensaje"] = "Error al enviar el formulario: " . $conexion->error;
        }
        header("refresh:2; url=../../paginas/inscripcion/listado-participantes.html");
        $stmt->close();
    }

    // Parte 2: Mostrar los datos existentes
    // Variables para paginación
    $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
    $max_registros = 9;
    $inicio = ($pagina - 1) * $max_registros;

    // Consulta los datos de la tabla participantes con paginación
    if (isset($_GET['filtro-categoria']) && $_GET['filtro-categoria'] !== 'todos') {
        // Si se aplica un filtro de categoría, no limites los resultados por página
        $query = "SELECT * FROM participantes WHERE categoria = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("s", $_GET['filtro-categoria']);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        // Si no se aplica un filtro de categoría, utiliza la paginación normal
        $query = "SELECT * FROM participantes LIMIT $inicio, $max_registros";
        $result = mysqli_query($conexion, $query);
    }

    if ($result) {
        // Si la consulta fue exitosa, mostrar los datos en una tabla HTML
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Lista de Participantes</title>
            <style>
                /* Estilos personalizados para la tabla */
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                }

                th, td {
                    padding: 10px;
                    text-align: left;
                    border-top: 1px solid #ddd; /* línea de separación arriba */
                    border-bottom: 1px solid #ddd; /* línea de separación abajo */
                    padding: 10px;
                    padding-left: 20px;
                    text-align: left;
                }

                tr:hover {
                    background-color: #f5f5f5; /* Color de fondo al pasar el ratón sobre una fila */
                }
            </style>
        </head>
        <body>
            <?php
            // Mostrar mensaje si existe
            if (isset($_SESSION["mensaje"])) {
                echo "<p>" . $_SESSION["mensaje"] . "</p>";
                unset($_SESSION["mensaje"]); // Limpiar mensaje
            }
            ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <!-- Aquí va tu formulario para ingresar nuevos datos -->
            </form>
            <table>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Categoría</th>
                    <th>Club</th>
                    <th>Género</th>
                </tr>
                <?php
                // Iterar sobre los resultados y mostrarlos en la tabla
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['nombre'] . "</td>";
                    echo "<td>" . $row['apellidos'] . "</td>";
                    echo "<td>" . $row['categoria'] . "</td>";
                    echo "<td>" . $row['club'] . "</td>";
                    echo "<td>" . $row['genero'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>

            <?php
            // Obtener el número total de registros para la paginación
            $query_total = "SELECT COUNT(*) as total FROM participantes";
            if (isset($_GET['filtro-categoria']) && $_GET['filtro-categoria'] !== 'todos') {
                // Si se aplica un filtro de categoría, cuenta todos los registros sin aplicar el filtro
                $query_total = "SELECT COUNT(*) as total FROM participantes";
            }
            $resultado_total = mysqli_query($conexion, $query_total);
            $fila_total = mysqli_fetch_assoc($resultado_total);
            $total_registros = $fila_total['total'];
            $total_paginas = ceil($total_registros / $max_registros);

            // Si se aplica un filtro de categoría, actualiza la paginación para reflejar el número total de participantes
            if (isset($_GET['filtro-categoria']) && $_GET['filtro-categoria'] !== 'todos') {
                ?>
                <nav>
                    <ul>
                        <?php for ($i = 1; $i <= $total_paginas; $i++) { ?>
                            <li><a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?pagina=" . $i . "&filtro-categoria=" . urlencode($_GET['filtro-categoria']); ?>"><?php echo $i; ?></a></li>
                        <?php } ?>
                    </ul>
                </nav>
            <?php } ?>

        </body>
        </html>
        <?php
        mysqli_free_result($result);
    } else {
        // Si la consulta no fue exitosa, mostrar un mensaje de error
        $_SESSION["mensaje"] = "Error al obtener los datos de la base de datos: " . mysqli_error($conexion);
    }
    $conexion->close();
}
?>

