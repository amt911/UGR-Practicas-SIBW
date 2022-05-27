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
        $prepare=$this->mysqli->prepare("SELECT ID,Nombre,DATE_FORMAT(Fecha, '%d de %M del %Y, %k:%i') AS Fecha,Texto,Correo FROM Comentario WHERE ID_Producto=? ORDER BY ID DESC");
        $prepare->bind_param("i", $idProducto);
        $prepare->execute();

        $query=$prepare->get_result(); 

        if($query->num_rows > 0)
            $res=$query->fetch_all(MYSQLI_ASSOC);

        return $res;
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
        $res=false;

        $prepare=$this->mysqli->prepare("SELECT COUNT(*) FROM Usuarios WHERE Correo=? AND Password=?");
        $prepare->bind_param("ss", $correo, $pass);
        $prepare->execute();

        $query=$prepare->get_result();

        if($query->fetch_assoc()["COUNT(*)"]==1)
            $res=true;

        return $res;
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
            $prepare=$this->mysqli->prepare("INSERT INTO Comentario VALUES(?, DEFAULT, NOW(), ?, ?, ?)");

            $prepare->bind_param("sssi", $usuario["Nombre"], $comentario, $usuario["Correo"], $producto);

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
        $lista=["Foto", "Nombre", "Correo", "Pais", "Genero", "Direccion", "Password"];

        $usuario=$this->getUsuario($id);

        if($usuario["ID"]!=-1 and in_array($campo, $lista, true)){
            $prepare=$this->mysqli->prepare("UPDATE Usuarios SET $campo=? WHERE ID=?");
            $prepare->bind_param("si", $nuevoNombre, $id);
            $prepare->execute();
        }        
    }


    function actualizarFotoPerfil($idUsuario, $ruta){
        $user=$this->getUsuario($idUsuario);

        if($user["ID"]!=-1){
            $prepare=$this->mysqli->prepare("UPDATE Usuarios SET Foto=? WHERE ID=?");
            $prepare->bind_param("si", $ruta, $idUsuario);
            $prepare->execute();            
        }
    }

    function cambiarDatosProducto($idUsuario, $idProducto, $precio, $nombre, $descripcion, $tituloTop){
        $usuario=$this->getUsuario($idUsuario);
        $existeProd=$this->existeProducto($idProducto);
        //echo "me gusta esto";
        //var_dump($usuario);
        //var_dump($existeProd);
        //var_dump($idProducto);
        if($usuario["ID"]!=-1 and $usuario["esGestor"]==1 and $existeProd){
            //echo "mp";
            $prepare=$this->mysqli->prepare("UPDATE Productos SET  Precio=?,Nombre=?,Descripción=?,`Titulo pagina`=? WHERE ID=?");
            $prepare->bind_param("dsssi", $precio, $nombre, $descripcion, $tituloTop, $idProducto);
            $prepare->execute();     
        }
    }
}
?>