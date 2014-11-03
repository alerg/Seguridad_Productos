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

	jQuery('[data-interactive="formBuscar"]').submit(function(e){
		e.preventDefault();
		var producto = new Producto();
		var idProducto;
		jQuery('[data-interactive="product"] option:selected').each(function() {
			idProducto = jQuery(this).val();
		});
		var fecha = jQuery('[data-interactive="semana"]').val();

		producto.obtenerDetalle({
				id:idProducto, 
				fecha:fecha
			}, function(data){
			if(data == false){
				alert('No existen productos con ese nombre.');
			}else{
				if(data.precio){
					jQuery('[data-interactive="maximo"]').html(data.precio.maximo);
					jQuery('[data-interactive="minimo"]').html(data.precio.minimo);
					jQuery('[data-interactive="promedio"]').html(data.precio.promedio);
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
				jQuery('[data-interactive="contenedor"]').attr('data-mode', 'datos');
			}
		});
	});

	jQuery('[data-interactive="contenedor"]').attr('data-mode', 'inicial');
	jQuery('[data-interactive="product"]').change(function(){
		jQuery('[data-interactive="product"] option:selected').each(function() {
			jQuery('[data-interactive="contenedor"]').attr('data-mode', 'buscar');
			var producto = new Producto();
			var idProducto = jQuery(this).val();

			producto.obtenerDetalle({
				id:idProducto, 
				fecha:null
			}, function(data){
				//TODO: agregar precios por defecto.
			});	     	
	    });
	});
	

	var producto = new Producto();
	producto.obtenerTodos(function(data){
		if(data == false){
			alert('No existen productos con ese nombre.');
		}else{
			for(var index in data){

				jQuery('[data-interactive="product"]').append('<option value="'+ data[index].id +'">'+ data[index].descripcion +'</option>');
			}
			/*
				var productoHTML = '<div class="columna columna--simple">'+
					'<h3 id="nombre" data-interactive="nombre">'+ data[index].descripcion +'</h3>'+
				'</div>';
				if(data[index].precio){
					productoHTML += '<div class="columna columna--triple">'+
						'<label>Precio m&aacute;ximo</label>'+
						'<span id="maximo" class="estadistica" data-interactive="maximo">$maximo</span>'+
					'</div>'+
					'<div class="columna columna--triple">'+
						'<label>Precio m&iacute;nimo</label>'+
						'<span id="minimo" class="estadistica" data-interactive="minimo">$minimo</span>'+
					'</div>'+
					'<div class="columna columna--triple">'+
						'<label>Precio promedio</label>'+
						'<span id="promedio" class="estadistica" data-interactive="promedio">$promedio</span>'+
					'</div>';
				}
				jQuery('[data-interactive="productos"]').html(productoHTML);
			*/
		}
	});
});