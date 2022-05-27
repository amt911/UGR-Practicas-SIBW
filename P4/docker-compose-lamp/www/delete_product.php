<?php
    //require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");

    session_start();

    $back="index.php";  //Fallback

    if(isset($_GET["back"]) and !empty($_GET["back"]))
        $back=$_GET["back"];

    $id=-1;     //Error por defecto

    if(isset($_GET["id"]) and !empty($_GET["id"]) and is_numeric($_GET["id"]))
        $id=$_GET["id"];
        
    $con=new GestorBD("root", "tiger");

    if(isset($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1){
        $con->deleteProducto($_SESSION["usuario"]["ID"], $id);
    }

    header("Location: $back");
    exit();
/*
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    echo $twig->render('delete_product.twig', []);    
*/
?>