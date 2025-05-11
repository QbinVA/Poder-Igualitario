<div id="overlay" class="overlay oculto"></div> <!-- Overlay -->
<div id="confirmacion" class="confirmacion oculto">
    <p id="mensajeConfirmacion"></p>
    <div class="botones">
        <button id="btnAceptar">Aceptar</button>
        <button id="btnCancelar">Cancelar</button>
    </div>
</div>

<style>
/* Overlay para oscurecer el fondo */
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* Oscurece el fondo */
    z-index: 999; /* Debajo del cuadro de confirmación */
    backdrop-filter: blur(5px); /* Aplica desenfoque */
    pointer-events: none; /* Bloquea clics inicialmente */
    opacity: 0;
    transition: opacity 0.3s ease;
}

.overlay.visible {
    opacity: 1;
    pointer-events: all; /* Permite bloquear clics cuando está visible */
}

/* Estilos para el cuadro de confirmación */
.confirmacion {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #fff;
    color: #111827;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    z-index: 1000; /* Por encima del overlay */
    text-align: center;
    display: flex;
    flex-direction: column;
    gap: 15px;
    opacity: 1;
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.confirmacion.oculto {
    opacity: 0;
    pointer-events: none;
    transform: translate(-50%, -60%);
}

/* Botones dentro del cuadro de confirmación */
.confirmacion .botones {
    display: flex;
    justify-content: center;
    gap: 10px;
}

/* Botón Aceptar con animación RGB */
.confirmacion button#btnAceptar {
    background: var(--teal); /* Color inicial */
    animation: bgRGB 15s ease-in-out infinite alternate; /* Animación RGB */
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 0.9rem;
    transition: transform 0.3s ease;
}

.confirmacion button#btnAceptar:hover {
    transform: scale(1.05); /* Efecto de hover */
}

/* Botón Cancelar */
.confirmacion button#btnCancelar {
    background: #dc2626; /* Color rojo fijo */
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 0.9rem;
    transition: background 0.3s ease, transform 0.3s ease;
}

.confirmacion button#btnCancelar:hover {
    background: #b91c1c; /* Color rojo más oscuro al hacer hover */
    transform: scale(1.05); /* Efecto de hover */
}

/* Botón seleccionado o con hover */
.confirmacion button.seleccionado {
    outline: 2px solid #2563eb; /* Borde azul para resaltar */
    outline-offset: 2px;
    transform: scale(1.1); /* Aumenta ligeramente el tamaño */
    transition: transform 0.2s ease, outline 0.2s ease;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const confirmacion = document.getElementById('confirmacion');
    const overlay = document.getElementById('overlay');
    const mensajeConfirmacion = document.getElementById('mensajeConfirmacion');
    const btnAceptar = document.getElementById('btnAceptar');
    const btnCancelar = document.getElementById('btnCancelar');
    const botones = [btnAceptar, btnCancelar]; // Lista de botones para el selector

    let accionAceptar = null;
    let botonSeleccionado = 1; // Índice del botón seleccionado (1 para "Cancelar" por defecto)

    // Función para mostrar el cuadro de confirmación
    window.mostrarConfirmacion = function (mensaje, callback) {
        mensajeConfirmacion.textContent = mensaje;
        confirmacion.classList.remove('oculto');
        overlay.classList.add('visible'); // Muestra el overlay
        accionAceptar = callback;
        seleccionarBoton(1); // Selecciona el botón "Cancelar" por defecto
    };

    // Botón Aceptar
    btnAceptar.addEventListener('click', function () {
        if (accionAceptar) accionAceptar();
        cerrarConfirmacion();
    });

    // Botón Cancelar
    btnCancelar.addEventListener('click', function () {
        cerrarConfirmacion();
    });

    // Cerrar con la tecla Escape y navegación con flechas
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') { // Detecta la tecla Escape
            cerrarConfirmacion();
        } else if (event.key === 'ArrowRight') { // Flecha hacia la derecha
            botonSeleccionado = (botonSeleccionado + 1) % botones.length; // Avanza al siguiente botón
            seleccionarBoton(botonSeleccionado);
        } else if (event.key === 'ArrowLeft') { // Flecha hacia la izquierda
            botonSeleccionado = (botonSeleccionado - 1 + botones.length) % botones.length; // Retrocede al botón anterior
            seleccionarBoton(botonSeleccionado);
        } else if (event.key === 'Enter') { // Tecla Enter
            botones[botonSeleccionado].click(); // Simula un clic en el botón seleccionado
        }
    });

    // Sincronizar selección con hover y clic
    botones.forEach((boton, index) => {
        boton.addEventListener('mouseenter', function () {
            seleccionarBoton(index); // Selecciona el botón al pasar el cursor
        });
        boton.addEventListener('mouseleave', function () {
            seleccionarBoton(botonSeleccionado); // Restaura el botón seleccionado al salir del hover
        });
        boton.addEventListener('click', function () {
            seleccionarBoton(index); // Selecciona el botón al hacer clic
        });
    });

    // Función para cerrar el cuadro de confirmación
    function cerrarConfirmacion() {
        confirmacion.classList.add('oculto');
        overlay.classList.remove('visible'); // Oculta el overlay
    }

    // Función para resaltar el botón seleccionado
    function seleccionarBoton(indice) {
        botones.forEach((boton, i) => {
            if (i === indice) {
                boton.classList.add('seleccionado'); // Agrega la clase al botón seleccionado
                boton.focus(); // Enfoca el botón seleccionado
            } else {
                boton.classList.remove('seleccionado'); // Quita la clase de los demás botones
            }
        });
        botonSeleccionado = indice; // Actualiza el índice del botón seleccionado
    }
});
</script>