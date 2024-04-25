<?php
// Verificar si se han enviado datos mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establecer conexión con la base de datos
    $host = 'localhost'; // Cambiar si es necesario
    $usuario = 'root'; // Cambiar por el usuario de la base de datos
    $contrasena = ''; // Cambiar por la contraseña de la base de datos
    $base_datos = 'pruebas'; // Cambiar por el nombre de la base de datos

    $conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    // Obtener los datos del formulario y sanitizarlos
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $apellidos = $conexion->real_escape_string($_POST['apellidos']);
    $categoria = $conexion->real_escape_string($_POST['categoria']);
    $club = $conexion->real_escape_string($_POST['club']);
    $genero = $conexion->real_escape_string($_POST['genero']);

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO participantes (Nombre, Apellidos, Categoria, Club, Genero) VALUES ('$nombre', '$apellidos', '$categoria', '$club', '$genero')";
    if ($conexion->query($sql) === TRUE) {
        echo "Los datos se han enviado correctamente.";
    } else {
        echo "Error al enviar los datos: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
} else {
    // Si no se han enviado datos mediante POST, mostrar un mensaje de error
    echo "Error: No se han recibido datos del formulario.";
}
?>
