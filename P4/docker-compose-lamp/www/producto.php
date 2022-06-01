<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");

    //Conexion base de datos
    $con=new GestorBD();

    //Identificador del producto junto su comprobacion
    $id=1;

    if(isset($_GET["p"]) and !empty($_GET["p"]) and is_numeric($_GET["p"]) and $con->existeProducto($_GET["p"]))
        $id=$_GET["p"];

    //Parte de añadir comentarios
    session_start();

    $error=0;
    if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["comentario"]) and isset($_SESSION["usuario"])){
        $prodID=$_POST["actual"];

        if($_POST["comentario"] !== ""){
            $con->insertarComentario($_SESSION["usuario"]["ID"], $_POST["comentario"], $prodID);

            header("Location: producto.php?p=$prodID");     //Redirijo para evitar que salga una ventana emergente de confirmar subida de nuevo
            exit();
        }
        else{
            $error=-1;
        }
    }
    

    //Parte de hacer las queries
    $res=$con->getProducto($id);
    $fabricanteRes=$con->getFabricante($res["Nombre_Fabricante"]);
    $comentarios=$con->getAllComments($id);
    $palabrotas=$con->getPalabrotas();
    $imagenes=$con->getImagenes($id);
    $etiquetas=$con->getEtiquetas($id);

    //Si no ha encontrado ninguna imagen se pone un placeholder
    if($imagenes==false){
        $imagenes=array(array("Ruta Imagen"=>"static/images/placeholder.png", "Descripcion"=>"placeholder"));
    }

    //Para lanzar la version imprimible o no
    if(isset($_GET["imprimir"]) and !empty($_GET["imprimir"]) and is_numeric($_GET["imprimir"]) and $_GET["imprimir"]==1){
        $pagina="producto_imprimir.twig";
        
        $imagenes=array_slice($imagenes, 0, 2); //Solo se ponen las dos primeras imagenes
    }
    else
        $pagina="producto.twig";
    
    
    //Los botones del menu con sus respectivas paginas
    $menu=array("Inicio"=>"index.php",
                "Imprimir"=>"producto.php?p=$id&imprimir=1");

    
    //Parte de sesiones
    $usuario=$con->getUsuario2(-1, "ID");

    //Parte de sesiones
    if(isset($_SESSION["usuario"])){
        //Arreglar esto, hace falta tener una opcion fallback
        $usuario=$_SESSION["usuario"];   

        if($usuario["esGestor"]==1){
            $menu["Editar producto"]="edit_product.php?back=producto.php?p=$id&id=$id";
            $menu["Eliminar producto"]="delete_product.php?back=index.php&id=$id";   
        }
    }
    else{
        $menu["Login"]="login.php?back=producto.php";     
    }


    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    echo $twig->render($pagina, [
        "Imprimir" => $_GET["imprimir"],
        "Titulo" => $res["Titulo pagina"],
        "Menu" => $menu,
        "NombreProducto" => $res["Nombre"],
        "Fabricante" => $fabricanteRes["Nombre"],
        "Precio" => $res["Precio"],
        "Descripcion" => $res["Descripción"],
        "Images" => $imagenes,
        "PaginaOficial" => $fabricanteRes["Pagina oficial"],
        "Twitter" => $fabricanteRes["Twitter"],
        "YouTube" => $fabricanteRes["YouTube"],
        "Facebook" => $fabricanteRes["Facebook"],
        "Tabla" => $res["Tabla"],
        "ID" => $id,
        "Imprimir" => $_GET["imprimir"],
        "Comentarios" => $comentarios,
        "User" => $usuario,
        "URL" => "producto.php?p=",
        "Back" => $id,
        "Error" => $error,
        "Etiquetas" => $etiquetas,
    ]);
?>