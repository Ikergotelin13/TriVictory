
/*BUSQUEDA LUPA */

const inputBusqueda = document.getElementById('input-busqueda');

inputBusqueda.addEventListener('input', function(event) {
    const busqueda = event.target.value.trim().toLowerCase(); // Obtener el texto de búsqueda y limpiarlo
    // Aquí puedes hacer lo que quieras con el texto de búsqueda, como filtrar resultados o realizar una búsqueda en una base de datos
    console.log('Texto de búsqueda:', busqueda);
});

// También puedes agregar un evento para manejar la búsqueda cuando se presiona Enter
inputBusqueda.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        const busqueda = event.target.value.trim().toLowerCase(); // Obtener el texto de búsqueda y limpiarlo
        // Aquí puedes hacer lo que quieras con el texto de búsqueda cuando se presiona Enter
        console.log('Buscar:', busqueda);
        // Por ejemplo, puedes redirigir a una página de resultados de búsqueda
        // window.location.href = '/buscar?q=' + encodeURIComponent(busqueda);
    }
});

/*MENU DESPLEGABLE */

// Función para mostrar el menú desplegable y mantenerlo abierto si el ratón está dentro de él
function mostrarMenuDesplegable(event, menuDesplegable) {
  menuDesplegable.style.display = "block"; // Mostrar el menú desplegable
  menuDesplegable.addEventListener("mouseleave", function() { // Agregar evento para detectar cuando el ratón sale del menú desplegable
      // Ocultar el menú desplegable solo si el ratón sale del área del menú desplegable y del título
      var rect = menuDesplegable.getBoundingClientRect();
      if (event.clientY < rect.top || event.clientY > rect.bottom || event.clientX < rect.left || event.clientX > rect.right) {
          menuDesplegable.style.display = "none"; // Ocultar el menú desplegable cuando el ratón sale de él
      }
  });

}

// Agregar eventos para mostrar el menú desplegable correspondiente al pasar el ratón sobre los elementos del menú
document.getElementById("lista-eventos").addEventListener("mouseover", function(event) {
  mostrarMenuDesplegable(event, document.getElementById("lista-eventos-desplegable"));
});

document.getElementById("lista-atletas").addEventListener("mouseover", function(event) {
  mostrarMenuDesplegable(event, document.getElementById("lista-atletas-desplegable"));
});

document.getElementById("lista-multimedia").addEventListener("mouseover", function(event) {
  mostrarMenuDesplegable(event, document.getElementById("lista-multimedia-desplegable"));

});


/*SLIDER*/

const prevBtnSlider = document.getElementById('prevBtn');
const nextBtnSlider = document.getElementById('nextBtn');
const sliderSlider = document.querySelector('.slider');
const slidesSlider = document.querySelectorAll('.slide');

let counterSlider = 0;
const slideWidthSlider = slidesSlider[0].clientWidth;
const intervalTimeSlider = 5000; // Intervalo de tiempo en milisegundos (5 segundos)

let autoSlideIntervalSlider; // Variable para almacenar el intervalo del desplazamiento automático

// Función para avanzar el slider automáticamente cada 5 segundos
function startAutoSlideSlider() {
  autoSlideIntervalSlider = setInterval(() => {
      counterSlider++;
      if (counterSlider === slidesSlider.length) {
          counterSlider = 0;
      }
      updateSlider();
  }, intervalTimeSlider);
}

// Comenzar el desplazamiento automático cuando se carga la página
startAutoSlideSlider();

nextBtnSlider.addEventListener('click', () => {
  clearInterval(autoSlideIntervalSlider); // Detener el desplazamiento automático al hacer clic en el botón siguiente
  counterSlider++;
  if (counterSlider === slidesSlider.length) {
      counterSlider = 0;
  }
  updateSlider();
  startAutoSlideSlider(); // Reiniciar el desplazamiento automático después de hacer clic en el botón siguiente
});

prevBtnSlider.addEventListener('click', () => {
  clearInterval(autoSlideIntervalSlider); // Detener el desplazamiento automático al hacer clic en el botón anterior
  counterSlider--;
  if (counterSlider < 0) {
      counterSlider = slidesSlider.length - 1;
  }
  updateSlider();
  startAutoSlideSlider(); // Reiniciar el desplazamiento automático después de hacer clic en el botón anterior
});

function updateSlider() {
  const offsetSlider = -counterSlider * slideWidthSlider;
  sliderSlider.style.transform = `translateX(${offsetSlider}px)`;
}

/*SLIDER TIENDA*/
const prevBtnSliderTienda = document.querySelector('.prev');
const nextBtnSliderTienda = document.querySelector('.next');
const sliderSliderTienda = document.getElementById('prueba-slider');
const slidesSliderTienda = document.querySelectorAll('.slide-tienda');

let counterSliderTienda = 0;
const slideWidthSliderTienda = slidesSliderTienda[0].clientWidth; // Ancho de un solo slide
const slideVisibleCount = 3; // Número de slides visibles a la vez

// Porcentaje de avance deseado (ajustar según sea necesario)
const slideWidthPercentage = 106; // Porcentaje de avance

nextBtnSliderTienda.addEventListener('click', () => {
  // Calculamos el avance en píxeles
  const slideWidthIncrement = slideWidthSliderTienda * (slideWidthPercentage / 100);
  counterSliderTienda += slideVisibleCount;
  if (counterSliderTienda >= slidesSliderTienda.length) {
      counterSliderTienda = 0;
  }
  updateSliderTienda(slideWidthIncrement);
  sliderSliderTienda.classList.add('slide-animation'); // Agregar clase de animación al contenedor del slider
});

prevBtnSliderTienda.addEventListener('click', () => {
  // Calculamos el avance en píxeles
  const slideWidthIncrement = slideWidthSliderTienda * (slideWidthPercentage / 100);
  counterSliderTienda -= slideVisibleCount;
  if (counterSliderTienda < 0) {
      counterSliderTienda = slidesSliderTienda.length - slideVisibleCount;
  }
  updateSliderTienda(slideWidthIncrement);
  sliderSliderTienda.classList.add('slide-animation'); // Agregar clase de animación al contenedor del slider
});

// Agregar un listener de evento 'transitionend' para eliminar la clase de animación después de que la animación haya terminado
sliderSliderTienda.addEventListener('transitionend', () => {
  sliderSliderTienda.classList.remove('slide-animation');
});

function updateSliderTienda(slideWidthIncrement) {
  const offsetSliderTienda = -counterSliderTienda * slideWidthIncrement;
  sliderSliderTienda.style.transform = `translateX(${offsetSliderTienda}px)`;
}
