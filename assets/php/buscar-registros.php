<?php
$servidor = "localhost";
$usuario = "root";
$pass = "";
$bd = "pruebas";

$conexion = mysqli_connect($servidor, $usuario, $pass, $bd);

if (!$conexion){
    echo "Error al conectar con la base de datos";
} else {
    if (isset($_GET['palabra'])) {
        $palabra = $_GET['palabra'];

        $query = "SELECT * FROM participantes WHERE nombre LIKE '%$palabra%' OR apellidos LIKE '%$palabra%' OR categoria LIKE '%$palabra%' OR club LIKE '%$palabra%' OR genero LIKE '%$palabra%'";
        $result = mysqli_query($conexion, $query);

        if (!$result) {
            echo "Error al realizar la búsqueda";
        } else {
            if (mysqli_num_rows($result) > 0) {
                echo "<table style='width: 100%; border-collapse: collapse; margin-top: 20px;'>";
                echo "<tr><th style='padding: 10px; text-align: left; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding-left: 20px;'>Nombre</th><th style='padding: 10px; text-align: left; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding-left: 20px;'>Apellidos</th><th style='padding: 10px; text-align: left; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding-left: 20px;'>Categoría</th><th style='padding: 10px; text-align: left; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding-left: 20px;'>Club</th><th style='padding: 10px; text-align: left; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding-left: 20px;'>Género</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr style='padding: 10px; text-align: left; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; padding-left: 20px;' onmouseover=\"this.style.backgroundColor='#f5f5f5';\" onmouseout=\"this.style.backgroundColor='';\">";
                    echo "<td style='padding: 10px; text-align: left; padding-left: 20px;'>" . $row['nombre'] . "</td>";
                    echo "<td style='padding: 10px; text-align: left; padding-left: 20px;'>" . $row['apellidos'] . "</td>";
                    echo "<td style='padding: 10px; text-align: left; padding-left: 20px;'>" . $row['categoria'] . "</td>";
                    echo "<td style='padding: 10px; text-align: left; padding-left: 20px;'>" . $row['club'] . "</td>";
                    echo "<td style='padding: 10px; text-align: left; padding-left: 20px;'>" . $row['genero'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No se encontraron resultados";
            }
        }
    } else {
        echo "No se proporcionó ninguna palabra clave";
    }

    mysqli_close($conexion);
}
?>
