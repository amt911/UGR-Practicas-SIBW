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
    if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["comentario"]) and !empty($_SESSION["usuario"])){
        $prodID=$_POST["actual"];
        $palabrotas=$con->getPalabrotas();

        $comentario=$_POST["comentario"];

        //Por si acaso no funciona javascript, sustituyo las palabrotas tambien en el servidor
        foreach($palabrotas as $palabra){
            $comentario=str_replace($palabra, str_repeat("*", strlen($palabra)), $comentario);
        }

        if($_POST["comentario"] !== ""){
            $con->insertarComentario($_SESSION["usuario"]["ID"], $comentario, $prodID);

            header("Location: producto.php?p=$prodID");     //Redirijo para evitar que salga una ventana emergente de confirmar subida de nuevo
            exit();
        }
        else{
            $error=-1;
        }
    }

    //Los botones del menu con sus respectivas paginas
    $menu=array("Inicio"=>"index.php",
                "Imprimir"=>"producto.php?p=$id&imprimir=1");

    //Parte de sesiones
    $usuario=$con->getUsuario2(-1, "ID");

    //Parte de sesiones
    if(isset($_SESSION["usuario"])){
        $usuario=$_SESSION["usuario"];   

        if($usuario["esGestor"]==1){
            $menu["Editar producto"]="edit_product.php?back=producto.php?p=$id&id=$id";
            $menu["Eliminar producto"]="delete_product.php?back=index.php&id=$id";   
        }
    }
    else{
        $menu["Login"]="login.php?back=producto.php";     
    }

    $res=$con->getProducto($id);
    $fabricanteRes=-1;      //Fallback
    $comentarios=-1;        //Fallback
    $imagenes=-1;       //Fallback
    $etiquetas=-1;      //Fallback
    $error=0;

    //Solo se muestra si tiene permisos, en otro caso error
    if(isset($_SESSION["usuario"]) and !empty($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1 or $res["Publicado"]==1){
        
        //Parte de hacer las queries    
        $fabricanteRes=$con->getFabricante($res["Nombre_Fabricante"]);
        $comentarios=$con->getAllComments($id);
        $imagenes=$con->getImagenes($id);
        $etiquetas=$con->getEtiquetas($id);

        //Si no ha encontrado ninguna imagen se pone un placeholder
        if($imagenes==false){
            $imagenes=array(array("Ruta Imagen"=>"static/images/placeholder.png", "Descripcion"=>"placeholder"));
        }
    }
    else{
        $error=-1;
    }

    //Para lanzar la version imprimible o no, solo en caso de que no haya error
    if(isset($_GET["imprimir"]) and !empty($_GET["imprimir"]) and is_numeric($_GET["imprimir"]) and $_GET["imprimir"]==1 and $error==0){
        $pagina="producto_imprimir.twig";
        
        $imagenes=array_slice($imagenes, 0, 2); //Solo se ponen las dos primeras imagenes
    }
    else
        $pagina="producto.twig";

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
        "Error" => $error,
    ]);
?>