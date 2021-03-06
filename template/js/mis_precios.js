jQuery(document).ready(function(){

	var idProducto = sessionStorage.getItem("idProducto");
	if(idProducto){
		sessionStorage.removeItem("idProducto");
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
				
				var existenPrecios = false;
				for(var index in data){
					existenPrecios = true;
					var precioHTML = '<div class="precio">'+
						'<span class="precio__valor">$'+ data[index].monto +'</span>';

					var precioHTML = precioHTML + '<span class="precio__fecha">'+ data[index].fecha +'hs</span>';
					
					if(data[index].modificable){
						var precioHTML = precioHTML + '<button data-interactive="modificar" producto="'+ data[index].idProducto +'" class="boton">Modificar</button>';
					}
					
					var precioHTML = precioHTML + '</div>';
					
					jQuery('[data-interactive="precios"]').append(precioHTML);

					jQuery('[data-interactive="modificar"]').click(function(){
						sessionStorage.setItem("idProducto", jQuery(this).attr("producto"));
						location.href = "/template/cargar_precio.php";
					});		
				}

				if(!existenPrecios){
					jQuery('[data-interactive="precios"]').addClass('hide');
					jQuery('[data-interactive="precios"]').html('');
					alert("No se encontraron precios para el producto seleccionado.");
				}else{
					jQuery('[data-interactive="precios"]').removeClass('hide');
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
						alert('Ocurrió un error al buscar el pruducto seleccionado');
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