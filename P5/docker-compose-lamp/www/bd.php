<?php
session_start();

class GestorBD{
    private $mysqli;
    private $MAX_PAGE;

    function __construct($super=false){
        $this->MAX_PAGE=9;
        $this->conectarDB($super);
    }


    function getMySQLi(){
        return $this->mysqli;
    }


    private function conectarDB($super){
        if($super){
            $this->mysqli=new mysqli("mysql", "super", "super", "SIBW");
        }
        else{
            $this->mysqli=new mysqli("mysql", "usuario", "usuario", "SIBW");
        }
    
        if($this->mysqli->connect_errno){
            echo("Fallo al conectar: ". $this->mysqli->connect_error);
            $this->mysqli=-1;
        }
    }


    function getProducto($id){
        $row=false;

        $prepare=$this->mysqli->prepare("SELECT * FROM Productos WHERE ID=?");
        $prepare->bind_param("i", $id);
        $prepare->execute();

        $res=$prepare->get_result();
    
        if($res->num_rows > 0)
            $row=$res->fetch_assoc();
    
        return $row;
    }


    function getFabricante($id){
        $row=false;

        $prepare=$this->mysqli->prepare("SELECT * FROM Fabricante WHERE Nombre=?");
        $prepare->bind_param("s", $id);
        $prepare->execute();

        $res=$prepare->get_result();
    
        if($res->num_rows > 0){
            $row=$res->fetch_assoc();
        }
    
        return $row;
    }


    function getAllFabricantes(){
        $row=false;

        $res=$this->mysqli->query("SELECT Nombre FROM Fabricante");
    
        if($res->num_rows > 0){
            $row=$res->fetch_all(MYSQLI_ASSOC);
        }

        $salida=array();

        for($i=0; $i<count($row); $i++){
            $salida[]=$row[$i]["Nombre"];
        }

        return $salida;        
    }


    private function getAllProducts(){
        $row=false;
        
        $res=$this->mysqli->query("SELECT * FROM Productos;");
        
        if($res->num_rows > 0){
            $row=$res->fetch_all(MYSQLI_ASSOC);
        }

        return $row;    
    }
    

    private function getAllProductsPublicados(){
        $row=false;
        
        $res=$this->mysqli->query("SELECT * FROM Productos WHERE Publicado=1");
        
        if($res->num_rows > 0){
            $row=$res->fetch_all(MYSQLI_ASSOC);
        }

        return $row;            
    }

    function getAllComments($idProducto){
        $res=false;
//SELECT Comentario.ID,Nombre,Correo,DATE_FORMAT(Fecha, '%e de %M del %Y, %H:%i'),Texto,Comentario.Editado,Usuarios.Foto FROM Comentario,Usuarios WHERE Comentario.ID_Usuario=Usuarios.ID AND Comentario.ID_Producto=1 ORDER BY Comentario.ID DESC;

        $this->mysqli->query("SET lc_time_names='es_ES';");
        //$prepare=$this->mysqli->prepare("SELECT Comentario.ID,Nombre,Correo,Fecha,Texto,Comentario.Editado,Usuarios.Foto FROM Comentario,Usuarios WHERE Comentario.ID_Usuario=Usuarios.ID AND Comentario.ID_Producto=? ORDER BY Comentario.ID DESC");
        $prepare=$this->mysqli->prepare("SELECT Comentario.ID,Nombre,Correo,DATE_FORMAT(Fecha, '%e de %M del %Y, %H:%i') AS Fecha,Texto,Comentario.Editado,Usuarios.Foto FROM Comentario,Usuarios WHERE Comentario.ID_Usuario=Usuarios.ID AND Comentario.ID_Producto=? ORDER BY Comentario.ID DESC");
        $prepare->bind_param("i", $idProducto);
        $prepare->execute();

        $query=$prepare->get_result(); 

        if($query->num_rows > 0)
            $res=$query->fetch_all(MYSQLI_ASSOC);

        return $res;
    }


