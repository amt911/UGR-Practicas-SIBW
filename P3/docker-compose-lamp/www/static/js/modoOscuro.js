export function toggleDarkModePlantilla(esOscuro){
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