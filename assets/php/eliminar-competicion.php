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

// Verificar si el campo 'competicion' está definido en $_POST
if(isset($_POST['competicion'])){
    // Obtener el valor de 'competicion'
    $competicion = $_POST['competicion'];

    // Eliminar competición de la base de datos
    $sql = "DELETE FROM listado WHERE Competicion = '$competicion'";

    if ($conn->query($sql) === TRUE) {
        echo "Competición eliminada correctamente";
    } else {
        echo "Error al eliminar competición: " . $conn->error;
    }
} else {
    // Si 'competicion' no está definido en $_POST, mostrar un mensaje de error
    echo "Error: El campo 'competicion' no está definido en la solicitud POST.";
}

// Cerrar conexión
$conn->close();

header("Location: ../../paginas/eventos.php");
?>
