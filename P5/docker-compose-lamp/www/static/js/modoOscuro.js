function toggleDarkModePlantilla(){
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

    Array.from(botones).forEach((aux)=>{
        aux.classList.toggle("dark");
    });

    header.classList.toggle("dark");
    main[0].classList.toggle("dark");

    body[0].classList.toggle("dark");

    contenido.classList.toggle("dark");

    Array.from(notaContainer).forEach((aux)=>{
        aux.classList.toggle("dark");
    })     
    
    Array.from(notaContenido).forEach((aux)=>{
        aux.classList.toggle("dark");
    })         

    Array.from(li).forEach((aux)=>{
        aux.classList.toggle("dark");
    })        

    html[0].classList.toggle("dark");
    divCopyright.classList.toggle("dark");

    Array.from(a).forEach((aux)=>{
        aux.classList.toggle("dark");
    })         
}