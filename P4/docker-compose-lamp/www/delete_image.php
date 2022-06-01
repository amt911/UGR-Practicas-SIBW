<?php
    include("bd.php");

    session_start();

    $back="index.php";
    if(isset($_GET["back"]) and !empty($_GET["back"])){
        $back=$_GET["back"];
    }

    $con=new GestorBD("root", "tiger");

    if(isset($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1 and isset($_GET["id"]) and !empty($_GET["id"]) and $con->existeImagen($_GET["id"])){
        $con->deleteImage($_GET["id"]);

        //var_dump($back);

        header("Location: $back");
        exit();
    }
    else
        echo "No se encuentra identificado o no es un gestor";
?>