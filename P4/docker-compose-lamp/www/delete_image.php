<?php
    include("bd.php");
    
    session_start();
    $con=new GestorBD("super", "super");

    $back="index.php";
    if(isset($_GET["back"]) and !empty($_GET["back"])){
        $back=$_GET["back"];
    }


    if(isset($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1 and isset($_GET["id"]) and !empty($_GET["id"]) and $con->existeImagen($_GET["id"])){
        $con->deleteImage($_GET["id"]);

        header("Location: $back");
        exit();
    }
    else
        echo "No se encuentra identificado o no es un gestor";
?>