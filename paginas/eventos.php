<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos</title>
    <link rel="stylesheet" href="../assets/css/estilo.css">
</head>

<body>
    <header id="header"></header>
    <main id="contenedor-completo">
        <div>
            <div id="container-titulo">
                <h1 id="titulo-eventos">Competiciones</h1>
            </div>
            <div id="subtitulo-eventos">
                <p>Aquí podrás ver las próximas pruebas que se van a organizar, a través de los enlaces podrás ver más
                    detalles de cada prueba junto a sus circuitos, normativa y enlace de inscripción. También puedes
                    filtrar tanto por tipo de distancia, modalidad o edad para participar.</p>
            </div>
            <div id="busqueda">
                <h2>Búsqueda avanzada</h2>
            </div>
            <div id="container-filtros">
                <ul>
                    <li>
                        <label for="filtro-modalidad"></label>
                        <select name="modalidad" id="filtro-modalidad" class="listas-filtros">
                            <option value="Todas las modalidades">Todas las modalidades</option>
                            <option value="Triatlon">Triatlón</option>
                            <option value="Duatlon">Duatlón</option>
                            <option value="Triatlon Cros">Triatlón Cros</option>
                            <option value="Duatlon Cros">Duatlón Cros</option>
                            <option value="Acuatlon">Acuatlón</option>
                            <option value="Aquabike">Aquabike</option>
                        </select>
                    </li>
                </ul>
                <ul>
                    <li>
                        <label for="filtro-distancia"></label>
                        <select name="distancia" id="filtro-distancia" class="listas-filtros">
                            <option value="Todas las distancias">Todas las distancias</option>
                            <option value="Corta">Corta</option>
                            <option value="Sprint">Sprint</option>
                            <option value="Supersprint">Supersprint</option>
                            <option value="Media distancia">Media distancia</option>
                            <option value="Olimpica">Olímpica</option>
                            <option value="Larga distancia">Larga distancia</option>
                        </select>
                    </li>
                </ul>
                <ul>
                    <li>
                        <label for="filtro-categoria"></label>
                        <select name="categoria" id="filtro-categoria" class="listas-filtros">
                            <option value="Todas las edades">Todas las edades</option>
                            <option value="Menores">Menores</option>
                            <option value="Adultos">Adultos</option>
                        </select>
                    </li>
                </ul>
                <button class="botones-filtros" id="boton-buscar">Buscar</button>
                <button class="botones-filtros" id="boton-reiniciar">Reiniciar filtros</button>
                <div id="formulario-competicion-container">
                    <button id="boton-anadir-competicion" class="botones-filtros">Añadir Competición</button>
                    <form method="post" action="../assets/php/agregar-competicion.php" id="formulario-competicion">
                        <button id="cerrar-formulario" type="button">X</button>
                        <label for="modalidad">Modalidad:</label>
                        <select name="modalidad" id="modalidad">
                            <option value="Triatlon">Triatlón</option>
                            <option value="Duatlon">Duatlón</option>
                            <option value="Triatlon Cros">Triatlón Cros</option>
                            <option value="Duatlon Cros">Duatlón Cros</option>
                            <option value="Acuatlon">Acuatlón</option>
                            <option value="Aquabike">AquaBike</option>
                        </select><br><br>

                        <label for="competicion">Competición:</label>
                        <textarea name="competicion" id="competicion"
                            placeholder="Nombre de la competicion"></textarea><br><br>



                        <label for="categoria">Categoría:</label>
                        <select name="categoria" id="categoria">
                            <option value="Adultos">Adultos</option>
                            <option value="Menores">Menores</option>
                        </select><br><br>

                        <label for="distancia">Distancia:</label>
                        <select name="distancia" id="distancia">
                            <option value="SuperSprint">SuperSprint</option>
                            <option value="Sprint">Sprint</option>
                            <option value="Corta">Corta</option>
                            <option value="Olimpica">Olimpica</option>
                            <option value="Media Distancia">Media Distancia</option>
                            <option value="Larga Distancia">Larga Distancia</option>
                        </select><br><br>

                        <label for="fecha">Fecha:</label>
                        <input type="date" name="fecha" id="fecha"><br><br>

                        <input type="submit" value="Añadir Competición" id="boton-añadir-competi">
                    </form>
                </div>



                <div id="formulario-eliminar-competicion-container">
                    <button id="boton-eliminar-competicion" class="botones-filtros">Eliminar Competición</button>
                    <form method="post" action="../assets/php/eliminar-competicion.php"
                        id="formulario-eliminar-competicion">
                        <button id="cerrar-formulario-eliminar" type="button">X</button>
                        <!-- Botón para cerrar el formulario -->
                        <label for="competicion">Competición a eliminar:</label>
                        <input type="text" name="competicion" id="competicion"><br><br>
                        <input type="submit" value="Eliminar Competición">
                    </form>
                </div>
            </div>

        </div>

        <div id="Todo-completos">
            <div id="container-listado-competiciones">
                <?php include '../assets/php/mostrar-competiciones.php'; ?>
            </div>
        </div>

        <footer>
            <div id="footer"></div>
        </footer>

    </main>

    <script>
    window.addEventListener('DOMContentLoaded', (event) => {
        const headerContainer = document.getElementById('header');
        const footerContainer = document.getElementById('footer');

        // Obtener la ruta relativa al directorio actual
        const currentPagePath = window.location.pathname;
        const currentPageDirectory = currentPagePath.substring(0, currentPagePath.lastIndexOf('/'));

        // Cargar el encabezado
        fetch(currentPageDirectory + '/header.html')
            .then(response => response.text())
            .then(data => {
                headerContainer.innerHTML = data;
            });

        // Cargar el pie de página
        fetch(currentPageDirectory + '/footer.html')
            .then(response => response.text())
            .then(data => {
                footerContainer.innerHTML = data;
            });
    });


    /*AÁDIR COMPETICION */
    document.getElementById("boton-anadir-competicion").addEventListener("click", function() {
        var formulario = document.getElementById("formulario-competicion");
        formulario.style.display = "flex";
        formulario.style.position = "absolute";
        formulario.style.top = "80%"; // Cambia este valor según sea necesario
        formulario.style.left = "50%";
        formulario.style.transform = "translate(-50%, -50%)";

        var containerListado = document.getElementById("container-listado-competiciones");
        containerListado.style.marginTop = "150px";
    });

    document.getElementById("cerrar-formulario").addEventListener("click", function() {
        var formulario = document.getElementById("formulario-competicion");
        formulario.style.display = "none";
        var containerListado = document.getElementById("container-listado-competiciones");
        containerListado.style.marginTop = "0";
    });

    /*ELIMINAR COMPETICION */

    document.getElementById("boton-eliminar-competicion").addEventListener("click", function() {
        var formulario = document.getElementById("formulario-eliminar-competicion");
        formulario.style.display = "block";
        // Ajustar el margen superior del contenedor del listado de competiciones
        var containerListado = document.getElementById("container-listado-competiciones");
        containerListado.style.marginTop = "150px"; // Puedes ajustar este valor según sea necesario
        formulario.style.position = "absolute";
        formulario.style.top = "80%";
        formulario.style.left = "50%";
        formulario.style.transform = "translate(-50%, -50%)";
    });

    document.getElementById("cerrar-formulario-eliminar").addEventListener("click", function() {
        var formulario = document.getElementById("formulario-eliminar-competicion");
        formulario.style.display = "none";
        // Restaurar el margen superior del contenedor del listado de competiciones
        var containerListado = document.getElementById("container-listado-competiciones");
        containerListado.style.marginTop = "0";
    });

    /*FILTRO COMPETI*/
    document.getElementById('boton-buscar').addEventListener('click', function() {
        buscarCompeticiones();
    });

    // Función para realizar la búsqueda de competiciones
    function buscarCompeticiones() {
        var modalidad = document.getElementById('filtro-modalidad').value;
        var distancia = document.getElementById('filtro-distancia').value;
        var categoria = document.getElementById('filtro-categoria').value;

        // Enviar los valores de los filtros incluso si la categoría no está seleccionada
        var formData = new FormData();
        formData.append('modalidad', modalidad);
        formData.append('distancia', distancia);
        formData.append('categoria', categoria);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../assets/php/filtro-competicion.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('container-listado-competiciones').innerHTML = xhr.responseText;
            }
        };
        xhr.send(formData);
    }

    // Event listener para el botón de reiniciar filtros
    document.getElementById('boton-reiniciar').addEventListener('click', function() {
        // Restablecer los valores de los selectores de filtro a sus valores por defecto
        document.getElementById('filtro-modalidad').value = 'Todas las modalidades';
        document.getElementById('filtro-distancia').value = 'Todas las distancias';
        document.getElementById('filtro-categoria').value = 'Todas las edades';

        // Realizar la búsqueda nuevamente con los filtros reiniciados
        buscarCompeticiones();
    });
    </script>
</body>

</html>

