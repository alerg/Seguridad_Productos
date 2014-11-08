jQuery(document).ready(function(){

	var idProducto = sessionStorage.getItem("idProducto");
	if(idProducto){
		//TODO
		//sessionStorage.removeItem("idProducto");
	}

	jQuery('[data-interactive="tipo"]').change(function(){
		jQuery('[data-interactive="tipo"] option:selected').each(function() {
			
			jQuery('[data-interactive="contenedor"]').attr('data-mode', 'buscar');

			buscarProductos(jQuery(this).val());

	    });
	});

	var buscarPrecios = function(idProducto){
		var precios = new Precio();
		precios.obtenerPorProductoUsuario(
			{
				idProducto:idProducto
			}, function(error, data){
				if(data){
					jQuery('[data-interactive="precios"]').removeClass('hide');
					for(var index in data){
						var precioHTML = '<div class="comentario">'+
							'<header>$'+ data[index].monto +'</header>';

						if(data[index].modificable){
							var precioHTML = precioHTML + '<button data-interactive="modificar" producto="'+ data[index].idProducto +'">Modificar</button>';
						}

						var precioHTML = precioHTML + '<footer>'+ data[index].fecha +'hs.</footer>'+
						'</div>';
						jQuery('[data-interactive="precios"]').append(precioHTML);

						jQuery('[data-interactive="modificar"]').click(function(){
							sessionStorage.setItem("idProducto", jQuery(this).attr("producto"));
							location.href = "/cargar_precio";
						});		
					}
				}
		});
	}

	var buscarProductos = function(idTipo, idProducto){
		var producto = new Producto();
		producto.tipo = idTipo;

		producto.obtenerTodos(function(data){
			
			jQuery('[data-interactive="producto"]').removeClass('hide');

			if(data){
				limpiarSelect('[data-interactive="productoSelect"]');
				for(var index in data){
					jQuery('[data-interactive="productoSelect"]').append('<option value="'+ data[index].id +'">'+ data[index].descripcion +'</option>');
					if(idProducto && idProducto == data[index].id){
						jQuery('[data-interactive="producto"] option[value="'+ idProducto +'"]').prop('selected', true);
						buscarPrecios(idProducto);
					}
				}
				jQuery('[data-interactive="producto"]').change(function(){

					jQuery('[data-interactive="producto"] option:selected').each(function() {
						buscarPrecios(jQuery(this).val());
					});
				});	     	
			}else{
				alert("No hay productos del tipo especificado.");
			}
		});			
	}

	var tipo = new TiposProducto();
	tipo.obtenerTodos(function(data){
		if(data){

			if(idProducto){
				var producto = new Producto();
				producto.obtenerDetallePorUsuario({id:idProducto}, function(data){
					if(data == false){
						alert('No existen productos con ese nombre.');
					}else{
						jQuery('[data-interactive="tipo"] option[value="'+ data.tipo.id +'"]').prop('selected', true);

						buscarProductos(data.tipo.id, idProducto);
					}
				});
			}

			limpiarSelect('[data-interactive="tipo"]');
			for(var index in data){
				jQuery('[data-interactive="tipo"]').append('<option value="'+ data[index].id +'">'+ data[index].descripcion +'</option>');
			}
		}else{
			alert("No hay productos del tipo especificado.");
		}
	});

	var limpiarSelect = function(selector){
		
		jQuery(selector +' option').each(function() {
			if(jQuery(this).val() != "")
				jQuery(this).remove();
		});
	}
});