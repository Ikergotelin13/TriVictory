<?php
$servidor = "localhost";
$usuario = "root";
$pass = "";
$bd = "pruebas";

$conexion = mysqli_connect($servidor, $usuario, $pass, $bd);

if (!$conexion){
    echo "Error al conectar con la base de datos";
} else {
    $query = "SELECT COUNT(*) as total_registros FROM participantes";
    $result = mysqli_query($conexion, $query);

    if (!$result) {
        echo "Error al obtener el número de registros";
    } else {
        $row = mysqli_fetch_assoc($result);
        echo $row['total_registros'];
    }

    mysqli_close($conexion);
}
?>
