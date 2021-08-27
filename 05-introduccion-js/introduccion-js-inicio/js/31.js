const boton = document.querySelector('#boton');
boton.addEventListener('click', function(){
    Notification.requestPermission()
        .then(resultado => console.log('El resultado es: ', resultado));
});

if(Notification.permission == 'granted'){
    new Notification('Aprende desarrollo web', {
        icon: 'img/ccj.png',
        body: 'Código con Juan, los mejores tutoriales'
    });
}
