//esto es un collback
document.addEventListener('DOMContentLoaded', function() {

    eventListeners();

    darkMode();
});

function darkMode(){

    //ahora pondre el modo oscuro sobre las preferencias del sistema
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: light)') ;
    //console.log(prefereDarkMode.matches);
    // if(prefiereDarkMode){
    //     document.body.classList.add('dark-mode');
    // } else{
    //     document.body.classList.remove('dark-mode');
    // }

    //si el usuario cambia la variable del sistemas a claro u oscuro esta funcion escuchara por eso
    prefiereDarkMode.addEventListener('change', function(){
        if(prefiereDarkMode){
            document.body.classList.add('dark-mode');
        } else{
            document.body.classList.remove('dark-mode');
        }
    });

    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function(){
        document.body.classList.toggle('dark-mode');
    })
}

function eventListeners(){
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);
}

function navegacionResponsive() {
    //console.log('desde res');
    const navegacion = document.querySelector('.navegacion');
    //seria una forma de quitar o agregar un clase dando click
   /* if(navegacion.classList.contains('mostrar')){
        navegacion.classList.remove('mostrar');
    }else{
        navegacion.classList.add('mostrar');
    }*/
    //existe otra manera mas facil con toogle que hace lo mismo
    navegacion.classList.toggle('mostrar');
}