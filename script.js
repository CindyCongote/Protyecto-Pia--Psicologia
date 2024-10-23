document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault();

    let formData = new FormData(this);

    fetch('guardar_mensaje.php', {
        method: 'POST',
        body: formData
    }).then(response => {
        return response.text();
    }).then(data => {
        cargarMensajes();
        this.reset();
    }).catch(error => console.error(error));
});

function cargarMensajes() {
    fetch('foro.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('mensajes').innerHTML = data;
        })
        .catch(error => console.error(error));
}

// Cargar los mensajes al cargar la página
window.onload = cargarMensajes;
