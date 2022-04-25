//Variables globales
var botonComentarios=document.getElementById("boton-comentario");
var zonaTextoNuevoComentario=document.getElementById("comentario-nuevo");
var abrir=true
var botonSubmit=document.getElementById("submit")
var seccionSoloComentarios=document.getElementById("desplegable");
var carruselAnterior=document.getElementById("anterior");
var carruselSiguiente=document.getElementById("siguiente");
var imagenes=document.getElementsByClassName("img-producto");


//???MEJORABLE PREGUNTAR AL PROFESOR
imagenes[0].style.display="grid";
cargarPalabrotas();

var esDark=false;
function toggleDarkMode(){
    var botones=document.getElementsByClassName("menu");
    var header=document.getElementById("cabecera");
    var main=document.getElementsByTagName("main");
    var body=document.getElementsByTagName("body");
    var contenido=document.getElementById("contenido");
    var notaContainer=document.getElementsByClassName("nota-container");
    var notaContenido=document.getElementsByClassName("nota-contenido");
    
    var a=document.getElementsByTagName("a");
    var li=document.getElementsByTagName("li");
    var html=document.getElementsByTagName("html");    
    var divCopyright=document.getElementById("div-copyright");


    //Variables especiales de producto
    var imprimirLogo=document.getElementById("imprimir-logo");
    var info=document.getElementById("info");
    var titulo=document.getElementById("titulo");
    var botonComprar=document.getElementById("boton-comprar");
    var table=document.getElementsByTagName("table");
    var td=document.getElementsByTagName("td");
    var tr=document.getElementsByTagName("tr");
    var comentariosSubmitContainer=document.getElementById("comentarios-submit-container");
    var comentariosContainer=document.getElementsByClassName("comentario-container");
    var contenidoComentario=document.getElementsByClassName("contenido-comentario");
    //alert("main: "+main);
    if(!esDark){
        esDark=true;
        //Modo oscuro

        Array.from(botones).forEach((aux)=>{
            aux.style.backgroundColor="#2196f3";
        });

        header.style.backgroundColor="#1f1f1f";

        main[0].style.backgroundColor="#111111";

        body[0].style.color="white";
        body[0].style.border="2px solid white";
        //Array.from(underline).forEach((aux)=>{
        //    aux.style.color="white";
        //})

        contenido.style.backgroundColor="#303030";
        contenido.style.borderBottom="solid 2px white";

        Array.from(notaContainer).forEach((aux)=>{
            aux.style.backgroundColor="#2196f3"
        })


        Array.from(notaContenido).forEach((aux)=>{
            aux.style.backgroundColor="#0d47a1"
        })        

        Array.from(li).forEach((aux)=>{
            aux.style.borderBottom="solid 2px white";
        })

        html[0].style.backgroundColor="black";
        divCopyright.style.borderTop="solid 2px white";

        //PARTES ESPECIALES PARA PRODUCTO
        imprimirLogo.style.filter="invert(100%)";
        info.style.backgroundColor="#0d47a1";
        titulo.style.backgroundColor="#2196f3";
        botonComprar.style.backgroundColor="#008040";


        Array.from(table).forEach((aux)=>{
            aux.style.border="solid 1px white";
        })

        Array.from(td).forEach((aux)=>{
            aux.style.border="solid 1px white";
        })        

        Array.from(tr).forEach((aux)=>{
            aux.style.border="solid 1px white";
        })   
        
        Array.from(a).forEach((aux)=>{
            aux.style.color="white";
        })           

        comentariosSubmitContainer.style.backgroundColor="#1f1f1f";        

        Array.from(comentariosContainer).forEach((aux)=>{
            aux.style.backgroundColor="#33691e";
        })        

        Array.from(contenidoComentario).forEach((aux)=>{
            aux.style.backgroundColor="#111111";
        })        
        
    }
    else{
        esDark=false;
        //Modo claro
        Array.from(botones).forEach((aux)=>{
            aux.style.backgroundColor="#cddc39"
        });

        header.style.backgroundColor="#009688";   

        main[0].style.backgroundColor="beige";     

        body[0].style.color="black";        
        body[0].style.border="2px solid #00897b";
        //Array.from(underline).forEach((aux)=>{
        //    aux.style.color="black";
        //})        

        contenido.style.backgroundColor="#00897b";
        contenido.style.borderBottom="solid 2px #00897b";  

        Array.from(notaContainer).forEach((aux)=>{
            aux.style.backgroundColor="#cddc39"
        })     
        
        Array.from(notaContenido).forEach((aux)=>{
            aux.style.backgroundColor="#c0ca33"
        })         

        Array.from(li).forEach((aux)=>{
            aux.style.borderBottom="solid 2px black";
        })        

        html[0].style.backgroundColor="";
        divCopyright.style.borderTop="solid 2px #00897b";

        //PARTES ESPECIALES PARA PRODUCTO
        imprimirLogo.style.filter="";        
        info.style.backgroundColor="#c0ca33";
        titulo.style.backgroundColor="#cddc39";
        botonComprar.style.backgroundColor="green";

        Array.from(table).forEach((aux)=>{
            aux.style.border="solid 1px black";
        })

        Array.from(td).forEach((aux)=>{
            aux.style.border="solid 1px black";
        })        

        Array.from(tr).forEach((aux)=>{
            aux.style.border="solid 1px black";
        })           
        
        Array.from(a).forEach((aux)=>{
            aux.style.color="black";
        })                   

        comentariosSubmitContainer.style.backgroundColor="beige";        

        Array.from(comentariosContainer).forEach((aux)=>{
            aux.style.backgroundColor="#d9ead2";
        })   
        
        Array.from(contenidoComentario).forEach((aux)=>{
            aux.style.backgroundColor="white";
        })                
    }
}

