//import { toggleDarkModePlantilla } from "./modoOscuro.js";


let esOscuro=false;
function toggleDarkMode(){
    let boxes=document.getElementsByClassName("box");
    let tags=document.getElementsByClassName("fondo-azul-claro");
    let botonesPagina=document.getElementsByClassName("botones-pagina");
    let numeros=document.getElementById("indice-paginas-numeros").getElementsByTagName("div");

    if(!esOscuro){
        botonDark.innerText="Modo claro"
        esOscuro=true;
        
        Array.from(boxes).forEach((aux)=>{
            //aux.style.backgroundColor="#007ac1"
            aux.classList.toggle("dark");
        });

        Array.from(tags).forEach((aux)=>{
            //aux.style.backgroundColor="#002f6c"
            aux.classList.toggle("dark");
        });        

        Array.from(botonesPagina).forEach((aux)=>{
            //aux.style.backgroundColor="#731000";//"#c41c00";
            aux.classList.toggle("dark");
        });

        Array.from(numeros).forEach((aux)=>{
            //aux.style.backgroundColor="#002f6c";
            aux.classList.toggle("dark");
        });        
    }
    else{
        botonDark.innerText="Modo oscuro"
        esOscuro=false;

        Array.from(boxes).forEach((aux)=>{
            //aux.style.backgroundColor=""
            aux.classList.toggle("dark");
        });        

        Array.from(tags).forEach((aux)=>{
            //aux.style.backgroundColor=""
            aux.classList.toggle("dark");
        });                

        Array.from(botonesPagina).forEach((aux)=>{
            //aux.style.backgroundColor="";
            aux.classList.toggle("dark");
        });        

        Array.from(numeros).forEach((aux)=>{
            //aux.style.backgroundColor="";
            aux.classList.toggle("dark");
        });                
    }

    toggleDarkModePlantilla(esOscuro);
}



//ZONA "MAIN"
let botonDark=document.getElementById("modo-oscuro");
botonDark.addEventListener("click", toggleDarkMode);