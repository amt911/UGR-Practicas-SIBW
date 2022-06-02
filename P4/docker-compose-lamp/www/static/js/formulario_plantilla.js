let esOscuro=false;
function toggleDarkMode(){
    let h2=document.getElementsByTagName("h2");
    if(!esOscuro){
        botonDark.innerText="Modo claro"
        esOscuro=true;
    }
    else{
        botonDark.innerText="Modo oscuro"
        esOscuro=false;
    }

    //Array.from(h2).forEach((aux)=>{
    //    aux.classList.toggle("dark");
    //}) 

    toggleDarkModePlantilla();
}

//ZONA "MAIN"
let botonDark=document.getElementById("modo-oscuro");
botonDark.addEventListener("click", toggleDarkMode);