    //Obtiene todos los productos y sus comentarios
    function getAllCommentsTodosProductos(){
        $productos=$this->getAllProductsPublicados();

        $count=count($productos);
        for($i=0; $i<$count; $i++){
            $productos[$i]["Comentarios"]=$this->getAllComments($productos[$i]["ID"]);

            if(!isset($productos[$i]["Comentarios"]) or empty($productos[$i]["Comentarios"])){
                unset($productos[$i]);
            }
        }

        return $productos;
    }  

    function getAllPaises(){
        $paises=false;
        
        $query=$this->mysqli->query("SELECT * FROM Pais ORDER BY CountryName");
        
        if($query->num_rows > 0){
            $paises=$query->fetch_all(MYSQLI_ASSOC);
        }
        
        return $paises;
    }


    function getPais($idPais){
        $pais=false;
        
        $prepare=$this->mysqli->prepare("SELECT * FROM Pais WHERE CountryCode=?");
        $prepare->bind_param("s", $idPais);
        $prepare->execute();
        
        $query=$prepare->get_result();
        
        if($query->num_rows > 0){
            $pais=$query->fetch_assoc();
        }
        
        return $pais;
    }


    //Obtiene el numero de pagina para la portada
    function getNumPaginas(){
        $salida=$this->getNumFilasProducto();

        $res=intval($salida/$this->MAX_PAGE);

        if($salida%$this->MAX_PAGE != 0)
            $res++;

        return $res;
    }
  

    //Obtiene los comentarios que encajen con las palabras pasadas como parametro
    private function searchComentariosIDProducto($idProducto, $texto){
        $res=false;

        $prepare=$this->mysqli->prepare("SELECT * FROM (SELECT Texto,Nombre,Correo,Fecha FROM Comentario,Usuarios WHERE Usuarios.ID=ID_Usuario AND ID_Producto=?) AS A WHERE A.Nombre LIKE ? OR A.Correo LIKE ? OR A.Texto LIKE ? OR A.Fecha LIKE ?");
        $keywordSQL="%".$texto."%";
        $prepare->bind_param("issss", $idProducto, $keywordSQL, $keywordSQL, $keywordSQL, $keywordSQL);
        $prepare->execute();

        $query=$prepare->get_result(); 

        if($query->num_rows > 0)
            $res=$query->fetch_all(MYSQLI_ASSOC);

        return $res;
    }


    //Busca los comentarios que contengan las palabras pasadas como parametro
    function searchComentarios($texto){
        $productos=$this->getAllProductsPublicados();

        $count=count($productos);
        for($i=0; $i<$count; $i++){
            $productos[$i]["Comentarios"]=$this->searchComentariosIDProducto($productos[$i]["ID"], $texto);

            if(!isset($productos[$i]["Comentarios"]) or empty($productos[$i]["Comentarios"])){
                unset($productos[$i]);
            }            
        }

        return $productos;
    }


    private function getNumFilasProducto(){
        $res=false;
        
        if(isset($_SESSION["usuario"]) and !empty($_SESSION["usuario"] and $_SESSION["usuario"]["esGestor"] == 1)){
            $query=$this->mysqli->query("SELECT COUNT(*) FROM Productos");
        }
        else{
            $query=$this->mysqli->query("SELECT COUNT(*) FROM Productos WHERE Publicado=1");
        }
    
        if($query->num_rows > 0){
            $res=$query->fetch_assoc();
            $res=$res["COUNT(*)"];
        }
    
        return $res;
    }


    function getPalabrotas(){
        $salida=false;

        $query=$this->mysqli->query("SELECT * FROM Palabrota;");
    
        if($query->num_rows > 0){
            $resultado=$query->fetch_all(MYSQLI_ASSOC);
        
            $salida=array();
        
            foreach ($resultado as $i) {
                foreach($i as $j){
                    $salida[]=$j;
                }
            }
        }
    
        return $salida;
    }


