/*
$(document).ready(function () {
    $("#buscar").on("keyup", function () {
        $.ajax({
            type: "get",
            url: "busqueda.php",
            data: {
                busqueda: $("#buscar").val()
            },
            beforeSend: function () {
                $("#resultados").html("");
            },
            success: function (data) {
                data = JSON.parse(data)
                console.log(data)

                for (let i = 0; i < data.length; i++) {
                    $("#resultados").append(
                        "<div><a href=\"producto.php?p=" + data[i].ID + "&query="+$("#buscar").val()+"\">" + ponerNegrita($("#buscar").val(), data[i].Nombre) + "</a></div>"
                    );
                }
            }
        });
    });
});

*/

document.getElementById("buscar").addEventListener("keyup", function () {
    fetch("busqueda.php?busqueda="+document.getElementById("buscar").value, {
        method: "GET"
    }).then(function(res){
        if(res.ok){
            res.json().then(function(data){
                document.getElementById("resultados").innerHTML = "";
                for (let i = 0; i < data.length; i++) {
                    document.getElementById("resultados").innerHTML +=
                        "<div><a href=\"producto.php?p=" + data[i].ID + "&query="+document.getElementById("buscar").value+"\">" + ponerNegrita(document.getElementById("buscar").value, data[i].Nombre) + "</a></div>";
                }                
            });
        }
        else{
            console.log("Error");
        }
    }).catch(err => console.log(err))
});


function ponerNegrita(usuarioBusqueda, textoOficial) {
    let res = textoOficial.slice();

    return res.replace(new RegExp(usuarioBusqueda, "ig"), (match) => {
        return "<strong>" + match + "</strong>";
    });
}