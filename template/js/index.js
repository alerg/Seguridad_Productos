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
		minDate: new Date(2014, 9, 01),
		weekHeader:'Semana'
	});

    $('[data-interactive="semana"]').datepicker("setDate", new Date());

	jQuery('[data-interactive="contenedor"]').attr('data-mode', 'inicial');
	
	jQuery('[data-interactive="tipo"]').change(function(){
		jQuery('[data-interactive="tipo"] option:selected').each(function() {
			jQuery('[data-interactive="producto"]').removeClass('hide');
			jQuery('[data-interactive="contenedor"]').attr('data-mode', 'buscar');

			var producto = new Producto();
			producto.tipo = jQuery(this).val();
			producto.obtenerTodos(function(data){
				if(data){
					limpiarSelect('[data-interactive="productoSelect"]');
					for(var index in data){
						jQuery('[data-interactive="productoSelect"]').append('<option value="'+ data[index].id +'">'+ data[index].descripcion +'</option>');
					}
					jQuery('[data-interactive="producto"]').change(function(){
						jQuery('[data-interactive="buscar"]').removeClass('hide');

						buscarProducto();

						jQuery('[data-interactive="buscarProducto"]').click(function(e){
							e.preventDefault();
							buscarProducto();
						});
					});	     	
				}else{
					alert("No hay productos del tipo especificado.");
				}
			});			

	    });
	});

	function buscarProducto(){

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

			if(data == false){
				alert('No existen precipara el producto seleccionado.');
			}else{
				if(data.precio){
					jQuery('[data-interactive="maximo"]').html(data.precio.maximo);
					jQuery('[data-interactive="minimo"]').html(data.precio.minimo);
					jQuery('[data-interactive="promedio"]').html(data.precio.promedio);

					jQuery('[data-interactive="contenedor"]').attr('data-mode', 'datos');
				}else{
					jQuery('[data-interactive="contenedor"]').attr('data-mode', 'sin precio');
				}
				if(data.comentarios){
					for(var index in data.comentarios){
						var comentarioHTML = '<div class="comentario">'+
							'<header>'+ data.comentarios[index].id +'</header>'+
							'<p>'+ data.comentarios[index].comentario +'.</p>'+
							'<footer>'+ data.comentarios[index].fecha +'hs.</footer>'+
						'</div>';
						jQuery('[data-interactive="comentarios"]').append(comentarioHTML);		
					}
				}
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
	});

	var limpiarSelect = function(selector){
		
		jQuery(selector +' option').each(function() {
			if(jQuery(this).val() != "")
				jQuery(this).remove();
		});
	}
});