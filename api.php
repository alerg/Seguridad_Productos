<?php
    include "/core/ConexionMySQL.php";
    include "/core/Entidad.php";
    include "/core/Recurso.php";
    include "/entidades/Comentario.php";
    include "/entidades/Precio.php";
    include "/entidades/Producto.php";
    include "/entidades/Usuario.php";
    include "/entidades/Tipo_Producto.php";
    include "/lib/Metricas.php";
    include "/recursos/Comentarios.php";
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
        "usuarios"=>array("userInfo"),
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
                        $exitoso = $recurso->crear($_POST['email'], $_POST['contrasena'], $_POST['nombre'], $_POST['apellido']);
                        if(isset($exitoso)){
                            $retorno = array("id"=>$recurso->id);
                        }
                    break;
                    case 'login':
                        $basic = preg_split('/&/', base64_decode($_POST['basic']));
                        $idUsuario = $recurso->login($basic[0], $basic[1]);
                        if($idUsuario == null){
                            http_response_code(401);
                        }else{
                            http_response_code(204);
                            $_SESSION['usr'] = $idUsuario;
                        }
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
                        }
                        $precios = $precio->obtenerPorSemana($fecha);
                        if(count($precios)> 0){
                            $retorno->precio = new Metricas($precios);
                        }
                        $comentario = new Recurso_Comentarios();
                        $comentario->idProducto = $_GET['id'];
                        $comentarios = $comentario->obtenerPorId();
                        if(count($comentarios)> 0){
                            $retorno->comentarios = $comentarios;
                        }
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
 ?>