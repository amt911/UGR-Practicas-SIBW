<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("bd.php");

    session_start();

    $con=new GestorBD();

    $errores=array();

    $menu=array("Inicio"=>"index.php");

    $showForm=false;

    if(isset($_SESSION["usuario"]) and $_SESSION["usuario"]["esSuperusuario"]==1){
        $showForm=true;

        $usuarios=$con->getAllUsuarios();
        //var_dump($usuarios);

    }
    else
        $errores[]="El usuario no es un superusuario o no está registrado";


    if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_SESSION["usuario"]) and $_SESSION["usuario"]["esSuperusuario"]==1){
        $gestor=(isset($_POST["gestor"]) and !empty($_POST["gestor"]))?1:0;
        $moderador=(isset($_POST["moderador"]) and !empty($_POST["moderador"]))?1:0;
        $superusuario=(isset($_POST["superusuario"]) and !empty($_POST["superusuario"]))?1:0;

        if($superusuario==1){
            $gestor=$moderador=1;
        }
        
        $con->cambiarPermisosUsuario($_SESSION["usuario"]["ID"], $_POST["usuario"], $gestor, $moderador, $superusuario);

        header("Location: permisos.php");
        exit();
    }

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    echo $twig->render("permisos.twig", [
        "NombreForm" => "Cambiar permiso usuarios",
        "Menu" => $menu,
        "Errores" => $errores,
        "ShowForm" => $showForm,
        "Usuarios" => $usuarios,
        "Yo" => $_SESSION["usuario"],
        "Titulo" => "Cambiar permiso usuarios",
    ]);    
?>