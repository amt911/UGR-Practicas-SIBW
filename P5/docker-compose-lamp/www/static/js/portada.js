let esOscuro=false;
function toggleDarkMode(){
    let boxes=document.getElementsByClassName("box");
    let tags=document.getElementsByClassName("fondo-normal");
    let botonesPagina=document.getElementsByClassName("botones-pagina");
    let numeros=document.getElementById("indice-paginas-numeros").getElementsByTagName("div");

    if(!esOscuro){
        botonDark.innerText="Modo claro"
        esOscuro=true;
    }
    else{
        botonDark.innerText="Modo oscuro"
        esOscuro=false;
    }

    Array.from(boxes).forEach((aux)=>{
        aux.classList.toggle("dark");
    });

    Array.from(tags).forEach((aux)=>{
        aux.classList.toggle("dark");
    });        

    Array.from(botonesPagina).forEach((aux)=>{
        aux.classList.toggle("dark");
    });

    Array.from(numeros).forEach((aux)=>{
        aux.classList.toggle("dark");
    });        

    toggleDarkModePlantilla();
}

//ZONA "MAIN"
let botonDark=document.getElementById("modo-oscuro");
botonDark.addEventListener("click", toggleDarkMode);