var botonDark=document.getElementById("modo-oscuro");
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
    var fecha=new Date()
    var mesString;

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
    var contador=0
    var incremento=0.02;
    var contadorTam=0.8;
    var incrementoTam=0.005;

    var interval=setInterval(()=>{
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

//Funciones que se llaman desde eventos
//Funcion que se llama desde un evento para expandir la seccion de comentarios
function expandirComentarios(){
    var desplegableComentarios=document.getElementById("comentarios-submit-container");

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
    var nombre=document.getElementById("nombre")
    var email=document.getElementById("email")
    var comentarioNuevo=document.getElementById("comentario-nuevo")
    var comentarios=document.getElementsByClassName("comentario-container")
    var template=comentarios[0].cloneNode(true)


    if(nombre.value!="" && comprobarEmail(email.value) && comentarioNuevo.value!=""){
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
        document.getElementById("comentarios-submit-container").insertBefore(template, comentarios[0])
        subirOpacidad(template)

        nombre.value=email.value=comentarioNuevo.value=""

    }
    else{
        alert("Uno o varios campos están vacíos o son inválidos")
    }
}



var intervaloImagen;
function animacionImagen(indice){
    clearInterval(intervaloImagen);

    var contadorAnimacion=0;
    var incremento=0.02;

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

var contador=0;
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


//COMPROBAR QUE PUEDE ESTAR MAL, PREGUNTAR AL PROFESOR
//https://www.w3schools.com/js/js_ajax_http.asp
var palabrotas=[];
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
    var texto=document.getElementById("comentario-nuevo");

    palabrotas.forEach(
        (aux)=>{       
            texto.value=texto.value.replace(new RegExp(aux, "ig"), "*".repeat(aux.length))
        }
    )
}

//Declaracion de eventos
botonSubmit.addEventListener("click", subirComentario);
botonComentarios.addEventListener("click", expandirComentarios);
zonaTextoNuevoComentario.addEventListener("keypress", comprobarPalabrotas)
seccionSoloComentarios.addEventListener("transitionend", ()=>{
    seccionSoloComentarios.style.transition="0s";
})
carruselAnterior.addEventListener("click", accionarCarruselIzquierda);
carruselSiguiente.addEventListener("click", accionarCarruselDerecha);

var vistasPrevias=document.getElementsByClassName("img-previa");
vistasPrevias[0].style.border="solid 2px black"

function bajarOpacidadTodo(){
    for(let i=0; i<imagenes.length; i++)
        imagenes[i].style.opacity="0";
}

//Preguntar por que funciona esto con let y no con var
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


var botonComprar=document.getElementById("boton-comprar");


botonComprar.addEventListener("click", ()=>alert("Gracias por su compra"));