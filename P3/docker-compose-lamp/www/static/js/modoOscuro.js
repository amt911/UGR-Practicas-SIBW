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
            //aux.style.backgroundColor="#2196f3";
            aux.classList.toggle("dark");
        });

        //header.style.backgroundColor="#1f1f1f";
        header.classList.toggle("dark");

        //main[0].style.backgroundColor="#111111";
        main[0].classList.toggle("dark");

        //body[0].style.color="white";
        //body[0].style.border="2px solid white";
        body[0].classList.toggle("dark");

        //contenido.style.backgroundColor="#303030";
        //contenido.style.borderBottom="solid 2px white";
        contenido.classList.toggle("dark");

        Array.from(notaContainer).forEach((aux)=>{
            //aux.style.backgroundColor="#2196f3"
            aux.classList.toggle("dark");
        })


        Array.from(notaContenido).forEach((aux)=>{
            //aux.style.backgroundColor="#0d47a1"
            aux.classList.toggle("dark");
        })        

        Array.from(li).forEach((aux)=>{
            //aux.style.borderBottom="solid 2px white";
            aux.classList.toggle("dark");
        })

        //html[0].style.backgroundColor="black";
        html[0].classList.toggle("dark");

        //divCopyright.style.borderTop="solid 2px white";
        divCopyright.classList.toggle("dark");

        Array.from(a).forEach((aux)=>{
            //aux.style.color="white";
            aux.classList.toggle("dark");
        })         
    }

    else{
        Array.from(botones).forEach((aux)=>{
            //aux.style.backgroundColor=""
            aux.classList.toggle("dark");
        });

        //header.style.backgroundColor="";   
        header.classList.toggle("dark");

        //main[0].style.backgroundColor="";     
        main[0].classList.toggle("dark");

        //body[0].style.color="";        
        //body[0].style.border="";  

        body[0].classList.toggle("dark");

        //contenido.style.backgroundColor="";
        //contenido.style.borderBottom="";  
        contenido.classList.toggle("dark");

        Array.from(notaContainer).forEach((aux)=>{
            //aux.style.backgroundColor=""
            aux.classList.toggle("dark");
        })     
        
        Array.from(notaContenido).forEach((aux)=>{
            //aux.style.backgroundColor=""
            aux.classList.toggle("dark");
        })         

        Array.from(li).forEach((aux)=>{
            //aux.style.borderBottom="";
            aux.classList.toggle("dark");
        })        

        //html[0].style.backgroundColor="";
        html[0].classList.toggle("dark");

        //divCopyright.style.borderTop="";
        divCopyright.classList.toggle("dark");

        Array.from(a).forEach((aux)=>{
            //aux.style.color="";
            aux.classList.toggle("dark");
        })         
    }
}