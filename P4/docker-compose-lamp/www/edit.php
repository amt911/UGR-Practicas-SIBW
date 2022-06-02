<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");

    session_start();

    $con=new GestorBD("root", "tiger");

    $backID="index.php";      //Fallback
    if(isset($_GET["back"]) and !empty($_GET["back"]))
        $backID=$_GET["back"];
    
    $error=-1;
    $idComentario=-1;
    if(isset($_GET["id"]) and !empty($_GET["id"]) and is_numeric($_GET["id"]) and $con->existeComentario($_GET["id"])){
        $idComentario=$_GET["id"];
        $error=0;
    }


    $comentario="";

    if(isset($_SESSION["usuario"]) and $_SESSION["usuario"]["esModerador"]==1){
        $usuario=$_SESSION["usuario"];

        $comentario=$con->getComentario($idComentario);
    }
    else{
        $error=-2;
    }

    //Parte de post
    if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_SESSION["usuario"]) and $_SESSION["usuario"]["esModerador"]==1){
        $con->changeComentario($_SESSION["usuario"]["ID"], $_POST["idComentario"], $_POST["comentario"]);

        $backProduct=$_POST["back"];
        header("Location: $backProduct");
        exit();
    }

    $menu=["Inicio" => "index.php"];

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    echo $twig->render('editar_comentario.twig', [
        "NombreForm" => "Editar comentario",
        "Menu" => $menu,
        "BackID" => $backID,
        "Comentario" => $comentario,
        "ErrorStatus" => $error,
        "idComentario" => $idComentario,
        "Titulo" => "Editar comentario",
    ]);

?>