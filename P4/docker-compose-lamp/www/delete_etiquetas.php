<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");
    
    session_start();

    $con=new GestorBD("root", "tiger");
    
    $menu=array("Inicio"=>"index.php");
    $error=array();



    $back="index.php";
    if(isset($_GET["back"]) and !empty($_GET["back"])){
        $back=$_GET["back"];
    }

    $id=-1;

    if(isset($_GET["id"]) and !empty($_GET["id"])){
        $id=$_GET["id"];
    }

    $showForm=false;
    $etiquetas=array();
    if(isset($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1){
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $back=$_POST["back"];
            $id=$_POST["id"];
            $etiquetas=$con->getEtiquetas($id);

            //var_dump($_POST, $etiquetas, $id);

            for($i=0; $i<count($etiquetas); $i++){
                if(isset($_POST["etiqueta_".$etiquetas[$i]["Nombre"]]) and !empty($_POST["etiqueta_".$etiquetas[$i]["Nombre"]]) and $_POST["etiqueta_".$etiquetas[$i]["Nombre"]]=="on"){
                    $con->deleteEtiqueta($_SESSION["usuario"]["ID"], $id, $etiquetas[$i]["Nombre"]);
                }       
            }

            header("Location: $back");
            exit();
        }

        //Parte de get
        if($con->existeProducto($id)){
            $showForm=true;
            $etiquetas=$con->getEtiquetas($id);
            //var_dump($etiquetas);
        }
        else
            $error[]="No existe el producto";
    }
    else
        $error[]="No se encuentra identificado o no es un gestor";
    

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

echo $twig->render("delete_etiquetas.twig", [
    "NombreForm" => "Eliminar etiquetas del producto",
    "Menu" => $menu,
    "Errores" => $error,    
    "ShowForm" => $showForm,
    "IDProd" => $id,
    "Back" => $back,
    "Etiquetas" => $etiquetas,
    "Titulo" => "Eliminar etiquetas",
]);
?>