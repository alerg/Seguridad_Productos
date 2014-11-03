<?php
    include "/core/ConexionMySQL.php";
    include "/core/Entidad.php";
    include "/core/Recurso.php";
    include "/entidades/Precio.php";
    include "/entidades/Producto.php";
    include "/lib/Metricas.php";
    include "/recursos/Productos.php";
    include "/recursos/Precios.php";
    
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
            echo post($entidad);
        break;  
     }

    function post($entidadParam){
        switch ($entidadParam) {
            case 'productos':
                $recurso = new Recurso_Pasajes();
                $recurso->vuelo = $_POST['vuelo'];
                $recurso->nombre = $_POST['nombre'];
                $recurso->email = $_POST['email'];
                $recurso->fecha = $_POST['fecha'];
                $recurso->dni = $_POST['dni'];
                $recurso->categoria = $_POST['categoria'];
                if($_POST['id'] == null){
                    $retorno = $recurso->crear();
                    return json_encode($recurso); 
                }else{
                    $recurso->id = $_POST['id'];
                    //Modificar
                }
            break;
        }
        return json_encode($recurso);
    }

    function get($entidadParam, $param){
        $retorno = null;
        switch ($entidadParam) {
            case 'productos':
                $recurso = new Recurso_Productos();
                switch($param){
                    case 'obtenerTodos':
                        $retorno = $recurso->obtenerTodos();
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
                    break;
                }
            break;
        }
        return json_encode($retorno);
    }
 ?>