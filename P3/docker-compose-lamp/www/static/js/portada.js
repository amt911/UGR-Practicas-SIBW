import { toggleDarkModePlantilla } from "./modoOscuro.js";


var esOscuro=false;
function toggleDarkMode(){
    var boxes=document.getElementsByClassName("box");
    var tags=document.getElementsByClassName("fondo-azul-claro");
    var botonesPagina=document.getElementsByClassName("botones-pagina");
    var numeros=document.getElementById("indice-paginas-numeros").getElementsByTagName("div");

    if(!esOscuro){
        esOscuro=true;
        
        Array.from(boxes).forEach((aux)=>{
            aux.style.backgroundColor="#007ac1"
        });

        Array.from(tags).forEach((aux)=>{
            aux.style.backgroundColor="#002f6c"
        });        

        Array.from(botonesPagina).forEach((aux)=>{
            aux.style.backgroundColor="#731000";//"#c41c00";
        });

        Array.from(numeros).forEach((aux)=>{
            aux.style.backgroundColor="#002f6c";
        });        
    }
    else{
        esOscuro=false;

        Array.from(boxes).forEach((aux)=>{
            aux.style.backgroundColor=""
        });        

        Array.from(tags).forEach((aux)=>{
            aux.style.backgroundColor=""
        });                

        Array.from(botonesPagina).forEach((aux)=>{
            aux.style.backgroundColor="";
        });        

        Array.from(numeros).forEach((aux)=>{
            aux.style.backgroundColor="";
        });                
    }

    toggleDarkModePlantilla(esOscuro);
}
var botonDark=document.getElementById("modo-oscuro");
botonDark.addEventListener("click", toggleDarkMode);