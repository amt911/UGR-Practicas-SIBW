<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");

    session_start();
    $con=new GestorBD("root", "tiger");

    $menu=array("Inicio"=>"index.php");

    $back="index.php";  //Fallback
    if(isset($_GET["back"]) and !empty($_GET["back"]))
        $back=$_GET["back"];

    $id=-1;     //Error por defecto

    if(isset($_GET["id"]) and !empty($_GET["id"]) and is_numeric($_GET["id"]))
        $id=$_GET["id"];


    $error=array();

    if(isset($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1){
        $esGestor=true;
    }
    else{
        $error[]="El usuario no es un gestor";
        $esGestor=false;        
    }

    //Parte de rellenar los campos
    if($con->existeProducto($id)){
        $producto=$con->getProducto($id);
        $fabricantes=$con->getAllFabricantes();
        $imagenes=$con->getImagenes($id);
        $etiquetas=$con->getEtiquetas($id);
    }
    else{
        $error[]="El producto no existe";
    }


    //Parte de POST
    if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1){
        if(empty($_POST["precio"]) or empty($_POST["nombre"]) or empty($_POST["descripcion"]) or empty($_POST["titulo-top"]) or !is_numeric($_POST["precio"])){
            $error[]="Hay campos obligatorios vacíos o incorrectos";

            $back=$_POST["back"];
        }
        else{
            $imagenesAntiguas=$con->getImagenes($id);

            if($imagenesAntiguas!=false){
                for($i=0; $i<count($imagenesAntiguas); $i++){
                    if(isset($_POST["imagen-eliminar_".$imagenesAntiguas[$i]["ID_Imagen"]]) and !empty($_POST["imagen-eliminar_".$imagenesAntiguas[$i]["ID_Imagen"]]) and $_POST["imagen-eliminar_".$imagenesAntiguas[$i]["ID_Imagen"]]=="on"){
                        $con->deleteImage($imagenesAntiguas[$i]["ID_Imagen"]);
                    }
                }
            }

            $etiquetasAntiguas=$con->getEtiquetas($id);

            if($etiquetasAntiguas!=false){
                for($i=0; $i<count($etiquetasAntiguas); $i++){
                    if(isset($_POST["eliminar-etiqueta_".$etiquetasAntiguas[$i]["Nombre"]]) and !empty($_POST["eliminar-etiqueta_".$etiquetasAntiguas[$i]["Nombre"]]) and $_POST["eliminar-etiqueta_".$etiquetasAntiguas[$i]["Nombre"]]=="on"){
                        $con->deleteEtiqueta($_SESSION["usuario"]["ID"], $_POST["product-id"], $etiquetasAntiguas[$i]["Nombre"]);
                    }
                }
            }

            if(!empty($_POST["etiquetas"]) and isset($_POST["etiquetas"])){
                $etiquetas=$_POST["etiquetas"];
                //eliminar espacios
                $etiquetas=str_replace(" ", "", $etiquetas);

                //separar por comas y obtener un array
                $etiquetas=explode(",", $etiquetas);
                $con->insertEtiquetas($_SESSION["usuario"]["ID"], $id, $etiquetas);
            }            

            $con->cambiarDatosProducto($_SESSION["usuario"]["ID"], $_POST["product-id"], $_POST["precio"], $_POST["nombre"], $_POST["descripcion"], $_POST["titulo-top"], $_POST["fabricante"], $_FILES["imagenes"]);
            $nroImg=$con->getImageCount($id);

            $back=$_POST["back"];

            if($nroImg>0){
                header("Location: comentarios_imagen_form.php?id=".$id."&back=".$back);
                exit();                
            }

            header("Location: $back");
            exit();
        }
    }

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    echo $twig->render('edit_product.twig', [
        "NombreForm" => "Cambiar datos de producto",
        "Menu" => $menu,
        "Back" => $back,
        "ProductID" => $id,
        "Errores" => $error,
        "EsGestor" => $esGestor,
        "Producto" => $producto,
        "Fabricantes" => $fabricantes,
        "Imagenes" => $imagenes,
        "Etiquetas" => $etiquetas,
        "Titulo" => "Cambiar datos del producto",
    ]);    
?>