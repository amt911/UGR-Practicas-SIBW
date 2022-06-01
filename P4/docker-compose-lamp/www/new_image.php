<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");
    
    session_start();

    $error=array();
    $menu=array("Inicio"=>"index.php");

    $con=new GestorBD();


    $back="index.php";
    if(isset($_GET["back"]) and !empty($_GET["back"])){
        $back=$_GET["back"];
    }

    


    $showForm=false;
    if(isset($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1){
        $showForm=true;
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $back=$_POST["back"];

            if(empty($_FILES["imagenes"]["name"][0]) and count($_FILES["imagenes"]["name"])==1){
                $error[]="No se ha seleccionado ninguna imagen";
            }
            else{
                $extensionesPermitidas=array("jpeg", "jpg", "png");
                //$extensionImagen=strtolower(end(explode(".", $_FILES["Foto"]["name"])));
                $hayError=false;
                for($i=0; $i<count($_FILES["imagenes"]["name"]) and !$hayError; $i++){
                    $extensionImagen=strtolower(end(explode(".", $_FILES["imagenes"]["name"][$i])));
                    if(in_array($extensionImagen, $extensionesPermitidas, true) === false){
                        //$error[]="Extensión de imagen incorrecta.";
                        $hayError=true;
                    }
                }
                var_dump($_FILES);
                if(!$hayError){
                    $con->insertarImagenes($_SESSION["usuario"]["ID_Usuario"], $_POST["id"], $_FILES["imagenes"]);
                }
                else{
                    $error[]="Hay imagenes con extensiones incorrectas";
                }
            }
        }
    }
    else
        $error[]="No se encuentra identificado o no es un gestor";
    

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

echo $twig->render("new_image.twig", [
    "NombreForm" => "Añadir nuevas imágenes al producto",
    "Menu" => $menu,
    "Errores" => $error,    
    "ShowForm" => $showForm,
    "IDProd" => $idProd
]);
?>