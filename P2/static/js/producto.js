

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



//Ahora viene la parte de meter el comentario :(

//var comentarios=document.getElementById("comentarios")

function subirComentario(){
    var nombre=document.getElementById("nombre")
    var email=document.getElementById("email")
    //var comentario=document.getElementById("comentario-nuevo")
    var comentarios=document.getElementsByClassName("comentario-container")
    var fecha=new Date();

    alert(comentarios.length)

    //ARREGLAR ESTO QUE CREO QUE ESTA MAL
    comentarios[0].insertAdjacentHTML("afterbegin", 
    "<div class=\"comentario-container\">"+
        "<div class=\"nombre-comentario\">"+
            "<h4>"+nombre.value+"</h4>"+
        "</div>"+
        "<div class=\"fecha\">"+
            fecha.getDay()+"-"+fecha.getMonth()+"-"+fecha.getFullYear()+" "+fecha.getHours()+":"+fecha.getMinutes()+
        "</div>"+
        "<div class=\"contenido-comentario\">"+
            nombre.value+
        "</div>"+
    "</div>")
}


var botonSubmit=document.getElementById("submit")

botonSubmit.addEventListener("click", subirComentario);