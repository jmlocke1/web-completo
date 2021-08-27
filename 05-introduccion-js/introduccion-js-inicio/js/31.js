const boton = document.querySelector('#boton');
boton.addEventListener('click', function(){
    Notification.requestPermission()
        .then(resultado => console.log('El resultado es: ', resultado));
});

if(Notification.permission == 'granted'){
    new Notification('Esta semana nos volcamos con Wally', {
        icon: 'https://e00-elmundo.uecdn.es/assets/multimedia/imagenes/2018/04/04/15228499443369.png',
        body: 'Código con Juan, los mejores tutoriales',
        title: 'Wally es el mejor... cuando lo encuentras'
    });
}