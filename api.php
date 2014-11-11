<?php
    include "/core/ConexionMySQL.php";
    include "/core/Entidad.php";
    include "/core/Recurso.php";
    include "/entidades/Comentario.php";
    include "/entidades/Comentario_Anonimo.php";
    include "/entidades/Comentario_Registrado.php";
    include "/entidades/Precio.php";
    include "/entidades/Producto.php";
    include "/entidades/Usuario.php";
    include "/entidades/Tipo_Producto.php";
    include "/lib/Metricas.php";
    include "/recursos/Comentarios.php";
    include "/recursos/ComentariosAnonimo.php";
    include "/recursos/ComentariosUsuariosRegistrados.php";
    include "/recursos/Productos.php";
    include "/recursos/Precios.php";
    include "/recursos/Usuarios.php";
    include "/recursos/TiposProducto.php";
    
    session_start();

    header('Content-Type: application/json');

    $url = $_SERVER['REQUEST_URI'];
    $split = explode('/', explode('?', $url)[0]);
    $entidad = null;
    $param = null;
    $metodo = null;

    $urlSegurizadas = array(
        "precios"=> array("crear", "obtenerPorProductoUsuario"),
        "productos"=>array("crear", "obtenerDetallePorUsuario"),
        "usuarios"=>array("logout", "userInfo"),
    );

    $indices = array_keys($urlSegurizadas);

    if(in_array($entidad, $indices)){
        $entidadSegurizada = $urlSegurizadas[$entidad];
        if(in_array($param, $entidadSegurizada)){
            if(! isset($_SESSION['usr'])){
                http_response_code(401);
                echo json_encode(array(), JSON_FORCE_OBJECT);
            }else{
                usarMetodo($split);
            }
        }
    }else{
        usarMetodo($split);
    }


    function usarMetodo($valores){
        foreach ($valores as $key => $value) {
            switch($key){
                case '2':
                    $entidad = $value;
                    break;
                case '3':
                    $param =  $value;
                    break;
            }
        }

        switch ($_SERVER['REQUEST_METHOD']) {  
            case "GET":
                echo get($entidad, $param);
            break;
            case "POST":  
                echo post($entidad, $param);
            break;  
        }
    }
    
    function post($entidadParam, $param){
        $retorno = array();
        switch ($entidadParam) {
            case 'comentarios':
                $recurso = new Recurso_Comentarios();
                switch($param){
                    case 'crear':
                        $idUsuario = null;
                        $comentario = substr($_POST['comentario'], 0, 200);
                        if(strlen(trim($comentario)) > 0){
                            if(isset($_SESSION['usr'])){
                                $idUsuario = $_SESSION['usr'];
                            }
                            $recurso->crear($_POST['idProducto'], $comentario, $idUsuario, $_POST['nickname']);
                        }else{
                            http_response_code(400);
                        }
                    break;
                }
            break;
            case 'precios':
                $recurso = new Recurso_Precios();
                switch($param){
                    case 'crear':
                        $recurso->idProducto = $_POST['idProducto'];
                        $recurso->monto = $_POST['precio'];
                        $recurso->idUsuario = $_SESSION['usr'];
                        $exitoso = $recurso->crear();
                    break;
                }
            break;
            case 'productos':
                $recurso = new Recurso_Productos();
                switch($param){
                    case 'crear':
                        $exitoso = $recurso->crear($_POST['tipo'], $_POST['descripcion'], $_POST['precio']);
                    break;
                }
            break;
            case 'usuarios':
                $recurso = new Recurso_Usuarios();
                switch($param){
                    case 'crear':
                        if(validarUsuario()){
                            $email = $_POST['email'];
                            if($recurso->obtenerPorEmail($email)){
                                http_response_code(409);
                            }else{
                                $password = generarPasswordEncriptado($email, $_POST['contrasena']);
                                $exitoso = $recurso->crear($email, $password, $_POST['nombre'], $_POST['apellido']);
                                if(isset($exitoso)){
                                    $retorno = array("id"=>$recurso->id);
                                }
                            }
                        }else{
                            http_response_code(400);
                        }
                    break;
                    case 'login':
                        $basic = preg_split('/&/', base64_decode($_POST['basic']));
                        $email = $basic[0];
                        $password = generarPasswordEncriptado($basic[0], $basic[1]);
                        $idUsuario = $recurso->login($email, $password);
                        if($idUsuario == null){
                            http_response_code(401);
                        }else{
                            http_response_code(204);
                            $_SESSION['usr'] = $idUsuario;
                        }
                    break;
                    case 'logout':
                        session_destroy();
                    break;
                }
            break;
        }

        return json_encode($retorno, JSON_FORCE_OBJECT);
    }

    function get($entidadParam, $param){
        $retorno = array();
        switch ($entidadParam) {
            case 'precios':
                $recurso = new Recurso_Precios();
                switch($param){
                    case 'obtenerPorProducto':
                        $retorno = $recurso->obtenerPorProducto();
                    break;
                    case 'obtenerPorProductoUsuario':                        
                        $precio = new Recurso_Precios();
                        $precio->idProducto = $_GET['idProducto'];
                        $precio->idUsuario = $_SESSION['usr'];
                        $retorno = $precio->obtenerPorProductoUsuario();
                    break;  
                }
            break;
            case 'tiposProducto':
                $recurso = new Recurso_Tipos_Producto();
                switch($param){
                    case 'obtenerTodos':
                        $retorno = $recurso->obtenerTodos();
                    break;
                }
            break;
            case 'usuarios':
                $recurso = new Recurso_Usuarios();
                switch($param){
                    case 'userInfo':
                        if(isset($_SESSION['usr'])){
                            $recurso->id = $_SESSION['usr'];
                            $retorno = $recurso->obtener();
                        }else{
                            http_response_code(401);
                        }
                    break;
                }
            break;
            case 'productos':
                $recurso = new Recurso_Productos();
                switch($param){
                    case 'obtenerTodos':
                        $retorno = $recurso->obtenerTodosPorTipo($_GET["tipo"]);
                    break;
                    case 'obtenerDetalle':
                        $recurso->id = $_GET['id'];
                        $retorno = $recurso->obtener();
                        
                        $precio = new Recurso_Precios();
                        $precio->idProducto = $_GET['id'];

                        $fecha = $_GET['fecha'];
                        if($fecha == null){
                            $fecha = new DateTime("now");
                        }else{
                            $fecha = DateTime::createFromFormat('d/m/Y', $fecha);    
                            $hoy = new DateTime("now");
                            if($fecha->format('d/m/Y') == $hoy->format('d/m/Y')){
                                $fecha = $hoy;
                            }
                        }
                        $precios = $precio->obtenerPorSemana($fecha);
                        if(count($precios)> 0){
                            $retorno->precio = new Metricas($precios);
                        }
                        $comentario = new Recurso_Comentarios();
                        $comentario->idProducto = $_GET['id'];
                        $comentario->fecha = $_GET['fecha'];
                        $comentarios = $comentario->obtenerPorSemana();
                        
                        foreach ($comentarios as $key => $value) {
                            $anonimo = new Recurso_Comentarios_Anonimos();
                            $anonimo->id = $value->id;
                            $recurso = $anonimo->obtener();
                            if($recurso != null){
                                $comentarios[$key]->anonimo = $recurso->nickName;
                            }else{
                                $registrado = new Recurso_Comentarios_Usuarios_Registrados();
                                $registrado->id = $value->id;
                                $recurso = $registrado->obtener();
                                if($recurso != null){
                                    $usuario = new Recurso_Usuarios();
                                    $usuario->id = $recurso->idUsuario;
                                    $usuario->obtener();
                                    $comentarios[$key]->registrado = $usuario->nombre ." ". $usuario->apellido;
                                }
                            }
                        }
                        $retorno->comentarios = $comentarios;
                    break;
                    case 'obtenerDetallePorUsuario':
                        $recurso->id = $_GET['id'];
                        $retorno = $recurso->obtener();

                        $tipo = new Recurso_Tipos_Producto();
                        $tipo->id = $retorno->tipo;
                        $retorno->tipo = $tipo->obtenerPorId();
                        
                        $precio = new Recurso_Precios();
                        $precio->idProducto = $_GET['id'];
                        $precio->IdUsuario = $_SESSION['usr'];
                        $retorno->precios = $precio->obtenerPorProductoUsuario();

                    break;  
                }
            break;
        }
        return json_encode($retorno, JSON_FORCE_OBJECT);
    }

    function validarUsuario(){
        if(strlen(trim($_POST['email'])) == 0 ){
            return false;
        }
        if(strlen(trim($_POST['contrasena'])) == 0 ){
            return false;
        }
        if(strlen(trim($_POST['confirmacion'])) == 0 ){
            return false;
        }
        if(strlen(trim($_POST['nombre'])) == 0 ){
            return false;
        }
        if(strlen(trim($_POST['apellido'])) == 0 ){
            return false;
        }
        if($_POST['contrasena'] != $_POST['confirmacion']){
            return false;
        }
        return true;
    }

    function generarPasswordEncriptado($email,$password){
        $saltKey = "SCAW2014%";
        return MD5($email. $password . $saltKey);
    }
 ?>