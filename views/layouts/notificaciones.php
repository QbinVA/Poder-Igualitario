<div id="confirmacion" class="confirmacion oculto">
    <p id="mensajeConfirmacion"></p>
    <div class="botones">
        <button id="btnAceptar">Aceptar</button>
        <button id="btnCancelar">Cancelar</button>
    </div>
</div>

<style>
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
    z-index: 1000;
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

.confirmacion .botones {
    display: flex;
    justify-content: center;
    gap: 10px;
}

.confirmacion button {
    background: #2563eb;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 0.9rem;
    transition: background 0.3s ease;
}

.confirmacion button:hover {
    background: #1d4ed8;
}

.confirmacion button#btnCancelar {
    background: #dc2626;
}

.confirmacion button#btnCancelar:hover {
    background: #b91c1c;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const confirmacion = document.getElementById('confirmacion');
    const mensajeConfirmacion = document.getElementById('mensajeConfirmacion');
    const btnAceptar = document.getElementById('btnAceptar');
    const btnCancelar = document.getElementById('btnCancelar');

    let accionAceptar = null;

    // Función para mostrar el cuadro de confirmación
    window.mostrarConfirmacion = function (mensaje, callback) {
        mensajeConfirmacion.textContent = mensaje;
        confirmacion.classList.remove('oculto');
        accionAceptar = callback;
    };

    // Botón Aceptar
    btnAceptar.addEventListener('click', function () {
        if (accionAceptar) accionAceptar();
        confirmacion.classList.add('oculto');
    });

    // Botón Cancelar
    btnCancelar.addEventListener('click', function () {
        confirmacion.classList.add('oculto');
    });
});
</script>