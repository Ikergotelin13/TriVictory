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

const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const slider = document.querySelector('.slider');
const slides = document.querySelectorAll('.slide');

let counter = 0;
const slideWidth = slides[0].clientWidth;

nextBtn.addEventListener('click', () => {
  counter++;
  if (counter === slides.length) {
    counter = 0;
  }
  updateSlider();
});

prevBtn.addEventListener('click', () => {
  counter--;
  if (counter < 0) {
    counter = slides.length - 1;
  }
  updateSlider();
});

function updateSlider() {
  const offset = -counter * slideWidth;
  slider.style.transform = `translateX(${offset}px)`;
}




/* MENU MOVILES */

