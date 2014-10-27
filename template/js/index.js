jQuery(document).ready(function(){
	var aeropuertos =[];

	$('[data-interactive="departureDate"]').datepicker({ 
		dateFormat: "dd/mm/yy",
		dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
		monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
		monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dec" ],
		minDate: 0,
		maxDate: "+1m"
		
	});

	$('[data-interactive="birthDate"]').datepicker({ 
		dateFormat: "dd/mm/yy",
		dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
		monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
		monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dec" ],
		changeYear: true,
		changeMonth: true,
		yearRange: "-110:-18"
	});

	$('[data-interactive="vto_tarjeta"]').datepicker( {
        monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
		monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dec" ],
		changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'mm/y'
    });

	function step1(){
		Aeropuerto.obtenerTodos(function(data){
			aeropuertos = data;
			for(var index in aeropuertos){
				var option = document.createElement("option");
				option.value = aeropuertos[index].codigo;
				option.textContent = aeropuertos[index].ciudad + ' - ' + aeropuertos[index].provincia;
				jQuery('[data-interactive="origen"]').append(option);
			}
			jQuery('[data-interactive="contenedor"]').attr('data-mode', 'step1');
		});
	}

	function step2(reserva){
		cargarDatosPersonales(reserva);
		jQuery('[data-interactive="contenedor"]').attr('data-mode', 'pago');
	}

	function asientoOcupado(asientosOcupados, columna, fila, categoria){
		for (var i = 0; i < asientosOcupados.length; i++) {
			var asientoO = asientosOcupados[i];
			if(asientoO.columna == columna && asientoO.fila == fila && asientoO.categoria == categoria){
				return true;
			}
		};
		return false;
	}

	function generarPopup(url, titulo){
		var posicion_x; 
		var posicion_y; 
		var ancho = 1000;
		var alto = 500;
		posicion_x=(screen.width/2)-(ancho/2); 
		posicion_y=(screen.height/2)-(alto/2); 
		window.open(url, titulo, "width="+ancho+",height="+alto+",menubar=0,toolbar=0,directories=0,scrollbars=no,resizable=no,left="+posicion_x+",top="+posicion_y+"");		
	}

 	function step3(reserva){

		jQuery('[data-interactive="imprimir_pasaje"]').click(function(){
			generarPopup("/template/imprimir_pasaje.php?id=" + reserva.id, "Pasaje");
		});

 		var primeraSerie = ['A', 'B', 'C', 'D'];
 		var economySerie = ['V', 'W', 'X', 'Y', 'Z'];

 		var checkin = new Checkin();
 		checkin.reserva = reserva.id;

 		cargarDatosPersonales(reserva);
 		checkin.habilitadoCheckin(function (habilitado){

	 		if(habilitado){

		 		var vuelo = new Vuelo();
		 		vuelo.id = reserva.vuelo;
		 		vuelo.obtener(function(data){
		 			vuelo = data;
		 			var mapa = jQuery('[data-interactive="asientosMapa"]');
		 			var mitadAsientosPrimera = vuelo.asientos.primera.columna / 2;
		 			var asientosEconomyAgregados = false;

		 			for (var i = 0; i < vuelo.asientos.primera.columna; i++) {
						var div = document.createElement('div');
		 				div.setAttribute('class', 'columna ejecutiva');
						for (var e = 1; e <= vuelo.asientos.primera.fila; e++) {
							var id = primeraSerie[i]+e;
		 					var input = document.createElement('input');
		 					input.setAttribute('id', id);
		 					input.setAttribute('type', 'radio');
		 					input.setAttribute('name', 'asiento');
		 					input.setAttribute('value', id);
							input.setAttribute('columna', i+1);
							input.setAttribute('fila', e);
							input.setAttribute('tipoAsiento', "Primera");

							if(reserva.categoria != 'Primera' || asientoOcupado(vuelo.asientosOcupados, i+1, e, 'Primera')){
								input.setAttribute('disabled', "disabled");								
							}

							var label = document.createElement('label');
		 					label.setAttribute('for', id);
		 					label.textContent = id;
		 					
		 					div.appendChild(input);
		 					div.appendChild(label);
		 				};
		 				mapa.append(div);

		 				if(!asientosEconomyAgregados && i+1 >= mitadAsientosPrimera){
							asientosEconomyAgregados = true;

							for (var x = 0; x < vuelo.asientos.economy.columna; x++) {
								var div = document.createElement('div');
								div.setAttribute('class', 'columna economica');
								for (var y = 1; y <= vuelo.asientos.economy.fila; y++) {
									var id = economySerie[x]+y;
									var input = document.createElement('input');
									input.setAttribute('id', id);
									input.setAttribute('type', 'radio');
									input.setAttribute('name', 'asiento');
									input.setAttribute('value', id);
									input.setAttribute('columna', x+1);
									input.setAttribute('fila', y);
									input.setAttribute('tipoAsiento', "Economy");

									if(reserva.categoria != 'Economy' || asientoOcupado(vuelo.asientosOcupados, x+1, y, 'Economy')){
										input.setAttribute('disabled', "disabled");								
									}

									var label = document.createElement('label');
									label.setAttribute('for', id);
									label.textContent = id;
									
									div.appendChild(input);
									div.appendChild(label);
								};
								mapa.append(div);
							}
		 				}
					};		
 				});
 				jQuery('[data-interactive="checkinForm"]').submit(function(e){
					e.preventDefault();
					var asiento = jQuery('input:checked', e.target);
					if(asiento[0]){
	 					checkin.columna = asiento.attr('columna');
	 					checkin.fila = asiento.attr('fila');
						checkin.crear(function(data){
							if(data){
								alert("El checkin fue realizado con éxito");
								qr(reserva);
								jQuery('[data-interactive="contenedor"]').attr('data-mode', 'last');
							}
							else
								alert("Ah ocurrido un error. Intente realizar el checkin mas tarde.");
						});
					}else{
						alert("Seleccione un asiento disponible");
					}			
				});	
				jQuery('[data-interactive="contenedor"]').attr('data-mode', 'checkin');
	 		}else{
	 			alert("El check-in puede realizarse a partir de las 48hs. anteriores a la partida del vuelo");
				jQuery('[data-interactive="contenedor"]').attr('data-mode', 'data_imprimir');
	 		}
 		});
 	}

 	function cargarDatosPersonales(reserva){
 		if(reserva){
			jQuery('[data-interactive="datosReserva"]').val(reserva.id);
			jQuery('[data-interactive="datosNombre"]').val(reserva.nombre);
			jQuery('[data-interactive="datosCategoria"]').val(reserva.categoria);
			jQuery('[data-interactive="datosOrigen"]').val(reserva.aeropuertoOrigen.ciudad +' - '+ reserva.aeropuertoOrigen.provincia);
			jQuery('[data-interactive="datosDestino"]').val(reserva.aeropuertoDestino.ciudad +' - '+ reserva.aeropuertoDestino.provincia);
			jQuery('[data-interactive="datosFecha"]').val(reserva.fechaPartida);
 		}
 	}

	function qr(reserva){
		cargarDatosPersonales(reserva);
		jQuery('[data-interactive="imprimir_pasaje"]').click(function(){
			generarPopup("/template/imprimir_pasaje.php?id=" + reserva.id, "Pasaje");
		});
		jQuery('[data-interactive="boarding"]').click(function(){
			generarPopup("/template/boardingpass.php?id=" + reserva.id, 'Boarding Pass');
		});
		jQuery('[data-interactive="qr"]').click(function(){
			generarPopup("/template/qr.php?id=" + reserva.id, 'QR');
		});

		jQuery('[data-interactive="contenedor"]').attr('data-mode', 'last');
	}

	jQuery('[data-interactive="comenzar"]').click(function(e){
		e.preventDefault();
		step1();
	});

	jQuery('[data-interactive="formBuscar"]').submit(function(e){
		e.preventDefault();
		var reserva = new Reserva();
		reserva.id = jQuery('[data-interactive="codigoReserva"]').val();
		reserva.obtener(function(data){
			if(data == false){
				alert('El pasaje no existe');
			}else{
				if(reserva.vencido){
					alert('El pasaje se encuentra vencido');
				}else{
					switch(reserva.estado){
						case '0':
							step2(reserva);
						break;
						case '1':
							step3(reserva);
						break;
						case '2':
							qr(reserva);
						break;
					}
				}
			}
		});
	});

	jQuery('[data-interactive="origen"]').change(function(e){
		var select = document.querySelector('[data-interactive="destino"]');
		var longitud = select.options.length;
		if(longitud > 1 ){
			for(var index = 1 ; index < longitud ; index++){
				select.removeChild(select.options[1]);
			}
		}
		for(var index in aeropuertos){
			if(aeropuertos[index].codigo != e.target.value){
				var option = document.createElement("option");
				option.value = aeropuertos[index].codigo;
				option.textContent = aeropuertos[index].ciudad + ' - ' + aeropuertos[index].provincia;
				select.appendChild(option);
			}
		}
	});
	jQuery('[data-interactive="buscar"]').click(function(e){
		var select = jQuery('[data-interactive="vuelos"]');
		jQuery.each( select.children(), function( key, option ) {
			if(option.value!='')
				option.remove();
		});
		var vuelo = new Vuelo();
		var origen = document.querySelector('[data-interactive="origen"]').options[document.querySelector('[data-interactive="origen"]').selectedIndex].value;
		var destino = document.querySelector('[data-interactive="destino"]').options[document.querySelector('[data-interactive="destino"]').selectedIndex].value;
		var fecha = jQuery('[data-interactive="departureDate"]').val();

		vuelo.obtenerTodos(origen, destino, fecha, function(vuelos){
			jQuery.each( vuelos, function( key, vuelo ) {
				var option = document.createElement('option');
				option.textContent = 'Numero: '+ vuelo.id +' / Fecha partida: '+ vuelo.fecha;
				option.setAttribute('value', vuelo.id);
				select.append(option);
				
				if(vuelo.asientosDisponiblesPrimera > -10 ){
					//Cambio de cero a -10 para dar lugar a reservas en exceso
					jQuery('[data-interactive="primera"]').removeClass('hide');
				}
				if(vuelo.asientosDisponiblesEconomica > -10 ){
					//Cambio de cero a -10 para dar lugar a reservas en exceso
					jQuery('[data-interactive="economy"]').removeClass('hide');
				}
				
				//Agrego una clase CSS para avisar que la reserva está en exceso
				if(vuelo.asientosDisponiblesPrimera > 0 ){
					jQuery('[for="primera"]').removeClass('exceso');
				}
				if(vuelo.asientosDisponiblesEconomica > 0 ){
					jQuery('[for="economy"]').removeClass('exceso');
				}
				
				//jQuery('[data-interactive="primera"]').removeClass('hide');
				//jQuery('[data-interactive="economy"]').removeClass('hide');
			});

			if(vuelos.length == 0){
				alert("No hay vuelos para la busqueda realizada");
			}else{
				jQuery('[data-interactive="contenedor"]').attr('data-mode', 'step2');
			}
		});
	});

	jQuery('[data-interactive="reservar"]').click(function(e){
	
		var vuelo = jQuery('[data-interactive="vuelos"] option:selected').val();
		var categoria = jQuery('[name="categoria"]:checked').val();
		
		var mensajeConfirmar = '';
		
		//Validamos que los campos hayan sido completados
		if(vuelo==''){
			mensajeConfirmar = 'Seleccioná un vuelo.';
		}
		
		if(categoria==''){
			mensajeConfirmar = 'Seleccioná una categoría.';
		}
		
		if(mensajeConfirmar!=''){
			alert(mensajeConfirmar);
		}else{
			jQuery('[data-interactive="contenedor"]').attr('data-mode', 'step3');
		}
	});

	jQuery('[data-interactive="confirmar"]').click(function(e){
		e.preventDefault();
		var vuelo = jQuery('[data-interactive="vuelos"] option:selected').val();
		var nombre = jQuery('[data-interactive="nombre"]').val();
		var email = jQuery('[data-interactive="email"]').val();
		var fecha = jQuery('[data-interactive="birthDate"]').val();
		var dni = jQuery('[data-interactive="dni"]').val();
		var categoria = jQuery('[name="categoria"]:checked').val();

		var mensajeConfirmar = '';
		
		//Validamos que los campos hayan sido completados
		if(vuelo==''){
			mensajeConfirmar = 'Seleccioná un vuelo.';
		}
		
		if(categoria==''){
			mensajeConfirmar = 'Seleccioná una categoría.';
		}
		
		if(fecha==''){
			mensajeConfirmar = 'Ingresá tu fecha de nacimiento.';
		}
		
		if(dni==''){
			mensajeConfirmar = 'Ingresá tu DNI.';
		}
		
		if(email==''){
			mensajeConfirmar = 'Ingresá una dirección de correo electrónico.';
		}
		
		if(nombre==''){
			mensajeConfirmar = 'Ingresá tu nombre.';
		}
		
		if(mensajeConfirmar!=''){
			alert(mensajeConfirmar);
		}else{
		
			var reserva = new Reserva(vuelo, nombre, email, fecha, dni, categoria);

			reserva.crear(function(){
				sessionStorage.setItem("reserva",reserva.id);
				console.log('Reserva numero: ' + reserva.id);
				if(reserva.id != null){
					jQuery('[data-interactive="fieldDatosPersonales"]').addClass('hide');
					step2(reserva);
				}
			});
		}
 	});

	jQuery('[data-interactive="formas_pago"]').change(function(e){
		if(jQuery(e.target).val() == "1"){
			jQuery('[data-interactive="datosTarjeta"]').removeClass('hide');
		}else{
			jQuery('[data-interactive="datosTarjeta"]').addClass('hide');
		}
	});

 	jQuery('[data-interactive="formPagar"]').submit(function(e){
 		e.preventDefault();
 		var reservaId = sessionStorage.getItem("reserva");
 		var formaPagoId = jQuery('[data-interactive="formas_pago"]').val();
 		if( formaPagoId == "1" && reservaId != null){
			var pago = new Pago(reservaId, formaPagoId);

			pago.crear(function(pago){
				if(pago){
					var reserva = new Reserva();
					reserva.id = reservaId;
					reserva.obtener(function(){
						step3(reserva);
					});
				}else{
					console.log('Error al pagar');
				}
			});
 		}
 	});

	jQuery('[data-interactive="contenedor"]').attr('data-mode', 'inicial');
});