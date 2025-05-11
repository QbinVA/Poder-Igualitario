// Previsualización de imagen seleccionada (opcional)
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('imagen_principal');
    const previewContainer = document.createElement('div');
    previewContainer.style.textAlign = 'center';
    previewContainer.style.marginBottom = '1rem';

    if (fileInput) {
        fileInput.parentNode.insertBefore(previewContainer, fileInput.nextSibling);

        fileInput.addEventListener('change', function(e) {
            previewContainer.innerHTML = '';
            const file = e.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    const img = document.createElement('img');
                    img.src = evt.target.result;
                    img.style.maxWidth = '100%';
                    img.style.maxHeight = '180px';
                    img.style.marginTop = '8px';
                    img.style.borderRadius = '8px';
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });
    }
});

// Validación simple de campos requeridos (opcional extra)
document.addEventListener('submit', function(e) {
    const form = e.target;
    if (form.matches('form')) {
        let valid = true;
        form.querySelectorAll('[required]').forEach(function(input) {
            if (!input.value.trim()) {
                input.style.borderColor = '#e53e3e';
                valid = false;
            } else {
                input.style.borderColor = '';
            }
        });
        if (!valid) {
            e.preventDefault();
            alert('Por favor, completa todos los campos obligatorios.');
        }
    }
}, true);