    function getImagenes($id){  
        $res=false;

        $prepare=$this->mysqli->prepare("SELECT * FROM Imagenes WHERE ID_Producto=?;");
        $prepare->bind_param("i", $id);
        $prepare->execute();

        $query=$prepare->get_result();
    
        if($query->num_rows > 0)
            $res=$query->fetch_all(MYSQLI_ASSOC);
    
        return $res;        
    }


    //Obtiene el numero de imagenes que tiene un producto
    function getImageCount($idProducto){
        $prepare=$this->mysqli->prepare("SELECT COUNT(*) FROM Imagenes WHERE ID_Producto=?");
        $prepare->bind_param("i", $idProducto);
        $prepare->execute();

        $query=$prepare->get_result();
    
        if($query->num_rows > 0){
            $res=$query->fetch_assoc();
            $res=$res["COUNT(*)"];
        }

        return $res;        
    }


    function getImagenIDImg($idImg){
        $res=false;

        $prepare=$this->mysqli->prepare("SELECT * FROM Imagenes WHERE ID_Imagen=?;");
        $prepare->bind_param("i", $idImg);
        $prepare->execute();

        $query=$prepare->get_result();
    
        if($query->num_rows > 0)
            $res=$query->fetch_assoc();
    
        return $res; 
    }


    function deleteImage($imgID){
        $imagen=$this->getImagenIDImg($imgID);

        if(!empty($imagen["Ruta Imagen"]))
            unlink($imagen["Ruta Imagen"]);

        $prepare=$this->mysqli->prepare("DELETE FROM Imagenes WHERE ID_Imagen=?");
        $prepare->bind_param("i", $imgID);
        $prepare->execute();        
    }

    function getProductsPage($a){
        if($a<=0 or $a>$this->getNumPaginas())
            $a=1;
        
        $res=false;

        $min=($a-1)*9;
        
        if(isset($_SESSION["usuario"]) and !empty($_SESSION["usuario"] and $_SESSION["usuario"]["esGestor"] == 1)){        
            $prepare=$this->mysqli->prepare("SELECT * FROM Productos ORDER BY ID LIMIT ?, ?");
        }
        else{
            $prepare=$this->mysqli->prepare("SELECT * FROM Productos WHERE Publicado=1 ORDER BY ID LIMIT ?, ?");
        }

        $prepare->bind_param("ii", $min, $this->MAX_PAGE);
        $prepare->execute();

        $query=$prepare->get_result();
    
        if($query->num_rows > 0)
            $res=$query->fetch_all(MYSQLI_ASSOC);

        return $res;
    }


    function existeProducto($id){
        $prepare=$this->mysqli->prepare("SELECT COUNT(*) FROM Productos WHERE ID=?");
        $prepare->bind_param("i", $id);
        $prepare->execute();

        $query=$prepare->get_result();
    
        if($query->num_rows > 0){
            $res=$query->fetch_assoc();
            $res=$res["COUNT(*)"];
        }

        $res=($res<=0)?false:true;

        return $res;
    }


    function comprobarCredenciales($correo, $pass){
        $prepare=$this->mysqli->prepare("SELECT * FROM Usuarios WHERE Correo=?");
        $prepare->bind_param("s", $correo);
        $prepare->execute();

        $query=$prepare->get_result();

        if($query->num_rows > 0){
            $res=$query->fetch_assoc()["Password"];
        }
        else
            return false;

        return password_verify($pass, $res);
    }


    function getUsuario2($id, $campo){
        $validos=array("ID", "Correo");
        $res=[
            "ID" => -1,
            "Nombre" => "Anónimo",
            "Correo" => null,
            "esModerador" => 0,
            "esGestor" => 0 ,
            "esSuperusuario" => 0       
        ];

        if(in_array($campo, $validos)){
            if($campo==="ID"){
                $columna="ID";
                $tipo="i";
            }
            else if($campo==="Correo"){
                $columna="Correo";
                $tipo="s";
            }
            $prepare=$this->mysqli->prepare("SELECT * FROM Usuarios WHERE $columna=?");
            $prepare->bind_param($tipo, $id);                            
            $prepare->execute();

            $query=$prepare->get_result(); 

            if($query->num_rows > 0)
                $res=$query->fetch_assoc();
        }

        return $res;        
    }  


