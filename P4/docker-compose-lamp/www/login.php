<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
echo $twig->render('login.twig', [
    "Titulo" => "e-tienda. Más que comercio",
    "Menu" => $menu,
    "Productos" => $productos,
    "MinPagina" => $minPagina,
    "MaxPagina" => $maxPagina,
    "Anterior" => $anterior,
    "Siguiente" => $siguiente,
    "Actual" => $pagina
]);
?>