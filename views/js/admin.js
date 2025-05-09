// Seleccionar elementos del DOM
const toggleButton = document.getElementById('toggleView');
const tablaActivas = document.getElementById('tablaActivas');
const tablaArchivadas = document.getElementById('tablaArchivadas');

// Lógica para alternar entre tablas
toggleButton.addEventListener('click', () => {
    console.log('Botón de alternar clicado'); // Para depuración
    // Alternar clases para mostrar/ocultar tablas
    tablaActivas.classList.toggle('hidden');
    tablaArchivadas.classList.toggle('hidden');

    // Cambiar el texto del botón según la tabla visible
    toggleButton.textContent = tablaActivas.classList.contains('hidden') 
        ? '📄 Ver activas' 
        : '🗂 Ver archivadas';
});