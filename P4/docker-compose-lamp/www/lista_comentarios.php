<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");

    session_start();

    $con=new GestorBD();

    $menu=["Inicio" => "index.php"];

    $errores=array();

    $showForm=false;
    if(isset($_SESSION["usuario"]) and $_SESSION["usuario"]["esModerador"]==1){
        $showForm=true;

        //if($_SERVER["REQUEST_METHOD"]=="POST"){
        //    $res=$con->searchComentarios($_POST["keyword"]);
        //}

        $res=$con->getAllCommentsTodosProductos();
    }
    else{
        $errores[]="No tienes permisos para ver esta página";
    }

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    echo $twig->render("lista_comentarios.twig", [
        "NombreForm" => "Listado comentarios",
        "Menu" => $menu,
        "Errores" => $errores,
        "ShowForm" => $showForm,
        "Productos" => $res
    ]);    
?>