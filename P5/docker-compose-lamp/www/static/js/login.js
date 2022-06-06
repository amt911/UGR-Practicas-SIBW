document.getElementById("toggle-contra").addEventListener("click", ()=>{
    let input = document.getElementById("contra-input");
    
    if (input.type === "password") {
        input.type = "text";
    }
    else {
        input.type = "password";
    }
})