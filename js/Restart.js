var formulario = document.getElementById('Restart');
var respuesta = document.getElementById('respuesta');

formulario.addEventListener('submit', function(e){
    e.preventDefault();
    var datos = new FormData(formulario);

    var shaObj = new jsSHA("SHA-256", "TEXT");
        shaObj.update(datos.get('spass'));
    var hash = shaObj.getHash("HEX");
        datos.set('spass', hash);

    fetch('inc/Restart.php', {
        method: 'POST',
        body: datos
    })
    
    .then( res => res.json())
    .then( data => {
        if(data === 'error'){
            respuesta.innerHTML = '<div class="alert alert-danger" role="alert"> Complete all fields </div>'
        }else if( data === 'no_existente'){
            respuesta.innerHTML = '<div class="alert alert-warning" role="alert"> That email isn\'t registered </div>'
        }else{
            respuesta.innerHTML = '<div class="alert alert-success" role="alert">' + data + '</div>'
        }

    })
});
