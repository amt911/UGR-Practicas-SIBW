//Variables globales
var botonComentarios=document.getElementById("boton-comentario");
var zonaTextoNuevoComentario=document.getElementById("comentario-nuevo");
var abrir=true
var botonSubmit=document.getElementById("submit")

//Funciones
//Funcion que comprueba mediante expresiones regulares si el formato del email es correcto y si no esta vacio
function comprobarEmail(email){
    if(email!="" && email.search(/^([0-9a-z]+(\.)?)+@{1}([0-9a-z]+\.)+[0-9a-z]+$/i)!=-1)
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



//Funciones que se llaman desde eventos
//Funcion que se llama desde un evento para expandir la seccion de comentarios
function expandirComentarios(){
    var desplegableComentarios=document.getElementById("comentarios-submit-container");
    var seccionSoloComentarios=document.getElementById("desplegable");

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
    var zonaAInsertar=document.getElementById("submit-comentario")

    if(nombre.value!="" && comprobarEmail(email.value) && comentarioNuevo.value!=""){
        //Se inserta el nuevo comentario justo debajo del final de la caja para crear uno.
        //Aunque tambien se puede hacer cogiendo todos los comentarios y poniendolo antes de todos en el array

        zonaAInsertar.insertAdjacentHTML("afterend", 
        "<div class=\"comentario-container\">"+
            "<div class=\"nombre-comentario\">"+
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
            "</div>"+
        "</div>")

        nombre.value=email.value=comentarioNuevo.value=""

    }
    else{
        alert("Uno o varios campos están vacíos o son inválidos")
    }
}

//Funcion que comprueba palabrotas de un array de strings
function comprobarPalabrotas(){
    var texto=document.getElementById("comentario-nuevo");
    //Version family-friendly
    //var palabrotas=["palabrota", "palabro", "imbecil", "terrible", "caca", "patada", "blanco", "pruebame"]

    //Version realista
    var palabrotas=["caca", "cerd", "payas", "put", "marran", "cojon", "poll", "imbecil", "gilipollas", "cabron"]    

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