var contrasena = document.getElementById("mostrar");

function verpassword(){
    var tipo = document.getElementById("txtcontrasena");
    if(tipo.type == "password"){
        tipo.type = "text";
    }else{
        tipo.type = "password";
    }
}

contrasena.addEventListener("click", verpassword);

