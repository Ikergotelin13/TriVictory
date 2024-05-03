<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Obtener datos del formulario
    $modalidad = $_POST['modalidad'];
    $competicion = $_POST['competicion'];
    $categoria = $_POST['categoria'];
    $distancia = $_POST['distancia'];
    $fecha = $_POST['fecha'];

    // Insertar datos en la base de datos
    $sql = "INSERT INTO listado (Modalidad, Competicion, Categoria, Distancia, Fecha) VALUES ('$modalidad', '$competicion', '$categoria', '$distancia', '$fecha')";

    if ($conn->query($sql) === TRUE) {
        // Después de insertar la competición en la base de datos, redirige al usuario a la página HTML
        header("Location: ../../paginas/eventos.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerrar conexión
    $conn->close();
}
?>
