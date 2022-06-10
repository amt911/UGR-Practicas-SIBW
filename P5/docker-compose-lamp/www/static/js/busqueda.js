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
                console.log($("#buscar").val())
                //if($("#buscar").val() != ""){
                    data = JSON.parse(data)
                    console.log(data)
                //console.log(data.length)
                for (let i = 0; i < data.length; i++) {
                    $("#resultados").append(
                        "<div><a href=\"producto.php?p=" + data[i].ID + "\">" + ponerNegrita($("#buscar").val(), data[i].Nombre) + "</a></div>"
                    );
                }
            }
        });
    });
});

function ponerNegrita(usuarioBusqueda, textoOficial){
    let res=textoOficial.slice();

    return res.replace(new RegExp(usuarioBusqueda, "ig"), (match) => {
        return "<strong>" + match + "</strong>";
    });
}