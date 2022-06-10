<?php
    include("bd.php");

    session_start();
    $con=new GestorBD(true);

    $back="index.php";  //Fallback
    if(isset($_GET["back"]) and !empty($_GET["back"]))
        $back=$_GET["back"];

    $id=-1;     //Error por defecto
    if(isset($_GET["id"]) and !empty($_GET["id"]) and is_numeric($_GET["id"]))
        $id=$_GET["id"];
        

    if(isset($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1){
        $con->deleteProducto($id);
    }

    header("Location: $back");
    exit();
?>