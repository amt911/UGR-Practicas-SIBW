let IDs = document.getElementsByClassName("id-prod");
let sets = document.getElementsByClassName("set");
let botones = document.getElementsByClassName("borrador-boton");

for (let i = 0; i < botones.length; i++) {
    botones[i].addEventListener("click", function(){
        let form=new FormData();
        form.set("id", IDs[i].value);
        form.set("set", sets[i].value);

        fetch("publicar_producto.php", {
            method: "POST",
            body: form,
        }).then(res => res.json())
        .catch(err => console.log(err))
        .then(res => {
            if(res.status==true){
                sets[i].value=(sets[i].value==1)?0:1;
                botones[i].innerHTML=(sets[i].value==1)?"PUBLICAR PRODUCTO":"DESCATALOGAR PRODUCTO";
                botones[i].classList.toggle("editar-prod");
                botones[i].classList.toggle("delete-prod");
            }
        });
    });
}