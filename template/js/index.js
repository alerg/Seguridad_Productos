jQuery(document).ready(function(){

	$('[data-interactive="semana"]').datepicker({ 
		showWeek:true,
		dateFormat: "dd/mm/yy",
		dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
		monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
		monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dec" ],
		changeYear: true,
		changeMonth: true,
		maxDate:0,
		minDate: new Date(2014, 10, 01),
		weekHeader:'Semana'
	});

    $('[data-interactive="semana"]').datepicker("setDate", new Date());

	jQuery('[data-interactive="contenedor"]').attr('data-mode', 'inicial');
	
	jQuery('[data-interactive="tipo"]').change(function(){
		jQuery('[data-interactive="tipo"] option:selected').each(function() {
			jQuery('[data-interactive="producto"]').removeClass('hide');
			jQuery('[data-interactive="contenedor"]').attr('data-mode', 'buscar');

			//var producto = new Producto();
			//producto.tipo = jQuery(this).val();
			buscarProductos(jQuery(this).val());
			jQuery('[data-interactive="buscarProducto"]').click(function(e){
				e.preventDefault();
				buscarDetalle();
			});
	    });
	});

	function buscarDetalle(){

		var producto = new Producto();
		var idProducto;
		jQuery('[data-interactive="producto"] option:selected').each(function() {
			idProducto = jQuery(this).val();
		});
		var fecha = jQuery('[data-interactive="semana"]').val();

		producto.obtenerDetalle({
				id:idProducto, 
				fecha:fecha
			}, function(data){

			if(data){

				jQuery('[data-interactive="cargarPrecio"]').click(function(e){
					e.preventDefault();

					sessionStorage.setItem("idProducto", idProducto);
					location.href = "/template/cargar_precio.php";
				});


				if(data.precio){
					jQuery('[data-interactive="maximo"]').html(Math.round(parseFloat(data.precio.maximo) * 100) / 100);
					jQuery('[data-interactive="minimo"]').html(Math.round(parseFloat(data.precio.minimo) * 100) / 100);
					jQuery('[data-interactive="promedio"]').html(Math.round(parseFloat(data.precio.promedio) * 100) / 100);

					jQuery('[data-interactive="contenedor"]').attr('data-mode', 'datos');
				}else{
					jQuery('[data-interactive="contenedor"]').attr('data-mode', 'sin precio');
				}
				jQuery('[data-interactive="comentarios"]').html('');
				if(data.comentarios){
				
					jQuery('[data-interactive="comentarios"]').html('<h4>Comentarios</h4>');
					
					for(var index in data.comentarios){
						var comentarioHTML = '<div class="comentario"><header>';

							if(data.comentarios[index].anonimo){
								comentarioHTML = comentarioHTML + data.comentarios[index].anonimo;
							}else{
								comentarioHTML = comentarioHTML + data.comentarios[index].registrado;
							}
							comentarioHTML = comentarioHTML + '</header><p>'+ data.comentarios[index].comentario +'.</p>'+
									'<footer>'+ data.comentarios[index].fecha +'hs.</footer>'+
								'</div>';
						jQuery('[data-interactive="comentarios"]').append(comentarioHTML);		
					}
				}
				
				jQuery('[data-interactive="comentarios"]').append('<textarea data-interactive="comentariotext" class="agregar-comentario" name="comentario" placeholder="Escribí un comentario"></textarea><input placeholder="nickname" data-interactive="nick"/><button class="boton" data-interactive="crearComentario">Enviar</boton>');
				
				var usuario = new Usuario();
				usuario.userInfo(function(error, estaLoggeado){
					if(estaLoggeado){
						jQuery('[data-interactive="nick"]').addClass('hide');
					}
				});

				jQuery('[data-interactive="crearComentario"]').click(function(){
					var comentario = jQuery('[data-interactive="comentariotext"]').val();
					comentario = comentario.trimLeft().trimRight().replace(/\s\s/g, " ").replace(/\s\s/g, " ");
					var comentarioObj = new Comentarios();						
					comentarioObj.comentario = comentario;
					comentarioObj.idProducto = idProducto;
					comentarioObj.nickname = jQuery('[data-interactive="nick"]').val();
					comentarioObj.crear(function(err){
						if(err){
							alert("Lo sentimos. No pudimos agregar tu comentario. Intentalo luego.");
						}else{
							alert("Comentario agregado");
							sessionStorage.setItem("ip", btoa(idProducto));
							sessionStorage.setItem("if", btoa(jQuery('[data-interactive="semana"]').val()));
							location.reload();
						}
					});
				});
			}else{
				alert('Error al consultar el producto seleccionado.');
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
						jQuery('[data-interactive="buscar"]').removeClass('hide');
						buscarDetalle(idProducto);
					}
				}
				jQuery('[data-interactive="producto"]').change(function(){

					jQuery('[data-interactive="producto"] option:selected').each(function() {
						jQuery('[data-interactive="buscar"]').removeClass('hide');
						buscarDetalle(jQuery(this).val());
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
			limpiarSelect('[data-interactive="tipo"]');
			for(var index in data){
				jQuery('[data-interactive="tipo"]').append('<option value="'+ data[index].id +'">'+ data[index].descripcion +'</option>');
			}
		}else{
			alert("No hay productos del tipo especificado.");
		}
		var idProducto = sessionStorage.getItem('ip');
		if(idProducto){
			idProducto = atob(idProducto);
			var fecha = atob(sessionStorage.getItem('if')); 
			sessionStorage.removeItem("ip");
			sessionStorage.removeItem("if");
			jQuery('[data-interactive="semana"]').val(fecha);		
			var producto = new Producto();
			producto.obtenerDetalle({id:idProducto, fecha:fecha}, function(data){
				if(data == false){
					alert('Ocurrió un error al buscar el pruducto seleccionado');
				}else{
					jQuery('[data-interactive="tipo"] option[value="'+ data.tipo.id +'"]').prop('selected', true);

					buscarProductos(data.tipo, idProducto);
				}
			});
		}
	});

	var limpiarSelect = function(selector){
		
		jQuery(selector +' option').each(function() {
			if(jQuery(this).val() != "")
				jQuery(this).remove();
		});
	}
});

