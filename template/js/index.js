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
		var nombre = jQuery('[data-interactive="producto"]').val();
		producto.obtenerTodosPorNombre(nombre, function(data){
			if(data == false){
				alert('No existen productos con ese nombre.');
			}else{

			}
		});
	});

	jQuery('[data-interactive="contenedor"]').attr('data-mode', 'inicial');
});