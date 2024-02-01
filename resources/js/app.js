import './bootstrap';
import '../scss/app.scss';
import '../js/maps.js';

(function () {
    const fileInput = document.getElementById('file-input-image');

    if (fileInput) {
        const fileLabel = document.querySelector('label[for="file-input-image"]');
        const fileNameSpan = document.getElementById('file-name');

        fileInput.addEventListener('change', function () {
            const fileName = fileInput.value.split('\\').pop();
            fileLabel.textContent = `Seleccionar archivo (${fileName})`;
            fileNameSpan.textContent = fileName;
        });
    }
})();
