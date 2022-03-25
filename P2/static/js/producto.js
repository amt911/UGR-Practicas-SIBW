

var desplegableComentarios=document.getElementById("comentarios");

var botonComentarios=document.getElementById("boton-comentario");


function expandirComentarios(){
    desplegableComentarios.style.width="200px"
}

botonComentarios.addEventListener("click", expandirComentarios);

