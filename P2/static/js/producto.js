

var desplegableComentarios=document.getElementById("comentarios-submit-container");

var botonComentarios=document.getElementById("boton-comentario");

var abrir=true

function expandirComentarios(){
    if(abrir){
        desplegableComentarios.style.width="65vw"
        abrir=false;
    }
    else{
        desplegableComentarios.style.width="0px"
        abrir=true;
    }
}

botonComentarios.addEventListener("click", expandirComentarios);

//Version family-friendly
//var palabrotas=["palabrota", "palabro", "imbecil", "terrible", "caca", "patada", "blanco", "pruebame"]

//Version realista
var palabrotas=["payas", "put", "marran", "cojon", "poll", "imbecil", "gilipollas", "cabron"]

var barraComentarioNuevo=document.getElementById("comentario-nuevo");
barraComentarioNuevo.addEventListener("keypress", comprobarPalabrotas)

function comprobarPalabrotas(){
    var texto=document.getElementById("comentario-nuevo");

    palabrotas.forEach(
        (aux)=>{
            
            texto.value=texto.value.replace(new RegExp(aux, "ig"), "*".repeat(aux.length))
        }
    )
    //alert(texto)
    //texto.replace()
}

function comprobarEmail(email){
    if(email!="" && email.search(/^([0-9a-z]+(\.)?)+@{1}([0-9a-z]+\.)+[0-9a-z]+$/i)!=-1)
        return true

    else
        return false
}


function subirComentario(){
    var nombre=document.getElementById("nombre")
    var email=document.getElementById("email")
    var comentario=document.getElementById("comentario-nuevo")
    var comentariosContainer=document.getElementById("comentarios")
    var fecha=new Date()

    if(nombre.value!="" && comprobarEmail(email.value) && comentario!=""){
        //Se inserta el nuevo comentario justo debajo del contenedor con todos los comentarios haciendo que sea el primero de todos
        comentariosContainer.insertAdjacentHTML("afterbegin", 
        "<div class=\"comentario-container\">"+
            "<div class=\"nombre-comentario\">"+
                "<h4>"+nombre.value+"</h4>"+
            "</div>"+
            "<div class=\"comentario-email\">"+
            email.value+
            "</div>"+
            "<div class=\"fecha\">"+
                fecha.getDay()+"-"+fecha.getMonth()+"-"+fecha.getFullYear()+" "+fecha.getHours()+":"+fecha.getMinutes()+
            "</div>"+
            "<div class=\"contenido-comentario\">"+
                comentario.value+
            "</div>"+
        "</div>")
    }
    else{
        alert("Uno o varios campos están vacíos o son inválidos")
    }
}


var botonSubmit=document.getElementById("submit")

botonSubmit.addEventListener("click", subirComentario);