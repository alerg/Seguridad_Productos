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
    
    header('Content-Type: application/json');

    $httpMetodo = $_SERVER['REQUEST_METHOD'];  
    $url = $_SERVER['REQUEST_URI'];
    $split = explode('/', explode('?', $url)[0]);
    $entidad = null;
    $param = null;
    $metodo = null;

    foreach ($split as $key => $value) {
        switch($key){
            case '2':
                $entidad = $value;
                break;
            case '3':
                $param =  $value;
                break;
        }
    }

    switch ($httpMetodo) {  
        case "GET":
            echo get($entidad, $param);
		break;
		case "POST":  
            echo post($entidad, $param);
        break;  
     }

    function post($entidadParam, $param){
        switch ($entidadParam) {
            case 'precios':
                $recurso = new Recurso_Precios();
                switch($param){
                    case 'crear':
                        $recurso->idProducto = $_POST['idProducto'];
                        $recurso->monto = $_POST['precio'];
                        //TODO usuario hardcodeade
                        $recurso->idUsuario = 1;
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
                $exitoso = $recurso->crear($_POST['email'], $_POST['contrasena'], $_POST['nombre'], $_POST['apellido']);
            break;
        }
        if(isset($exitoso)){
            $retorno = array("id"=>$recurso->id);
        }else{
            $retorno = array();
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
                        //TODO usuario hardcodeade
                        $precio->idUsuario = 1;
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
                $autorizado = $recurso->login($_GET['email'], $_GET['contrasena']);
                if(! $autorizado){
                    http_response_code(401);    
                }
                return json_encode(array(), JSON_FORCE_OBJECT);
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
                        //TODO usuario hardcodeade
                        $precio->IdUsuario = 1;
                        $retorno->precios = $precio->obtenerPorProductoUsuario();

                    break;  
                }
            break;
        }
        return json_encode($retorno, JSON_FORCE_OBJECT);
    }
 ?>