    function insertarComentario($comentario, $producto){
        $pCheck=$this->existeProducto($producto);

        if(isset($_SESSION["usuario"]) and !empty($_SESSION["usuario"]) and $pCheck){
            $this->mysqli->query("SET time_zone='Europe/Madrid'");
            $prepare=$this->mysqli->prepare("INSERT INTO Comentario (ID_Usuario, Fecha, Texto, ID_Producto) VALUES(?, NOW(), ?, ?)");

            $prepare->bind_param("isi", $_SESSION["usuario"]["ID"], $comentario, $producto);

            $prepare->execute();
        }
    }


    function existeComentario($idComment){
        $prepare=$this->mysqli->prepare("SELECT COUNT(*) FROM Comentario WHERE ID=?");
        $prepare->bind_param("i", $idComment);
        $prepare->execute();

        $query=$prepare->get_result();
    
        if($query->num_rows > 0){
            $res=$query->fetch_assoc();
            $res=$res["COUNT(*)"];
        }

        $res=($res<=0)?false:true;

        return $res;
    }


    function deleteComment($idComment){        
        $existeComment=$this->existeComentario($idComment);

        if(isset($_SESSION["usuario"]) and !empty($_SESSION["usuario"]) and $_SESSION["usuario"]["esModerador"]==1 and $existeComment){
            $prepare=$this->mysqli->prepare("DELETE FROM Comentario WHERE ID=?");
            $prepare->bind_param("i", $idComment);
            $prepare->execute();
        }
    }


    function getComentario($idComentario){
        $res="";

        $prepare=$this->mysqli->prepare("SELECT Texto FROM Comentario WHERE ID=?");
        $prepare->bind_param("i", $idComentario);
        $prepare->execute();

        $query=$prepare->get_result(); 

        if($query->num_rows > 0)
            $res=$query->fetch_assoc()["Texto"];

        return $res;         
    }


    function changeComentario($id, $comentario){
        $existeComment=$this->existeComentario($id);

        if(isset($_SESSION["usuario"]) and !empty($_SESSION["usuario"]) and $_SESSION["usuario"]["esModerador"]==1 and $existeComment){
            $prepare=$this->mysqli->prepare("UPDATE Comentario SET Texto=?,Editado=1 WHERE ID=?");
            $prepare->bind_param("si", $comentario, $id);
            $prepare->execute();
        }
    }


    function cambiarDatosUsuario($nuevoNombre, $campo){
        $lista=["Foto", "Nombre", "Correo", "CountryCode", "Genero", "Direccion", "Password"];

        if(isset($_SESSION["usuario"]) and !empty($_SESSION["usuario"]) and in_array($campo, $lista, true)){
            if($campo=="Password")
                $nuevoNombre=password_hash($nuevoNombre, PASSWORD_DEFAULT);
            
            $prepare=$this->mysqli->prepare("UPDATE Usuarios SET $campo=? WHERE ID=?");
            $prepare->bind_param("si", $nuevoNombre, $_SESSION["usuario"]["ID"]);
            $prepare->execute();
        }        
    }


    function actualizarFotoPerfil($foto){
        if(isset($_SESSION["usuario"]) and !empty($_SESSION["usuario"])){
            if(!empty($_SESSION["usuario"]["Foto"]))
                unlink($_SESSION["usuario"]["Foto"]);

            //Se separa de la foto la extension y el nombre
            $directorioNuevaFoto=$this->subirImagen($foto, $_SESSION["usuario"]["ID"], true);
            $this->cambiarDatosUsuario($directorioNuevaFoto, "Foto");
        }
    }


