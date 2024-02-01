if (document.querySelector('#maps')) {
    const lat = -33.0209213;
    const lng = -68.8092346;

    const zoom = 16;
    const map = L.map('maps').setView([lat, lng], zoom);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([lat, lng]).addTo(map)
        .bindPopup(`
            <h2 class="maps__heading">Metalúrgico & Herrería Artistica Cacho</h2>
            <p class="maps__texto">Casas de Campo 1, Cruz de Piedra, Mendoza </p>
            <a class="maps__texto" href="https://www.google.com.ar/maps/place/Metalúrgico+%26+Herrería+Artistica+Cacho/@-33.0207865,-68.8194091,2481m/data=!3m2!1e3!4b1!4m6!3m5!1s0x967e738a8fff0c29:0x5f990846a5b967dc!8m2!3d-33.0207869!4d-68.8091093!16s%2Fg%2F11ny2sscj0?entry=ttu">Ubicacion por Google Maps</a>
        `)
        .openPopup();
}
