function toggleDarkModePlantilla(esOscuro){
    let botones=document.getElementsByClassName("menu");
    let header=document.getElementById("cabecera");
    let main=document.getElementsByTagName("main");
    let body=document.getElementsByTagName("body");
    let contenido=document.getElementById("contenido");
    let notaContainer=document.getElementsByClassName("nota-container");
    let notaContenido=document.getElementsByClassName("nota-contenido");
    
    let a=document.getElementsByTagName("a");
    let li=document.getElementsByClassName("nota-li");
    let html=document.getElementsByTagName("html");    
    let divCopyright=document.getElementById("div-copyright");    

    if(esOscuro){
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

        Array.from(a).forEach((aux)=>{
            aux.style.color="white";
        })         
    }

    else{
        Array.from(botones).forEach((aux)=>{
            aux.style.backgroundColor=""
        });

        header.style.backgroundColor="";   

        main[0].style.backgroundColor="";     

        body[0].style.color="";        
        body[0].style.border="";  

        contenido.style.backgroundColor="";
        contenido.style.borderBottom="";  

        Array.from(notaContainer).forEach((aux)=>{
            aux.style.backgroundColor=""
        })     
        
        Array.from(notaContenido).forEach((aux)=>{
            aux.style.backgroundColor=""
        })         

        Array.from(li).forEach((aux)=>{
            aux.style.borderBottom="";
        })        

        html[0].style.backgroundColor="";
        divCopyright.style.borderTop="";

        Array.from(a).forEach((aux)=>{
            aux.style.color="";
        })         
    }
}