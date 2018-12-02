var formulario = document.getElementById('Registro');
var respuesta = document.getElementById('respuesta');

formulario.addEventListener('submit', function(e){
    e.preventDefault();
    var datos = new FormData(formulario);

    var shaObj = new jsSHA("SHA-256", "TEXT");
        shaObj.update(datos.get('spass'));
    var hash = shaObj.getHash("HEX");
        datos.set('spass', hash);

    fetch('inc/SigIn.php', {
        method: 'POST',
        body: datos
    })
    
    .then( res => res.json())
    .then( data => {
        if(data === 'error'){
            respuesta.innerHTML = '<div class="alert alert-danger" role="alert"> Complete all fields </div>'
        }else if( data === 'existente'){
            respuesta.innerHTML = '<div class="alert alert-warning" role="alert"> That data was used </div>'
        }else{
            respuesta.innerHTML = '<div class="alert alert-success" role="alert">' + data + '</div>'
        }

        console.log(data)
    })
});

