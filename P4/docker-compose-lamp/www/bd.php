<?php
class GestorBD{
    private $mysqli;
    private $MAX_PAGE;

    function __construct($user="usuario", $pass="usuario"){
        $this->MAX_PAGE=9;
        $this->conectarDB($user, $pass);
    }


    function getMySQLi(){
        return $this->mysqli;
    }


    private function conectarDB($user, $pass){
        $this->mysqli=new mysqli("mysql", $user, $pass, "SIBW");
    
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


    function getFabrica($id){
        $row=false;

        $prepare=$this->mysqli->prepare("SELECT * FROM Fabrica WHERE ID=?");
        $prepare->bind_param("i", $id);
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


    function getAllProducts(){
        $row=false;
        
        $res=$this->mysqli->query("SELECT * FROM Productos;");
        
        if($res->num_rows > 0){
            $row=$res->fetch_all(MYSQLI_ASSOC);
        }

        return $row;    
    }
    

    function getNumPaginas(){
        $salida=$this->getNumFilasProducto();

        $res=intval($salida/$this->MAX_PAGE);

        if($salida%$this->MAX_PAGE != 0)
            $res++;

        return $res;
    }


    function getAllComments($idProducto){
        $res=false;

        $this->mysqli->query("SET lc_time_names='es_ES';");
        //$prepare=$this->mysqli->prepare("SELECT ID,Nombre,DATE_FORMAT(Fecha, '%d de %M del %Y, %k:%i') AS Fecha,Texto,Correo FROM Comentario WHERE ID_Producto=? ORDER BY ID DESC");
        $prepare=$this->mysqli->prepare("SELECT Comentario.ID,Nombre,Correo,Fecha,Texto FROM Comentario,Usuarios WHERE Comentario.ID_Usuario=Usuarios.ID AND Comentario.ID_Producto=? ORDER BY Comentario.ID DESC");
        $prepare->bind_param("i", $idProducto);
        $prepare->execute();

        $query=$prepare->get_result(); 

        if($query->num_rows > 0)
            $res=$query->fetch_all(MYSQLI_ASSOC);

        return $res;
    }

    function getAllCommentsTodosProductos(){
        $productos=$this->getAllProducts();

        $count=count($productos);
        for($i=0; $i<$count; $i++){
            $productos[$i]["Comentarios"]=$this->getAllComments($productos[$i]["ID"]);

            if(!isset($productos[$i]["Comentarios"]) or empty($productos[$i]["Comentarios"])){
                unset($productos[$i]);
            }
        }

        
        //return $res;
        return $productos;
    }    

    function searchComentariosIDProducto($idProducto, $texto){
        $res=false;

        $prepare=$this->mysqli->prepare("SELECT * FROM Comentario WHERE ID_Producto=? AND Texto LIKE ?");
        $keywordSQL="%".$texto."%";
        $prepare->bind_param("is", $idProducto, $keywordSQL);
        $prepare->execute();

        $query=$prepare->get_result(); 

        if($query->num_rows > 0)
            $res=$query->fetch_all(MYSQLI_ASSOC);

        return $res;
    }

    function searchComentarios($texto){
        $productos=$this->getAllProducts();

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
        
        $query=$this->mysqli->query("SELECT COUNT(*) FROM Productos");
    
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

    function getImageCount($idProducto){
        $res=-1;

        $prepare=$this->mysqli->prepare("SELECT COUNT(*) FROM Imagenes WHERE ID_Producto=?");
        $prepare->bind_param("i", $idProducto);
        $prepare->execute();

        $query=$prepare->get_result();
    
        if($query->num_rows > 0){
            $res=$query->fetch_assoc();
            $res=$res["COUNT(*)"];
        }

        //PARTE NUEVA
        if($res<=0)
            $res=false;
        else
            $res=true;

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

        //var_dump($imgID);

        $prepare=$this->mysqli->prepare("DELETE FROM Imagenes WHERE ID_Imagen=?");
        $prepare->bind_param("i", $imgID);
        $prepare->execute();        
    }

    function getProductsPage($a){
        if($a<=0 or $a>$this->getNumPaginas())
            $a=1;
        
        $res=false;

        $min=($a-1)*9;

        $prepare=$this->mysqli->prepare("SELECT * FROM Productos ORDER BY ID LIMIT ?, ?");
        $prepare->bind_param("ii", $min, $this->MAX_PAGE);
        $prepare->execute();

        $query=$prepare->get_result();
    
        if($query->num_rows > 0)
            $res=$query->fetch_all(MYSQLI_ASSOC);

        return $res;
    }


    function existeProducto($id){
        $res=-1;

        $prepare=$this->mysqli->prepare("SELECT COUNT(*) FROM Productos WHERE ID=?");
        $prepare->bind_param("i", $id);
        $prepare->execute();

        $query=$prepare->get_result();
    
        if($query->num_rows > 0){
            $res=$query->fetch_assoc();
            $res=$res["COUNT(*)"];
        }

        //PARTE NUEVA
        if($res<=0)
            $res=false;
        else 
            $res=true;

        return $res;
    }

    function comprobarCredenciales($correo, $pass){
        $res="";

        //$prepare=$this->mysqli->prepare("SELECT COUNT(*) FROM Usuarios WHERE Correo=? AND Password=?");
        //$prepare->bind_param("ss", $correo, $pass);
        //$prepare->execute();

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

    function getNombre($correo){
        $res=false;

        $prepare=$this->mysqli->prepare("SELECT Nombre FROM Usuarios WHERE Correo=?");
        $prepare->bind_param("s", $correo);
        $prepare->execute();

        $query=$prepare->get_result(); 

        if($query->num_rows > 0)
            $res=$query->fetch_assoc();

        return $res["Nombre"];        
    }

    function getPermisosUsuario($correo){
        $res=false;

        $prepare=$this->mysqli->prepare("SELECT esNormal,esModerador,esGestor, esSuperusuario FROM Usuarios WHERE Correo=?");
        $prepare->bind_param("s", $correo);
        $prepare->execute();

        $query=$prepare->get_result(); 

        if($query->num_rows > 0)
            $res=$query->fetch_assoc();

        return $res;                
    }

    function getUsuario($id){
        //QUIZAS QUITAR LA PARTE DE LA CONTRASEÑA
        $res=[
            "ID" => -1,
            "Nombre" => "Anónimo",
            "Correo" => null,
            "esNormal" => 0,
            "esModerador" => 0,
            "esGestor" => 0 ,
            "esSuperusuario" => 0       
        ];

        $prepare=$this->mysqli->prepare("SELECT * FROM Usuarios WHERE ID=?");
        $prepare->bind_param("i", $id);
        $prepare->execute();

        $query=$prepare->get_result(); 

        if($query->num_rows > 0)
            $res=$query->fetch_assoc();

        return $res;        
    }    

    function getUsuarioFromCorreo($correo){
        //QUIZAS QUITAR LA PARTE DE LA CONTRASEÑA
        $res=[
            "ID" => -1,
            "Nombre" => "Anónimo",
            "Correo" => null,
            "esNormal" => 0,
            "esModerador" => 0,
            "esGestor" => 0 ,
            "esSuperusuario" => 0       
        ];

        $prepare=$this->mysqli->prepare("SELECT * FROM Usuarios WHERE Correo=?");
        $prepare->bind_param("s", $correo);
        $prepare->execute();

        $query=$prepare->get_result(); 

        if($query->num_rows > 0)
            $res=$query->fetch_assoc();

        return $res;        
    }    

    function insertarComentario($id, $comentario, $producto){
        $usuario=$this->getUsuario($id);
        $pCheck=$this->existeProducto($producto);

        if($usuario["ID"]!=-1 and $pCheck){
            $this->mysqli->query("SET time_zone='Europe/Madrid'");
            $prepare=$this->mysqli->prepare("INSERT INTO Comentario (ID_Usuario, Fecha, Texto, ID_Producto) VALUES(?, NOW(), ?, ?)");

            $prepare->bind_param("isi", $usuario["ID"], $comentario, $producto);

            $prepare->execute();
        }
    }

    function existeComentario($idComment){
        $res=-1;

        $prepare=$this->mysqli->prepare("SELECT COUNT(*) FROM Comentario WHERE ID=?");
        $prepare->bind_param("i", $idComment);
        $prepare->execute();

        $query=$prepare->get_result();
    
        if($query->num_rows > 0){
            $res=$query->fetch_assoc();
            $res=$res["COUNT(*)"];
        }

        //PARTE NUEVA
        if($res<=0)
            $res=false;
        else
            $res=true;

        return $res;
    }

    function deleteComment($idComment, $id){        
        $usuario=$this->getUsuario($id);
        $existeComment=$this->existeComentario($idComment);

        if($usuario["ID"]!=-1 and $usuario["esModerador"]==1 and $existeComment){
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

    function changeComentario($idUsuario, $id, $comentario){
        $usuario=$this->getUsuario($idUsuario);
        $existeComment=$this->existeComentario($id);

        if($usuario["ID"]!=-1 and $usuario["esModerador"]==1 and $existeComment){
            //echo "funciona";
            $prepare=$this->mysqli->prepare("UPDATE Comentario SET Texto=? WHERE ID=?");
            $prepare->bind_param("si", $comentario, $id);
            $prepare->execute();
        }
    }

    function cambiarDatosUsuario($id, $nuevoNombre, $campo){
        $lista=["Foto", "Nombre", "Correo", "CountryCode", "Genero", "Direccion", "Password"];

        $usuario=$this->getUsuario($id);

        if($usuario["ID"]!=-1 and in_array($campo, $lista, true)){
            if($campo=="Password")
                $nuevoNombre=password_hash($nuevoNombre, PASSWORD_DEFAULT);
            
            $prepare=$this->mysqli->prepare("UPDATE Usuarios SET $campo=? WHERE ID=?");
            $prepare->bind_param("si", $nuevoNombre, $id);
            $prepare->execute();
        }        
    }


    function actualizarFotoPerfil($idUsuario, $foto){
        $user=$this->getUsuario($idUsuario);

        if($user["ID"]!=-1){
            if(!empty($user["Foto"]))
                unlink($user["Foto"]);
    
            //Se separa de la foto la extension y el nombre
            $extension=end(explode(".", $foto["name"]));
            $nombre=explode(".", $foto["name"])[0];

            $directorioNuevaFoto="static/images/".$nombre."_idUser".$idUsuario.".".$extension;
            $directorioNuevaFoto=str_replace(" ", "_", $directorioNuevaFoto);
            move_uploaded_file($foto["tmp_name"], $directorioNuevaFoto);

            $prepare=$this->mysqli->prepare("UPDATE Usuarios SET Foto=? WHERE ID=?");
            $prepare->bind_param("si", $directorioNuevaFoto, $idUsuario);
            $prepare->execute();
        }
    }

    function cambiarDatosProducto($idUsuario, $idProducto, $precio, $nombre, $descripcion, $tituloTop, $fabricante, $foto){
        $usuario=$this->getUsuario($idUsuario);
        $existeProd=$this->existeProducto($idProducto);

        if($usuario["ID"]!=-1 and $usuario["esGestor"]==1 and $existeProd){
            $prepare=$this->mysqli->prepare("UPDATE Productos SET  Precio=?,Nombre=?,Descripción=?,`Titulo pagina`=?,Nombre_Fabricante=? WHERE ID=?");
            $prepare->bind_param("dssssi", $precio, $nombre, $descripcion, $tituloTop, $fabricante, $idProducto);
            $prepare->execute();  
            
            //Comprobar si se ha mandado alguna imagen
            //Ahora se envian las imagenes al servidor y se insertan en la base de datos
            for($i=0; $i<count($foto["name"]); $i++){
                if($foto["error"][$i]!=4){
                    //move_uploaded_file($foto["tmp_name"][$i], "static/images/".$foto["name"][$i]);
                    $extension=end(explode(".", $foto["name"][$i]));
                    $nombre=explode(".", $foto["name"][$i])[0];
    
                    $directorioNuevaFoto="static/images/".$nombre."_".$idProducto.".".$extension;
                    $directorioNuevaFoto=str_replace(" ", "_", $directorioNuevaFoto);
                    move_uploaded_file($foto["tmp_name"][$i], $directorioNuevaFoto);

                    $prepare=$this->mysqli->prepare("INSERT INTO Imagenes (ID_Producto, `Ruta Imagen`) VALUES (?,?)");
                    $prepare->bind_param("is", $idProducto, $directorioNuevaFoto);
                    $prepare->execute();
                }
            }            
        }
    }

    //Unir
    function insertarImagen($idUsuario, $idProducto, $foto){
        $existeProd=$this->existeProducto($idProducto);
        $usuario=$this->getUsuario($idUsuario);

        if($usuario["ID"]!=-1 and $usuario["esGestor"]==1 and $existeProd){
            $extension=end(explode(".", $foto["name"]));
            $nombre=explode(".", $foto["name"])[0];

            $directorioNuevaFoto="static/images/".$nombre."_".$idProducto.".".$extension;
            $directorioNuevaFoto=str_replace(" ", "_", $directorioNuevaFoto);
            move_uploaded_file($foto["tmp_name"], $directorioNuevaFoto);

            $prepare=$this->mysqli->prepare("INSERT INTO Imagenes (ID_Producto, `Ruta Imagen`) VALUES (?,?)");
            $prepare->bind_param("is", $idProducto, $directorioNuevaFoto);
            $prepare->execute();
        }
    }

    function insertarImagenes($idUsuario, $idProducto, $fotos){
        $existeProd=$this->existeProducto($idProducto);
        $usuario=$this->getUsuario($idUsuario);

        if($usuario["ID"]!=-1 and $usuario["esGestor"]==1 and $existeProd){
            for($i=0; $i<count($fotos["name"]); $i++){
                if($fotos["error"][$i]!=4){
                    //move_uploaded_file($foto["tmp_name"][$i], "static/images/".$foto["name"][$i]);
                    $extension=end(explode(".", $fotos["name"][$i]));
                    $nombre=explode(".", $fotos["name"][$i])[0];

                    $directorioNuevaFoto="static/images/".$nombre."_".$idProducto.".".$extension;
                    $directorioNuevaFoto=str_replace(" ", "_", $directorioNuevaFoto);
                    move_uploaded_file($fotos["tmp_name"][$i], $directorioNuevaFoto);

                    $prepare=$this->mysqli->prepare("INSERT INTO Imagenes (ID_Producto, `Ruta Imagen`) VALUES (?,?)");
                    $prepare->bind_param("is", $idProducto, $directorioNuevaFoto);
                    $prepare->execute();
                }
            }            
        }
    }

    function deleteProducto($idUsuario, $id){
        $usuario=$this->getUsuario($idUsuario);
        $existeProd=$this->existeProducto($id);
        //echo "me gusta esto";
        //var_dump($usuario);
        //var_dump($existeProd);
        //var_dump($id);
        if($usuario["ID"]!=-1 and $usuario["esGestor"]==1 and $existeProd){
            //echo "mp";
//            $prepare=$this->mysqli->prepare("DELETE FROM Comentario WHERE ID_Producto=?");
//            $prepare->bind_param("i", $id);
//            $prepare->execute();    
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
        $res=-1;

        $prepare=$this->mysqli->prepare("SELECT COUNT(*) FROM Usuarios WHERE Correo=?");
        $prepare->bind_param("s", $correo);
        $prepare->execute();

        $query=$prepare->get_result();
    
        if($query->num_rows > 0){
            $res=$query->fetch_assoc();
            $res=$res["COUNT(*)"];
        }

        //PARTE NUEVA
        if($res<=0)
            $res=false;
        else
            $res=true;

        return $res;
    }

    function registrarUsuario($correo, $password, $nombre, $direccion, $genero, $foto, $pais){
        $password=password_hash($password, PASSWORD_DEFAULT);
        if($foto["error"]==4){
            $prepare=$this->mysqli->prepare("INSERT INTO Usuarios (Nombre, Correo, CountryCode, Genero, Direccion, Password, esNormal, esModerador, esGestor, esSuperusuario) VALUES (?,?,?,?,?,?,1,0,0,0)");
            $prepare->bind_param("ssssss", $nombre, $correo, $pais, $genero, $direccion, $password);
            $prepare->execute();
        }
        else{
            //move_uploaded_file($foto["tmp_name"], "static/images/".$foto["name"]);
            $prepare=$this->mysqli->prepare("INSERT INTO Usuarios (Nombre, Correo, CountryCode, Genero, Direccion, Password, esNormal, esModerador, esGestor, esSuperusuario) VALUES (?,?,?,?,?,?,1,0,0,0)");
            //$dirFoto="static/images/".$foto["name"];
            
            $prepare->bind_param("ssssss", $nombre, $correo, $pais, $genero, $direccion, $password);
            $prepare->execute();


            //Se separa de la foto la extension y el nombre
            //if($foto["error"]!=4){
                //Ahora se obtiene el usuario a partir del correo pasado por parametro, para poder insertar la foto con su id
                $idUsuario=$this->getUsuarioFromCorreo($correo)["ID"];

                $extension=end(explode(".", $foto["name"]));
                $nombre=explode(".", $foto["name"])[0];
    
                $directorioNuevaFoto="static/images/".$nombre."_idUser".$idUsuario.".".$extension;
                $directorioNuevaFoto=str_replace(" ", "_", $directorioNuevaFoto);
                move_uploaded_file($foto["tmp_name"], $directorioNuevaFoto);

                //Ahora se pone el directorio de la imagen en Foto con el usuario con ID
                $prepare=$this->mysqli->prepare("UPDATE Usuarios SET Foto=? WHERE ID=?");
                $prepare->bind_param("si", $directorioNuevaFoto, $idUsuario);
                $prepare->execute();
            //}
        }
    }

    function addFabricante($idUsuario, $nombre, $face, $tw, $yt, $web){
        $usuario=$this->getUsuario($idUsuario);

        if($usuario["ID"]!=-1 and $usuario["esGestor"]==1){

            $prepare=$this->mysqli->prepare("INSERT INTO Fabricante (Nombre, Facebook, Twitter, Youtube, `Pagina oficial`) VALUES (?,?,?,?,?)");
            $prepare->bind_param("sssss", $nombre, $face, $tw, $yt, $web);
            $prepare->execute();
        }
    }

    function existeFabricante($nombre){
        $res=-1;

        $prepare=$this->mysqli->prepare("SELECT COUNT(*) FROM Fabricante WHERE Nombre=?");
        $prepare->bind_param("s", $nombre);
        $prepare->execute();

        $query=$prepare->get_result();
    
        if($query->num_rows > 0){
            $res=$query->fetch_assoc();
            $res=$res["COUNT(*)"];
        }

        //PARTE NUEVA
        if($res<=0)
            $res=false;
        else 
            $res=true;

        return $res;
    }    

    function deleteFabricante($idUsuario, $nombre){
        $usuario=$this->getUsuario($idUsuario);

        if($usuario["ID"]!=-1 and $usuario["esGestor"]==1){
            $prepare=$this->mysqli->prepare("DELETE FROM Fabricante WHERE Nombre=?");
            $prepare->bind_param("s", $nombre);
            $prepare->execute();     
        }         
    }

    function insertProducto($idUsuario, $nombre, $precio, $descripcion, $tituloTop, $idFabricante, $foto){
        $res=-1;
        $usuario=$this->getUsuario($idUsuario);

        if($usuario["ID"]!=-1 and $usuario["esGestor"]==1){
            $prepare=$this->mysqli->prepare("INSERT INTO Productos (Nombre, Precio, Descripción, `Titulo pagina`, Nombre_Fabricante) VALUES (?,?,?,?,?)");
            $prepare->bind_param("sdsss", $nombre, $precio, $descripcion, $tituloTop, $idFabricante);
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
                    //move_uploaded_file($foto["tmp_name"][$i], "static/images/".$foto["name"][$i]);
                    $extension=end(explode(".", $foto["name"][$i]));
                    $nombre=explode(".", $foto["name"][$i])[0];
    
                    $directorioNuevaFoto="static/images/".$nombre."_".$idProducto.".".$extension;
                    $directorioNuevaFoto=str_replace(" ", "_", $directorioNuevaFoto);
                    move_uploaded_file($foto["tmp_name"][$i], $directorioNuevaFoto);

                    $prepare=$this->mysqli->prepare("INSERT INTO Imagenes (ID_Producto, `Ruta Imagen`) VALUES (?,?)");
                    $prepare->bind_param("is", $idProducto, $directorioNuevaFoto);
                    $prepare->execute();
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
        $super=$this->getUsuario($idSuperusuario);
        $usuario=$this->getUsuario($idUsuario);

        if($super["ID"]!=-1 and $super["esSuperusuario"]==1 and $usuario["ID"]!=-1){
            $prepare=$this->mysqli->prepare("UPDATE Usuarios SET esModerador=?,esGestor=?,esSuperusuario=? WHERE ID=?");
            $prepare->bind_param("iiii", $moderador, $gestor, $superusuario, $idUsuario);
            $prepare->execute();     
        }        
    }

    function insertarComentarioImagen($idUsuario, $idProducto, $ruta, $comentario){
        $usuario=$this->getUsuario($idUsuario);

        if($usuario["ID"]!=-1 and $usuario["esGestor"]==1){
            //var_dump de todos los argumentos
            //var_dump($idUsuario, $idProducto, $ruta, $comentario);

            $prepare=$this->mysqli->prepare("UPDATE Imagenes SET Descripcion=? WHERE ID_Producto=? AND `Ruta Imagen`=?");
            $prepare->bind_param("sss", $comentario, $idProducto, $ruta);
            $prepare->execute();
        }
    }

    function existeProductoNombre($nombre){
        $res=-1;

        $prepare=$this->mysqli->prepare("SELECT COUNT(*) FROM Productos WHERE Nombre=?");
        $prepare->bind_param("s", $nombre);
        $prepare->execute();

        $query=$prepare->get_result();
    
        if($query->num_rows > 0){
            $res=$query->fetch_assoc();
            $res=$res["COUNT(*)"];
        }

        //PARTE NUEVA
        if($res<=0)
            $res=false;
        else 
            $res=true;

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

    function insertEtiquetas($idUsuario, $idProducto, $etiquetas){
        //$etiquetas=explode(",", $etiquetas);
        $usuario=$this->getUsuario($idUsuario);
    
        if($usuario["ID"]!=-1 and $usuario["esGestor"]==1){
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
    
        $prepare=$this->mysqli->prepare("SELECT Nombre FROM Etiquetas WHERE ID_Producto=?");
        $prepare->bind_param("i", $idProducto);
        $prepare->execute();
    
        $query=$prepare->get_result();
    
        if($query->num_rows > 0){
            $etiquetas=$query->fetch_all(MYSQLI_ASSOC);
        }
    
        return $etiquetas;
    } 
    
    function deleteEtiqueta($idUsuario, $idProducto, $etiqueta){
        $usuario=$this->getUsuario($idUsuario);
    
        if($usuario["ID"]!=-1 and $usuario["esGestor"]==1){
            $prepare=$this->mysqli->prepare("DELETE FROM Etiquetas WHERE ID_Producto=? AND Nombre=?");
            $prepare->bind_param("is", $idProducto, $etiqueta);
            $prepare->execute();
        }
    }

    function getAllPaises(){
        $paises=false;
        
        $prepare=$this->mysqli->prepare("SELECT * FROM Pais ORDER BY CountryName");
        $prepare->execute();
        
        $query=$prepare->get_result();
        
        if($query->num_rows > 0){
            $paises=$query->fetch_all(MYSQLI_ASSOC);
        }
        
        return $paises;
    }

    function getPais($idPais){
        //var_dump($idPais);
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
}


//Para getComentariosConProducto
//SELECT Productos.Nombre,Comentario.ID,Usuarios.Nombre,Correo,Fecha,Texto FROM Comentario,Usuarios,Productos WHERE Comentario.ID_Usuario=Usuarios.ID AND Productos.ID=Comentario.ID_Producto ORDER BY Comentario.ID DESC;

?>