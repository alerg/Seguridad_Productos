jQuery(document).ready(function(){

	var idProducto = sessionStorage.getItem("idProducto");
	if(idProducto){
		sessionStorage.removeItem("idProducto");
	}else{
		location.href="/template/index.php";
	}

	jQuery('[data-interactive="agregar"]').click(function(e){
		e.preventDefault();
		
		var precio = new Precio();

		var descripcion = jQuery('[data-interactive="descripcion"]').val();
		var monto = jQuery('[data-interactive="precio"]').val();

		precio.crear({
				idProducto: idProducto,
				precio: monto
			}, function(error, success){
			if(error){
				alert('No se puede cargar un nuevo precio producto seleccionado.');
			}else{
				alert("Precio agregado exitosamente");
				location.href = "/template/index.php";
			}
		});
	});

	var producto = new Producto();
	producto.obtenerDetallePorUsuario({id:idProducto}, function(data){
		if(data == false){
			alert('No existen productos con ese nombre.');
		}else{
			jQuery('[data-interactive="tipo"]').val(data.tipo.descripcion);
			jQuery('[data-interactive="producto"]').val(data.descripcion);
			var precio = new Precio();
			precio.obtenerPorSemanaPorUsuario(idProducto, function(error, data){
				if(error){
					location.href = "/template/index.php";
				}else{
					alert("Ya posee un precio ingresado para el producto seleccionado. En caso de continuar se modificará.");
				}
			});
		}
	});
});