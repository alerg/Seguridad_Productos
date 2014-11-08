jQuery(document).ready(function(){

	var idProducto = sessionStorage.getItem("idProducto");
	if(idProducto){
		//TODO
		//sessionStorage.removeItem("idProducto");
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
				alert('No existen precipara el producto seleccionado.');
			}else{
				location.href = "/index";
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
		}
	});
});