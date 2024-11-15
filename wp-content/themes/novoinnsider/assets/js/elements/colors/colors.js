document.addEventListener("DOMContentLoaded", function() {
    // Obtener el contenedor con la clase 'background-taxonomy'
    var container = document.querySelector('.background-taxonomy');

    if (container && container.hasAttribute('data-bg-color')) {

        // Obtener el color del atributo data-bg-color
        var color = container.getAttribute('data-bg-color');

        // Crear una nueva regla CSS con JavaScript
        var style = document.createElement('style');
        style.innerHTML = `
            .background-taxonomy::before {
                background-color: ${color} !important;
            }
            .background-single::before {
                background-color: ${color} !important;
            }
        `;
        document.head.appendChild(style);

    }

    // Obtener el contenedor con la clase 'background-taxonomy'
    var containerTwo = document.querySelector('.background-single');

    if (containerTwo && containerTwo.hasAttribute('data-bg-color')) {

        // Obtener el color del atributo data-bg-color
        var color = containerTwo.getAttribute('data-bg-color');

        // Crear una nueva regla CSS con JavaScript
        var styleTwo = document.createElement('style');
        styleTwo.innerHTML = `
            .background-single::before {
                background-color: ${color} !important;
            }
        `;
        document.head.appendChild(styleTwo);
    }

    // Obtener el contenedor con la clase 'background-taxonomy'
    var containerThree = document.querySelector('.background-title-round');

    if (containerThree && containerThree.hasAttribute('data-bg-color')) {

        // Obtener el color del atributo data-bg-color
        var color = containerThree.getAttribute('data-bg-color');

        // Crear una nueva regla CSS con JavaScript
        var styleThree = document.createElement('style');
        styleThree.innerHTML = `
            .background-title-round::before {
                background-color: ${color} !important;
            }
        `;
        document.head.appendChild(styleThree);
    }

    // Obtener el contenedor con la clase 'background-taxonomy'
    var containerThree = document.querySelector('.background-title-round-two');

    if (containerThree && containerThree.hasAttribute('data-bg-color')) {

        // Obtener el color del atributo data-bg-color
        var color = containerThree.getAttribute('data-bg-color');

        // Crear una nueva regla CSS con JavaScript
        var styleThree = document.createElement('style');
        styleThree.innerHTML = `
            .background-title-round-two::before {
                background-color: ${color} !important;
            }
        `;
        document.head.appendChild(styleThree);
    }
    

});