    function cambiarDatosProducto($idProducto, $precio, $nombre, $descripcion, $tituloTop, $fabricante, $foto, $checkbox){
        $existeProd=$this->existeProducto($idProducto);
        if(isset($_SESSION["usuario"]) and !empty($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1 and $existeProd){
            $prepare=$this->mysqli->prepare("UPDATE Productos SET Precio=?,Nombre=?,Descripción=?,`Titulo pagina`=?,Nombre_Fabricante=?,Publicado=? WHERE ID=?");
            $prepare->bind_param("dssssii", $precio, $nombre, $descripcion, $tituloTop, $fabricante, $checkbox, $idProducto);
            $prepare->execute();  
            
            //Comprobar si se ha mandado alguna imagen
            //Ahora se envian las imagenes al servidor y se insertan en la base de datos
            for($i=0; $i<count($foto["name"]); $i++){
                if($foto["error"][$i]!=4){
                    $fotoActual=["name"=>$foto["name"][$i], "tmp_name"=>$foto["tmp_name"][$i], "error"=>$foto["error"][$i]];
                    $directorioNuevaFoto=$this->subirImagen($fotoActual, $idProducto, false);
                    $this->insertImagen($idProducto, $directorioNuevaFoto);
                }
            }            
        }
    }


    private function insertImagen($idProducto, $directorio){
        $existe=$this->existeImagenProducto($idProducto, $directorio);

        if(!$existe){
            $prepare=$this->mysqli->prepare("INSERT INTO Imagenes (ID_Producto, `Ruta Imagen`) VALUES (?,?)");
            $prepare->bind_param("is", $idProducto, $directorio);
            $prepare->execute();
        }
    }


    function deleteProducto($id){
        $existeProd=$this->existeProducto($id);

        if(isset($_SESSION["usuario"]) and !empty($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1 and $existeProd){
            $prepare=$this->mysqli->prepare("SELECT `Ruta Imagen` FROM Imagenes WHERE ID_Producto=?");
            $prepare->bind_param("i", $id);
            $prepare->execute();                 
            $query=$prepare->get_result()->fetch_all();

            for($i=0; $i<count($query); $i++){
                unlink($query[$i][0]);
            }
            
            $prepare=$this->mysqli->prepare("DELETE FROM Productos WHERE ID=?");
            $prepare->bind_param("i", $id);
            $prepare->execute();     
        }        
    }


    function estaRegistrado($correo){
        $prepare=$this->mysqli->prepare("SELECT COUNT(*) FROM Usuarios WHERE Correo=?");
        $prepare->bind_param("s", $correo);
        $prepare->execute();

        $query=$prepare->get_result();
    
        if($query->num_rows > 0){
            $res=$query->fetch_assoc();
            $res=$res["COUNT(*)"];
        }

        $res=($res<=0)?false:true;

        return $res;
    }


    function registrarUsuario($correo, $password, $nombre, $direccion, $genero, $foto, $pais){
        $password=password_hash($password, PASSWORD_DEFAULT);

        $prepare=$this->mysqli->prepare("INSERT INTO Usuarios (Nombre, Correo, CountryCode, Genero, Direccion, Password, esModerador, esGestor, esSuperusuario) VALUES (?,?,?,?,?,?,0,0,0)");
        $prepare->bind_param("ssssss", $nombre, $correo, $pais, $genero, $direccion, $password);
        $prepare->execute();

        if($foto["error"]!=4){
            //Ahora se obtiene el usuario a partir del correo pasado por parametro, para poder insertar la foto con su id
            $idUsuario=$this->getUsuario2($correo, "Correo")["ID"];
            $directorioNuevaFoto=$this->subirImagen($foto, $idUsuario, true);
            
            //Ahora se pone el directorio de la imagen en Foto con el usuario con ID
            $prepare=$this->mysqli->prepare("UPDATE Usuarios SET Foto=? WHERE ID=?");
            $prepare->bind_param("si", $directorioNuevaFoto, $idUsuario);
            $prepare->execute();
        }
    }


    private function subirImagen($foto, $id, $esUsuario){
        $extension=end(explode(".", $foto["name"]));
        $nombre=explode(".", $foto["name"])[0];

        if($esUsuario){
            $directorioNuevaFoto="static/images/".$nombre."_idUser".$id.".".$extension;
        }
        else{
            $directorioNuevaFoto="static/images/".$nombre."_idProduct".$id.".".$extension;
        }

        $directorioNuevaFoto=str_replace(" ", "_", $directorioNuevaFoto);
        move_uploaded_file($foto["tmp_name"], $directorioNuevaFoto);

        return $directorioNuevaFoto;
    }


    function addFabricante($nombre, $face, $tw, $yt, $web){
        if(isset($_SESSION["usuario"]) and !empty($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1){

            $prepare=$this->mysqli->prepare("INSERT INTO Fabricante (Nombre, Facebook, Twitter, Youtube, `Pagina oficial`) VALUES (?,?,?,?,?)");
            $prepare->bind_param("sssss", $nombre, $face, $tw, $yt, $web);
            $prepare->execute();
        }
    }


    function existeFabricante($nombre){
        $prepare=$this->mysqli->prepare("SELECT COUNT(*) FROM Fabricante WHERE Nombre=?");
        $prepare->bind_param("s", $nombre);
        $prepare->execute();

        $query=$prepare->get_result();
    
        if($query->num_rows > 0){
            $res=$query->fetch_assoc();
            $res=$res["COUNT(*)"];
        }

        $res=($res<=0)?false:true;            

        return $res;
    }    


    function deleteFabricante($nombre){
        if(isset($_SESSION["usuario"]) and !empty($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1){
            $prepare=$this->mysqli->prepare("DELETE FROM Fabricante WHERE Nombre=?");
            $prepare->bind_param("s", $nombre);
            $prepare->execute();     
        }         
    }


    function insertProducto($nombre, $precio, $descripcion, $tituloTop, $idFabricante, $foto, $publicar){
        $res=-1;
        $publicar=($publicar)?1:0;

        if(isset($_SESSION["usuario"]) and !empty($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1){
            $prepare=$this->mysqli->prepare("INSERT INTO Productos (Nombre, Precio, Descripción, `Titulo pagina`, Nombre_Fabricante, Publicado) VALUES (?,?,?,?,?,?)");
            $prepare->bind_param("sdsssi", $nombre, $precio, $descripcion, $tituloTop, $idFabricante, $publicar);
            $prepare->execute();

            //Al ser unique el nombre, es puede obtener el nuevo producto insertado
            $prepare=$this->mysqli->prepare("SELECT ID FROM Productos WHERE Nombre=?");
            $prepare->bind_param("s", $nombre);
            $prepare->execute();

            $idProducto=$prepare->get_result()->fetch_assoc()["ID"];
            
            $res=$idProducto;

            //Comprobar si se ha mandado alguna imagen
            //Ahora se envian las imagenes al servidor y se insertan en la base de datos
            for($i=0; $i<count($foto["name"]); $i++){
                if($foto["error"][$i]!=4){
                    $fotoActual=["name"=>$foto["name"][$i], "tmp_name"=>$foto["tmp_name"][$i], "error"=>$foto["error"][$i]];
                    $directorioNuevaFoto=$this->subirImagen($fotoActual, $idProducto, false);
                    $this->insertImagen($idProducto, $directorioNuevaFoto);
                }
            }
        }

        return $res;
    }


    function getAllUsuarios(){
        $row=false;
        
        $res=$this->mysqli->query("SELECT * FROM Usuarios;");
        
        if($res->num_rows > 0){
            $row=$res->fetch_all(MYSQLI_ASSOC);
        }

        return $row;    
    }    


    function cambiarPermisosUsuario($idSuperusuario, $idUsuario, $gestor, $moderador, $superusuario){
        $super=$this->getUsuario2($idSuperusuario, "ID");
        $usuario=$this->getUsuario2($idUsuario, "ID");

        if($super["ID"]!=-1 and $super["esSuperusuario"]==1 and $usuario["ID"]!=-1){
            $prepare=$this->mysqli->prepare("UPDATE Usuarios SET esModerador=?,esGestor=?,esSuperusuario=? WHERE ID=?");
            $prepare->bind_param("iiii", $moderador, $gestor, $superusuario, $idUsuario);
            $prepare->execute();     
        }        
    }


    function insertarComentarioImagen($idProducto, $ruta, $comentario){
        if(isset($_SESSION["usuario"]) and !empty($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1){
            $prepare=$this->mysqli->prepare("UPDATE Imagenes SET Descripcion=? WHERE ID_Producto=? AND `Ruta Imagen`=?");
            $prepare->bind_param("sis", $comentario, $idProducto, $ruta);
            $prepare->execute();
        }
    }


    function existeProductoNombre($nombre){
        $prepare=$this->mysqli->prepare("SELECT COUNT(*) FROM Productos WHERE Nombre=?");
        $prepare->bind_param("s", $nombre);
        $prepare->execute();

        $query=$prepare->get_result();
    
        if($query->num_rows > 0){
            $res=$query->fetch_assoc();
            $res=$res["COUNT(*)"];
        }

        $res=($res<=0)?false:true;

        return $res;
    }  
    

    function getAllProductsWithImage(){
        $productos=$this->getAllProducts();

        for($i=0; $i<count($productos); $i++){
            $aux=$this->getImagenes($productos[$i]["ID"]);

            if($aux!=false)
                $productos[$i]["Imagen"]=$aux[0]["Ruta Imagen"];
            else
                $productos[$i]["Imagen"]="static/images/placeholder.png";

            //Se insertan todas sus etiquetas
            $productos[$i]["Etiquetas"]=$this->getEtiquetas($productos[$i]["ID"]);
        }

        return $productos;
    }


    function insertEtiquetas($idProducto, $etiquetas){
        if(isset($_SESSION["usuario"]) and !empty($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1){
            for($i=0; $i<count($etiquetas); $i++){
                $etiqueta=trim($etiquetas[$i]);
    
                if($etiqueta!=""){
                    $prepare=$this->mysqli->prepare("INSERT INTO Etiquetas (ID_Producto, Nombre) VALUES (?,?)");
                    $prepare->bind_param("is", $idProducto, $etiqueta);
                    $prepare->execute();
                }
            }
        }
    }
    

    function getEtiquetas($idProducto){
        $etiquetas=false;
    
        $prepare=$this->mysqli->prepare("SELECT * FROM Etiquetas WHERE ID_Producto=?");
        $prepare->bind_param("i", $idProducto);
        $prepare->execute();
    
        $query=$prepare->get_result();
    
        if($query->num_rows > 0){
            $etiquetas=$query->fetch_all(MYSQLI_ASSOC);
        }
    
        return $etiquetas;
    } 
    

    function deleteEtiqueta($idProducto, $etiqueta){
        if(isset($_SESSION["usuario"]) and !empty($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"]==1){
            $prepare=$this->mysqli->prepare("DELETE FROM Etiquetas WHERE ID_Producto=? AND Nombre=?");
            $prepare->bind_param("is", $idProducto, $etiqueta);
            $prepare->execute();
        }
    }


    function existeImagen($idImagen){
        $prepare=$this->mysqli->prepare("SELECT COUNT(*) FROM Imagenes WHERE ID_Imagen=?");
        $prepare->bind_param("i", $idImagen);
        $prepare->execute();

        $query=$prepare->get_result();
    
        if($query->num_rows > 0){
            $res=$query->fetch_assoc();
            $res=$res["COUNT(*)"];
        }

        $res=($res<=0)?false:true;
        

        return $res;
    }

    function existeImagenProducto($idProducto, $rutaImagen){
        $prepare=$this->mysqli->prepare("SELECT COUNT(*) FROM Imagenes WHERE ID_Producto=? AND `Ruta Imagen`=?");
        $prepare->bind_param("is", $idProducto, $rutaImagen);
        $prepare->execute();

        $query=$prepare->get_result();
    
        if($query->num_rows > 0){
            $res=$query->fetch_assoc();
            $res=$res["COUNT(*)"];
        }

        $res=($res<=0)?false:true;
        
        return $res;
    }


    function searchProductos($nombre){
        $IDs=array();
        $nombre="%".$nombre."%";

        $prepare=$this->mysqli->prepare("SELECT * FROM Productos WHERE Nombre LIKE ? OR Precio LIKE ? OR Descripción LIKE ? OR `Titulo pagina` LIKE ? OR Nombre_Fabricante LIKE ?");
        $prepare->bind_param("sssss", $nombre, $nombre, $nombre, $nombre, $nombre);
        $prepare->execute();        

        $query=$prepare->get_result();

        $res=false;
        if($query->num_rows > 0){
            $res=$query->fetch_all(MYSQLI_ASSOC);
        }

        //Se obtiene de la tabla Productos, pero puede haber etiquetas que hagan match
        //Almacenar las ID de res
        if($res!=false){
            for($i=0; $i<count($res); $i++){
                $IDs[]=$res[$i]["ID"];
            }
        }

        $prepare=$this->mysqli->prepare("SELECT * FROM Etiquetas WHERE Nombre LIKE ?");
        $prepare->bind_param("s", $nombre);
        $prepare->execute();

        $query=$prepare->get_result();

        $res=false;
        if($query->num_rows > 0){
            $res=$query->fetch_all(MYSQLI_ASSOC);
        }

        //Se almacena en el array de IDs, solo si no esta repetido el ID
        if($res!=false){
            for($i=0; $i<count($res); $i++){
                $aux=$res[$i]["ID_Producto"];
                if(!in_array($aux, $IDs)){
                    $IDs[]=$aux;
                }
            }
        }


        $res=array();
        //Se obtienen los productos de la tabla Productos
        for($i=0; $i<count($IDs); $i++){
            $aux=$this->getProducto($IDs[$i]);
            if($aux!=false){
                $img=$this->getImagenes($aux["ID"]);
    
                if($img!=false)
                    $aux["Imagen"]=$img[0]["Ruta Imagen"];
                else
                    $aux["Imagen"]="static/images/placeholder.png";
    
                //Se insertan todas sus etiquetas
                $aux["Etiquetas"]=$this->getEtiquetas($aux["ID"]);

                $res[]=$aux;
            }
        }

        return $res;
    }

    
    function existeUsuarioCorreo($correo){
        $prepare=$this->mysqli->prepare("SELECT COUNT(*) FROM Usuarios WHERE Correo=?");
        $prepare->bind_param("s", $correo);
        $prepare->execute();

        $query=$prepare->get_result();
    
        if($query->num_rows > 0){
            $res=$query->fetch_assoc();
            $res=$res["COUNT(*)"];
        }

        $res=($res<=0)?false:true;
        
        return $res;
    }

    //Esta version es mas eficiente ya que se me quedaba colgado el navegador
    function searchProductosAJAX($nombre){
        $res=array();
        //Solo si la longitud de la cadena es mayor que 0
        if(strlen($nombre)>0){
            $nombre="%".$nombre."%";

            if(isset($_SESSION["usuario"]) and !empty($_SESSION["usuario"]) and $_SESSION["usuario"]["esGestor"] == 1){
                $prepare=$this->mysqli->prepare("SELECT * FROM Productos WHERE Nombre LIKE ? OR Descripción LIKE ?");
            }
            else{
                $prepare=$this->mysqli->prepare("SELECT * FROM Productos WHERE Publicado=1 AND (Nombre LIKE ? OR Descripción LIKE ?)");
            }
            $prepare->bind_param("ss", $nombre, $nombre);
            $prepare->execute();        
            
            $query=$prepare->get_result();
            
            $res=$query->fetch_all(MYSQLI_ASSOC);
        }

        return $res;
    }

    function cambiarEstadoPublicacion($idProducto, $estado){
        if($this->existeProducto($idProducto)){
            $prepare=$this->mysqli->prepare("UPDATE Productos SET Publicado=? WHERE ID=?");
            $prepare->bind_param("ii", $estado, $idProducto);
            $prepare->execute();
        }
    }
}
?>