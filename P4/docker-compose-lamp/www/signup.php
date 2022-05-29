<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");

    $con=new GestorBD();
    $errores=array();

    $back="index.php";

    if(isset($_GET["back"]) and !empty($_GET["back"]))
        $back=$_GET["back"];

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

                //ARREGLAR ESTO
                if(in_array($extensionImagen, $extensionesPermitidas)){
                    if(!$con->estaRegistrado($correo)){
                        $con->registrarUsuario($correo, $contra, $nombre, $dir, $genero, $foto, $pais);
                        session_start();
                        $_SESSION["usuario"]=$con->getUsuarioFromCorreo($correo);
                        header("Location: $back");
                        exit();
                    }
                    $errores[]="El correo ya está registrado";
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

    //$_FILES["Foto"]["error"]!=4



    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    echo $twig->render('signup.twig', [
        "Errores" => $errores,
        "Back" => $back,
        "Titulo" => "Registro",
        "Header" => "Registro",
    ]);  
?>