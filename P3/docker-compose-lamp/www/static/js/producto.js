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
    //alert("main: "+main);
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

let botonDark=document.getElementById("modo-oscuro");
botonDark.addEventListener("click", toggleDarkMode);


//Funciones
//Funcion que comprueba mediante expresiones regulares si el formato del email es correcto y si no esta vacio
function comprobarEmail(email){
    if(email!="" && email.search(/^([0-9a-z\.\_]+)+@{1}([0-9a-z]+\.)+[0-9a-z]+$/i)!=-1)
        return true

    else
        return false
}

//Funcion que devuelve la fecha actual en formato mas bonito
function obtenerFechaActual(){
    let fecha=new Date()
    let mesString;

    switch(fecha.getMonth()){
        case 0:
            mesString="enero"
            break;

        case 1:
            mesString="febrero"
            break;

        case 2:
            mesString="marzo"
            break;

        case 3:
            mesString="abril"
            break;          
            
        case 4:
            mesString="mayo"
            break;

        case 5:
            mesString="junio"
            break;

        case 6:
            mesString="julio"
            break;

        case 7:
            mesString="agosto"
            break;          
            
        case 8:
            mesString="septiembre"
            break;

        case 9:
            mesString="octubre"
            break;

        case 10:
            mesString="noviembre"
            break;

        case 11:
            mesString="diciembre"
            break;                          
    }

    return fecha.getDate()+" de "+mesString+" del "+fecha.getFullYear()+", "+fecha.getHours()+":"+fecha.getMinutes()
}

function subirOpacidad(elemento){
    let contador=0
    let incremento=0.02;
    let contadorTam=0.8;
    let incrementoTam=0.005;

    let interval=setInterval(()=>{
        if(contador<1 || contadorTam<1){
            if(contador<1){
                contador+=incremento
                elemento.style.opacity=contador
            }
            
            if(contadorTam<1){
                contadorTam+=incrementoTam
                elemento.style.transform="scale("+contadorTam+")"
            }
        }
        else{
            clearInterval(interval)
        }

    }, 24)
}
//-------------------------------------------------------------------------------------------------------------
//Funciones que se llaman desde eventos
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

//Funcion que sirve para añadir un nuevo comentario
function subirComentario(){
    let nombre=document.getElementById("nombre")
    let email=document.getElementById("email")
    let comentarioNuevo=document.getElementById("comentario-nuevo")
    let comentarios=document.getElementsByClassName("comentario-container")
    let submit=document.getElementById("submit-comentario");

    if(nombre.value!="" && comprobarEmail(email.value) && comentarioNuevo.value!=""){
        if(comentarios.length==0){
            document.getElementById("sin-comentarios").remove();
        }


        let template=document.createElement("div");
        template.setAttribute("class", "comentario-container");
        //Se inserta el nuevo comentario justo debajo del final de la caja para crear uno.
        //Aunque tambien se puede hacer cogiendo todos los comentarios y poniendolo antes de todos en el array
        comprobarPalabrotas();
        //IMPORTANTE: InnerHTML sirve para modificar solo lo de dentro del div en este caso, outerHTML es para todo el DOM
        template.innerHTML="<div class=\"nombre-comentario\">"+
                                "<h4>"+nombre.value+"</h4>"+
                            "</div>"+
                            "<div class=\"comentario-email\">"+
                                email.value+
                            "</div>"+
                            "<div class=\"fecha\">"+
                                obtenerFechaActual()+
                            "</div>"+
                            "<div class=\"contenido-comentario\">"+
                                comentarioNuevo.value+
                            "</div>";

        template.style.transform="scale(0.8)"
        template.style.opacity="0"

        if(esDark){
            template.style.backgroundColor="#4b830d";

            let contenidoComentario=template.getElementsByClassName("contenido-comentario");

            Array.from(contenidoComentario).forEach((aux)=>{
                aux.style.backgroundColor="#111111";
            })               
        }

        document.getElementById("comentarios-submit-container").insertBefore(template, submit.nextSibling)
        subirOpacidad(template)

        nombre.value=email.value=comentarioNuevo.value=""

    }
    else{
        alert("Uno o varios campos están vacíos o son inválidos")
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

let contador=0;
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


//https://www.w3schools.com/js/js_ajax_http.asp
let palabrotas=[];
function cargarPalabrotas(){
    //alert("He entrado")
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
let botonComentarios=document.getElementById("boton-comentario");
let zonaTextoNuevoComentario=document.getElementById("comentario-nuevo");
let abrir=true
let botonSubmit=document.getElementById("submit")
let seccionSoloComentarios=document.getElementById("desplegable");
let carruselAnterior=document.getElementById("anterior");
let carruselSiguiente=document.getElementById("siguiente");
let imagenes=document.getElementsByClassName("img-producto");


imagenes[0].style.display="grid";
cargarPalabrotas();

let esDark=false;

//Declaracion de eventos
botonSubmit.addEventListener("click", subirComentario);
botonComentarios.addEventListener("click", expandirComentarios);
zonaTextoNuevoComentario.addEventListener("keypress", comprobarPalabrotas)
seccionSoloComentarios.addEventListener("transitionend", ()=>{
    seccionSoloComentarios.style.transition="0s";
})
carruselAnterior.addEventListener("click", accionarCarruselIzquierda);
carruselSiguiente.addEventListener("click", accionarCarruselDerecha);

let vistasPrevias=document.getElementsByClassName("img-previa");
vistasPrevias[0].style.border="solid 2px black"

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

let botonComprar=document.getElementById("boton-comprar");
botonComprar.addEventListener("click", ()=>alert("Gracias por su compra"));