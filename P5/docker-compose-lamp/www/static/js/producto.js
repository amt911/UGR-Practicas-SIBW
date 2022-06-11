function toggleDarkMode(){
    //Variables especiales de producto
    let webLogo=document.getElementById("pagina-oficial-logo");
    let imprimirLogo=document.getElementById("imprimir-logo");
    let info=document.getElementById("info");
    let titulo=document.getElementById("titulo");
    let botonComprar=document.getElementById("boton-comprar");
    let table=document.getElementsByTagName("table");
    let td=document.getElementsByTagName("td");
    let tr=document.getElementsByTagName("tr");
    let comentariosSubmitContainer=document.getElementById("comentarios-submit-container");
    let comentariosContainer=document.getElementsByClassName("comentario-container");
    let contenidoComentario=document.getElementsByClassName("contenido-comentario");

    if(!esDark){
        botonDark.innerText="Modo claro"
        esDark=true;
    }
    else{
        botonDark.innerText="Modo oscuro"
        esDark=false;
    }    

    //Modo oscuro
    if(webLogo!=null)
        webLogo.classList.toggle("dark");
    
    imprimirLogo.classList.toggle("dark");
    info.classList.toggle("dark");
    titulo.classList.toggle("dark");
    botonComprar.classList.toggle("dark");

    Array.from(table).forEach((aux)=>{
        aux.classList.toggle("dark");
    })

    Array.from(td).forEach((aux)=>{
        aux.classList.toggle("dark");
    })        

    Array.from(tr).forEach((aux)=>{
        aux.classList.toggle("dark");
    })             

    comentariosSubmitContainer.classList.toggle("dark");

    Array.from(comentariosContainer).forEach((aux)=>{
        aux.classList.toggle("dark");
    })        

    Array.from(contenidoComentario).forEach((aux)=>{
        aux.classList.toggle("dark");
    })             

    toggleDarkModePlantilla(esDark);
}

//Funcion que se llama desde un evento para expandir la seccion de comentarios
function expandirComentarios(){
    let desplegableComentarios=document.getElementById("comentarios-submit-container");

    seccionSoloComentarios.style.transition="0.5s"  //Se activa la animacion (hay que poner esto debido a que la animacion salta si se cambia el zoom)

    if(abrir){
        seccionSoloComentarios.style.left="0"
        desplegableComentarios.style.boxShadow="10px 0 10px rgba(0, 0, 0, 0.5)"
        abrir=false;
    }
    else{
        seccionSoloComentarios.style.left="calc(-1 * min(700px, 65vw))"
        desplegableComentarios.style.boxShadow=""
        abrir=true;
    }
}


let intervaloImagen;
function animacionImagen(indice){
    clearInterval(intervaloImagen);

    let contadorAnimacion=0;
    let incremento=0.02;

    intervaloImagen=setInterval(()=>{
        if(contadorAnimacion<1){
            contadorAnimacion+=incremento;
            imagenes[indice].style.opacity=contadorAnimacion;
        }
        else{
            clearInterval(intervaloImagen)
        }

    }, 24)
}

function accionarCarruselDerecha(){
    imagenes[contador].style.display="none";
    vistasPrevias[contador].style.border="";
    contador=(contador+1)%imagenes.length;

    imagenes[contador].style.display="grid";
    vistasPrevias[contador].style.border="solid 2px black";
    //Se realiza una animacion solo si hay mas de una imagen
    if(imagenes.length>1){
        imagenes[contador].style.opacity="0";
        animacionImagen(contador);
    }
}

function accionarCarruselIzquierda(){
    imagenes[contador].style.display="none";
    vistasPrevias[contador].style.border="";
    if(contador==0)
        contador=imagenes.length-1;
    else
        contador--;

    imagenes[contador].style.display="grid";
    vistasPrevias[contador].style.border="solid 2px black";

    //Se realiza una animacion solo si hay mas de una imagen
    if(imagenes.length>1){
        imagenes[contador].style.opacity="0";
        animacionImagen(contador);
    }
}


function cargarPalabrotas(){
    const peticion = new XMLHttpRequest();
    peticion.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          palabrotas=JSON.parse(this.responseText);
      }
    };
    peticion.open("GET", "palabrotas.php");
    peticion.send();    
}

//Funcion que comprueba palabrotas de un array de strings
function comprobarPalabrotas(){
    let texto=document.getElementById("comentario-nuevo");

    palabrotas.forEach(
        (aux)=>{       
            texto.value=texto.value.replace(new RegExp(aux, "ig"), "*".repeat(aux.length))
        }
    )
}

function bajarOpacidadTodo(){
    for(let i=0; i<imagenes.length; i++)
        imagenes[i].style.opacity="0";
}


//-------------------------------------------------------------------------------------------------------------
//ZONA "MAIN"
//Variables globales
let contador=0;
let abrir=true
let esDark=false;
let palabrotas=[];
let botonDark=document.getElementById("modo-oscuro");
let botonComentarios=document.getElementById("boton-comentario");
let botonComprar=document.getElementById("boton-comprar");
let botonSubmit=document.getElementById("submit")
let carruselAnterior=document.getElementById("anterior");
let carruselSiguiente=document.getElementById("siguiente");
let imagenes=document.getElementsByClassName("img-producto-container");
let seccionSoloComentarios=document.getElementById("desplegable");
let vistasPrevias=document.getElementsByClassName("img-previa");
let zonaTextoNuevoComentario=document.getElementById("comentario-nuevo");

imagenes[0].style.display="grid";
vistasPrevias[0].style.border="solid 2px black"

cargarPalabrotas();


//Declaracion de eventos
botonDark.addEventListener("click", toggleDarkMode);

if(botonSubmit!=null)
    botonSubmit.addEventListener("click", comprobarPalabrotas);

botonComentarios.addEventListener("click", expandirComentarios);

if(zonaTextoNuevoComentario!=null)
    zonaTextoNuevoComentario.addEventListener("keypress", comprobarPalabrotas)

seccionSoloComentarios.addEventListener("transitionend", ()=>{
    seccionSoloComentarios.style.transition="0s";
});

carruselAnterior.addEventListener("click", accionarCarruselIzquierda);
carruselSiguiente.addEventListener("click", accionarCarruselDerecha);

//Esto sirve para que la galeria de imagenes funcione
for(let i=0; i<vistasPrevias.length; i++){
    vistasPrevias[i].addEventListener("click", ()=>{
        if(contador!=i){
            vistasPrevias[contador].style.border="";
            imagenes[contador].style.display="none";
            contador=i;
            vistasPrevias[i].style.border="solid 2px black";
            bajarOpacidadTodo();
            imagenes[i].style.display="grid";
            animacionImagen(i);
        }
    })
}

botonComprar.addEventListener("click", ()=>alert("Gracias por su compra"));

function confirmacion(){
    return confirm("¿Está seguro que desea eliminar el contenido? Esta acción no se puede deshacer."); 
}