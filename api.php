<?php
    include "/core/ConexionMySQL.php";
    include "/core/Entidad.php";
    include "/core/Recurso.php";
    include "/entidades/Producto.php";
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
                    case 'buscar':
                        $nombre = $_GET['nombre'];
                        $semana = $_GET['semana'];
                        $pagina = $_GET['pagina'];
                        $retorno = $recurso->buscar($nombre, $semana, $pagina);
                    break;
                    default:
                        $recurso->setCodigo($param);
                        $retorno = $recurso->obtener();
                }
            break;
        }
        return json_encode($retorno);
    }
 ?>