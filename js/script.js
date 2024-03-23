const carousel = document.querySelector(".carousel"),
    firstImg = carousel.querySelectorAll("img")[0],
    arrowIcons = document.querySelectorAll(".wrapper i");

let isDragStart = false, isDragging = false, prevPageX, prevScrollLeft, positionDiff;

const showHideIcons = () => {
    // showing and hiding prev/next icon according to carousel scroll left value
    let scrollWidth = carousel.scrollWidth - carousel.clientWidth; // getting max scrollable width
    arrowIcons[0].style.display = carousel.scrollLeft == 0 ? "none" : "block";
    arrowIcons[1].style.display = carousel.scrollLeft == scrollWidth ? "none" : "block";
}

arrowIcons.forEach(icon => {
    icon.addEventListener("click", () => {
        let firstImgWidth = firstImg.clientWidth + 14; // getting first img width & adding 14 margin value
        // if clicked icon is left, reduce width value from the carousel scroll left else add to it
        carousel.scrollLeft += icon.id == "left" ? -firstImgWidth : firstImgWidth;
        setTimeout(() => showHideIcons(), 60); // calling showHideIcons after 60ms
    });
});

const autoSlide = () => {
    // if there is no image left to scroll then return from here
    if (carousel.scrollLeft - (carousel.scrollWidth - carousel.clientWidth) > -1 || carousel.scrollLeft <= 0) return;

    positionDiff = Math.abs(positionDiff); // making positionDiff value to positive
    let firstImgWidth = firstImg.clientWidth + 14;
    // getting difference value that needs to add or reduce from carousel left to take middle img center
    let valDifference = firstImgWidth - positionDiff;

    if (carousel.scrollLeft > prevScrollLeft) { // if user is scrolling to the right
        return carousel.scrollLeft += positionDiff > firstImgWidth / 3 ? valDifference : -positionDiff;
    }
    // if user is scrolling to the left
    carousel.scrollLeft -= positionDiff > firstImgWidth / 3 ? valDifference : -positionDiff;
}

const dragStart = (e) => {
    // updatating global variables value on mouse down event
    isDragStart = true;
    prevPageX = e.pageX || e.touches[0].pageX;
    prevScrollLeft = carousel.scrollLeft;
}

const dragging = (e) => {
    // scrolling images/carousel to left according to mouse pointer
    if (!isDragStart) return;
    e.preventDefault();
    isDragging = true;
    carousel.classList.add("dragging");
    positionDiff = (e.pageX || e.touches[0].pageX) - prevPageX;
    carousel.scrollLeft = prevScrollLeft - positionDiff;
    showHideIcons();
}

const dragStop = () => {
    isDragStart = false;
    carousel.classList.remove("dragging");

    if (!isDragging) return;
    isDragging = false;
    autoSlide();
}

carousel.addEventListener("mousedown", dragStart);
carousel.addEventListener("touchstart", dragStart);

document.addEventListener("mousemove", dragging);
carousel.addEventListener("touchmove", dragging);

document.addEventListener("mouseup", dragStop);
carousel.addEventListener("touchend", dragStop);

function onSubmit(token) {
    document.getElementById("demo-form").submit();
}




// scrip para energia limpia, mostrar mas texto
function showMoreText() {
    var additionalTexts = document.querySelectorAll('.additional-text');
    var btnText = document.getElementById("read-more-btn");

    // Encuentra el índice del último párrafo visible
    var lastVisibleIndex = -1;
    for (var i = 0; i < additionalTexts.length; i++) {
        if (additionalTexts[i].classList.contains('show')) {
            lastVisibleIndex = i;
        }
    }

    if (btnText.textContent === "Leer más") {
        // Si hay párrafos ocultos, muestra el siguiente
        var nextParagraph = lastVisibleIndex + 1;
        if (nextParagraph < additionalTexts.length) {
            additionalTexts[nextParagraph].classList.add("show");
        }
        // Si todos los párrafos están ahora visibles, cambia el texto del botón
        if (nextParagraph === additionalTexts.length - 1) {
            btnText.textContent = "Mostrar menos";
        }
    } else {
        // Si el botón dice "Mostrar menos", oculta el último párrafo visible
        if (lastVisibleIndex >= 0) {
            additionalTexts[lastVisibleIndex].classList.remove("show");
        }
        // Si todos los párrafos están ahora ocultos, cambia el texto del botón
        if (lastVisibleIndex === 0) {
            btnText.textContent = "Leer más";
        }
    }
}

// script para los carruseles de Galeria
function toggleImages(selectedCarouselId) {
    var selectedCarousel = document.getElementById(selectedCarouselId);
    // Comprobar si el carrusel seleccionado ya está visible
    var isVisible = selectedCarousel.style.display === 'flex';
    // Primero, oculta todos los carruseles
    document.querySelectorAll('.carousel').forEach(function (carousel) {
        carousel.style.display = 'none';
    });
    // Luego, basado en si el carrusel seleccionado estaba visible, lo oculta o muestra
    if (!isVisible) {
        selectedCarousel.style.display = 'flex';
    }
}
function ampliarImagen(imagen) {
    var contenedorAmpliado = document.getElementById('contenedorAmpliado');
    var imagenAmpliada = document.getElementById('imagenAmpliada');
    imagenAmpliada.src = imagen.src.replace("_pequeña", ""); // Asumiendo que las imágenes ampliadas no tienen "_pequeña" en el nombre de archivo
    contenedorAmpliado.style.display = "flex";
}

function cerrarAmpliacion() {
    var contenedorAmpliado = document.getElementById('contenedorAmpliado');
    contenedorAmpliado.style.display = "none";
}


