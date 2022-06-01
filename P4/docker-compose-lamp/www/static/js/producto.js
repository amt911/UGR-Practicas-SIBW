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

    //pasar a un map si da tiempo
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

    let dia=(fecha.getDate()<10)?"0"+fecha.getDate(): fecha.getDate();
    let minutos=(fecha.getMinutes()<10)?"0"+fecha.getMinutes(): fecha.getMinutes();
    let horas=(fecha.getHours()<10)?"0"+fecha.getHours():fecha.getHours();

    return dia+" de "+mesString+" del "+fecha.getFullYear()+", "+horas+":"+minutos
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
    //let nombre=document.getElementById("nombre")
    //let email=document.getElementById("email")
    let comentarioNuevo=document.getElementById("comentario-nuevo")
    let comentarios=document.getElementsByClassName("comentario-container")
    let submit=document.getElementById("submit-comentario");

    //if(/*nombre.value!="" &&*/ comprobarEmail(email.value) /*&& comentarioNuevo.value!=""*/){
        /*
        if(comentarios.length==0){
            document.getElementById("sin-comentarios").remove();
        }

        let nombre={value: "prueba"};
        let email={value: "otro"};
*/
        //let template=document.createElement("div");
        //template.setAttribute("class", "comentario-container");
        //Se inserta el nuevo comentario justo debajo del final de la caja para crear uno.
        //Aunque tambien se puede hacer cogiendo todos los comentarios y poniendolo antes de todos en el array
        comprobarPalabrotas();
        //IMPORTANTE: InnerHTML sirve para modificar solo lo de dentro del div en este caso, outerHTML es para todo el DOM
        /*template.innerHTML="<div class=\"nombre-comentario\">"+
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
            template.classList.toggle("dark");

            let contenidoComentario=template.getElementsByClassName("contenido-comentario");

            Array.from(contenidoComentario).forEach((aux)=>{
                aux.classList.toggle("dark");
            })               
        }

        document.getElementById("comentarios-submit-container").insertBefore(template, submit.nextSibling)
        subirOpacidad(template)

        nombre.value=email.value=comentarioNuevo.value=""*/

    /*}
    else{
        alert("Uno o varios campos están vacíos o son inválidos")
    }*/
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
    botonSubmit.addEventListener("click", subirComentario);

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

//let botonesBorrar=document.getElementsByClassName("ref-borrar");

//mejorable
function confirmacion(){
    return confirm("¿Está seguro que desea eliminar el comentario? Esta acción no se puede deshacer."); 
}
/*
for(let i=0; i<botonesBorrar.length; i++){
    botonesBorrar[i].addEventListener("click", ()=>{
        return confirm("¿Está seguro que desea eliminar el comentario? Esta acción no se puede deshacer."); 
    });

}
*/