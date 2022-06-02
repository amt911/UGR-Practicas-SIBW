<?php
require_once "/usr/local/lib/php/vendor/autoload.php";
include("bd.php");

session_start();

$con=new GestorBD();

$menu=array("Inicio"=>"index.php");

//Parte de GET
$error=array();
if(isset($_SESSION["usuario"])){
    $estaRegistrado=true;
}
else{
    $error[]="No se encuentra identificado";
    $estaRegistrado=false;
}

if(isset($_GET["campo"]) and !empty($_GET["campo"]) and is_numeric($_GET["campo"]) and $_GET["campo"]>=1 and $_GET["campo"]<=7){
    $tipo=$_GET["campo"];
}
else{
    $tipo=-1;
    $error[]="Campo a modificar invalido";
}

//Parte de POST
if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_SESSION["usuario"])){
    $operacion=[
        1 => "Foto",
        2 => "Nombre",
        3 => "Correo",
        4 => "CountryCode",
        5 => "Genero",
        6 => "Direccion",
        7 => "Password"
    ];

    if($_POST["tipo"]>=2 and $_POST["tipo"]<=6 and $_POST["tipo"]!=3){
        if(!empty($_POST[$operacion[$_POST["tipo"]]]) and !empty($_POST[$operacion[$_POST["tipo"]]])){
            $con->cambiarDatosUsuario($_SESSION["usuario"]["ID"], $_POST[$operacion[$_POST["tipo"]]], $operacion[$_POST["tipo"]]);
            $_SESSION["usuario"]=$con->getUsuario2($_SESSION["usuario"]["ID"], "ID");

            header("Location: perfil.php");
            exit();            
        }
        else{
            $error[]="El campo no puede estar vacío";
        } 
    }
    
    else if($_POST["tipo"]==7){
        if(isset($_POST["Password"]) and isset($_POST["Password-confirm"]) and !empty($_POST["Password"]) and !empty($_POST["Password-confirm"]) and $_POST["Password"]===$_POST["Password-confirm"]){
            $con->cambiarDatosUsuario($_SESSION["usuario"]["ID"], $_POST["Password"], "Password");

            header("Location: destruir_cookies.php");
            exit();            
        }
        elseif(isset($_POST["Password"]) and isset($_POST["Password-confirm"]) and !empty($_POST["Password"]) and !empty($_POST["Password-confirm"]) and $_POST["Password"]!==$_POST["Password-confirm"]){
            $error[]="Las contraseñas no coinciden";
        }
        else{
            $error[]="Los campos no pueden estar vacíos";
        }                
    }
    else if($_POST["tipo"]==3){
        if(!empty($_POST[$operacion[$_POST["tipo"]]]) and !empty($_POST[$operacion[$_POST["tipo"]]])){
            if(!$con->existeUsuarioCorreo($_POST[$operacion[$_POST["tipo"]]])){
                $con->cambiarDatosUsuario($_SESSION["usuario"]["ID"], $_POST[$operacion[$_POST["tipo"]]], $operacion[$_POST["tipo"]]);
                $_SESSION["usuario"]=$con->getUsuario2($_SESSION["usuario"]["ID"], "ID");

                header("Location: perfil.php");
                exit();            
            }
            else{
                if($_SESSION["usuario"]["Correo"]===$_POST[$operacion[$_POST["tipo"]]]){
                    $error[]="El correo es el mismo";
                }
                else{
                    $error[]="El correo ya está en uso";
                }
            }
        }
        else{
            $error[]="Los campos no pueden estar vacíos";
        }                
    }
    else {
        if(isset($_FILES["Foto"]) and $_FILES["Foto"]["error"]!=4){
            $hayError=false;
            $extensionesPermitidas=array("jpeg", "jpg", "png");
            $extensionImagen=strtolower(end(explode(".", $_FILES["Foto"]["name"])));

            if(in_array($extensionImagen, $extensionesPermitidas, true) === false){
                $error[]="Extensión de imagen incorrecta.";
                $hayError=true;
            }

            if($_FILES["Foto"]["size"] > 2097152){
                $error[]="La imagen es demasiado grande";
                $hayError=true;
            }

            if(!$hayError){
                $con->actualizarFotoPerfil($_SESSION["usuario"]["ID"], $_FILES["Foto"]);
                $_SESSION["usuario"]=$con->getUsuario2($_SESSION["usuario"]["ID"], "ID");
                
                header("Location: perfil.php");
                exit();
            }
        }
        else{
            $error[]="No se ha adjuntado ninguna imagen";
        }
    }
}

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
echo $twig->render("edit_perfil.twig", [
    "NombreForm" => "Cambiar datos de perfil",
    "Menu" => $menu,
    "Errores" => $error,
    "Tipo" => $tipo,
    "estaRegistrado" => $estaRegistrado,
    "Paises" => $con->getAllPaises(),
    "Titulo" => "Cambiar datos de perfil",
]);
?>