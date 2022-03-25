

var desplegableComentarios=document.getElementById("comentarios");

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

