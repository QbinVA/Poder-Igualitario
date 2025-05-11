document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const fechaInput = document.getElementById('fecha');

    // Limitar el calendario al mes actual
    if (fechaInput) {
        const hoy = new Date();
        const primerDiaMes = new Date(hoy.getFullYear(), hoy.getMonth(), 1);
        const ultimoDiaMes = new Date(hoy.getFullYear(), hoy.getMonth() + 1, 0);

        // Formatear fechas en formato YYYY-MM-DD
        const formatoFecha = (fecha) => fecha.toISOString().split('T')[0];

        fechaInput.min = formatoFecha(primerDiaMes);
        fechaInput.max = formatoFecha(ultimoDiaMes);
    }

    if (form) {
        form.addEventListener('submit', function (e) {
            const titular = document.getElementById('titular').value.trim();
            const descripcion = document.getElementById('descripcion_corta').value.trim();
            const contenido = document.getElementById('contenido').value.trim();
            const fecha = document.getElementById('fecha').value;
            const referencia = document.getElementById('referencia').value.trim();

            const errores = [];

            // Validar mínimo de 5 caracteres
            if (titular.length < 5) {
                errores.push('El titular debe contener al menos 5 caracteres.');
            }
            if (descripcion.length < 5) {
                errores.push('La descripción debe contener al menos 5 caracteres.');
            }
            if (contenido.length < 5) {
                errores.push('El contenido debe contener al menos 5 caracteres.');
            }

            // Validar que la fecha no sea del mismo mes
            const fechaPublicacion = new Date(fecha);
            const fechaActual = new Date();
            if (
                fechaPublicacion.getFullYear() !== fechaActual.getFullYear() ||
                fechaPublicacion.getMonth() !== fechaActual.getMonth()
            ) {
                errores.push('La fecha de la publicación debe ser del mes actual.');
            }

            // Validar referencia (URL o formato APA)
            const urlRegex = /^(https?:\/\/[^\s]+)$/;
            const apaRegex = /^[A-Za-z]+,\s[A-Za-z]+\.\s\([0-9]{4}\)\.\s.+$/; // Ejemplo de formato APA
            if (referencia && !urlRegex.test(referencia) && !apaRegex.test(referencia)) {
                errores.push('La referencia debe ser una URL válida o estar en formato APA.');
            }

            // Mostrar errores si existen
            if (errores.length > 0) {
                e.preventDefault();
                alert(errores.join('\n'));
            }
        });
    }
});