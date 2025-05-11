// Seleccionar elementos del DOM
const toggleButton = document.getElementById('toggleView');
const tablaActivas = document.getElementById('tablaActivas');
const tablaArchivadas = document.getElementById('tablaArchivadas');

// Lógica para alternar entre tablas con corrección visual
toggleButton.addEventListener('click', () => {
    const activasVisible = tablaActivas.classList.contains('visible');

    if (activasVisible) {
        // Ocultar activas
        tablaActivas.classList.remove('visible');
        tablaActivas.classList.add('hidden');

        // Mostrar archivadas
        tablaArchivadas.classList.remove('hidden');
        tablaArchivadas.classList.add('visible');

        // Cambiar texto del botón
        toggleButton.textContent = '📄 Ver activas';
    } else {
        // Ocultar archivadas
        tablaArchivadas.classList.remove('visible');
        tablaArchivadas.classList.add('hidden');

        // Mostrar activas
        tablaActivas.classList.remove('hidden');
        tablaActivas.classList.add('visible');

        // Cambiar texto del botón
        toggleButton.textContent = '🗂 Ver archivadas';
    }
});