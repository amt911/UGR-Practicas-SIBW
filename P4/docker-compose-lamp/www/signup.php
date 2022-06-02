<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");

    session_start();

    $con=new GestorBD();
    $errores=array();

    $back="index.php";

    if(isset($_GET["back"]) and !empty($_GET["back"]))
        $back=$_GET["back"];

    $sesionIniciada=false;
    if(isset($_SESSION["usuario"]) and !empty($_SESSION["usuario"])){
        $sesionIniciada=true;
        $errores[]="El usuario ya ha iniciado sesión";
    }

    function comprobarCorreo($correo){
        if(preg_match("/^([0-9a-z\.\_]+)+@{1}([0-9a-z]+\.)+[0-9a-z]+$/i",$correo)===1)
            return true;
        else
            return false;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //Si ningun campo esta vacio, se registra
        if(!empty($_POST["correo"]) and !empty($_POST["contra"]) and !empty($_POST["contra-confirma"]) and !empty($_POST["nombre"]) and !empty($_POST["direccion"])){
            $nombre=$_POST["nombre"];
            $correo=$_POST["correo"];
            $contra=$_POST["contra"];
            $contra2=$_POST["contra-confirma"];
            $back=$_POST["anterior"];
            $dir=$_POST["direccion"];
            $genero=$_POST["genero"];
            $foto=$_FILES["foto"];
            $pais=$_POST["pais"];
            //var_dump($foto);
            if($contra==$contra2){
                $extensionesPermitidas=array("jpeg", "jpg", "png");
                $extensionImagen=strtolower(end(explode(".", $_FILES["foto"]["name"])));                
                $hayFoto=true;

                if($foto["error"]==4){
                    $hayFoto=false;
                }

                //ARREGLAR ESTO
                if(!$hayFoto or in_array($extensionImagen, $extensionesPermitidas)){
                    if(comprobarCorreo($correo)){
                        if(!$con->estaRegistrado($correo)){
                            $con->registrarUsuario($correo, $contra, $nombre, $dir, $genero, $foto, $pais);
                            $_SESSION["usuario"]=$con->getUsuario2($correo, "Correo");
                            header("Location: $back");
                            exit();
                        }
                        $errores[]="El correo ya está registrado";
                    }
                    else
                        $errores[]="El correo no es válido (no tiene un formato correcto)";
                }
                else{
                    $errores[]="La extensión de la imagen no es válida";
                }
            }
            else
                $errores[]="Las contraseñas no coinciden";
        }
        else
            $errores[]="No puede haber campos vacíos";
    }

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    echo $twig->render('signup.twig', [
        "Errores" => $errores,
        "Back" => $back,
        "Titulo" => "Registro",
        "Header" => "Registro",
        "Paises" => $con->getAllPaises(),
        "SesionIniciada" => $sesionIniciada
    ]);  
?>