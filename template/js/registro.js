jQuery(document).ready(function(){
	jQuery('[data-interactive="registrarForm"]').submit(function(e){
		e.preventDefault();
		var campos = ['[data-interactive="email"]',
						'[data-interactive="nombre"]',
						'[data-interactive="apellido"]',
						'[data-interactive="contrasena"]',
						'[data-interactive="contrasena2"]'];

		var email = jQuery('[data-interactive="email"]').val();
		var nombre = jQuery('[data-interactive="nombre"]').val();
		var apellido = jQuery('[data-interactive="apellido"]').val();
		var password = jQuery('[data-interactive="contrasena"]').val().trim();
		var password2 = jQuery('[data-interactive="contrasena2"]').val().trim();

		for (var i =0; i < campos.length ; i++) {
			var valor = jQuery(campos[i]).val();
			if(esVacio(valor)){
				jQuery(campos[i]).val('');
				jQuery(campos[i]).focus();
				var nombre = jQuery(campos[i]).attr('nombre');
				alert("Verifique que el campo "+ nombre +" no este vacío.");
				return;
			}
		};

		if(! esValidoPassword(password, password2)){
			return;
		}

		var usuario = new Usuario();
		usuario.email = email;
		usuario.contrasena = password;
		usuario.nombre = nombre;
		usuario.apellido = apellido;
		usuario.confirmacion = password2;

		usuario.crear(function(error, data){
			if(error){
				if(error.error == 'CONFLICT'){
					alert('Ya existe un usuario con el email especificado');
				}else{
					alert("Ah ocurrido un error inesperado. Verifique los datos y vuelva a intertarlo.");
				}
			}else{
				usuario.login(function(err){
					if(err){
						alert("Ah ocurrido un error al intentar loggear al usuario.");
					}
					location.href = "/template/index.php";
				});
			}
		});
	});
});

function esValidoPassword(password, confirmacion){
	if(password.match(/\s/g)){
		alert("La contraseña no debe contener espacios.");
		jQuery('[data-interactive="contrasena"]').val('');
		jQuery('[data-interactive="contrasena2"]').val('');
		jQuery('[data-interactive="contrasena"]').focus();
		return false;
	}
	if(password.length < 8 || password.length > 30){
		alert("La contraseña debe tener de 8 caracteres a 30 caracteres sin espacios.");
		jQuery('[data-interactive="contrasena"]').focus();
		return false;
	}

	if(password.trim() != confirmacion.trim()){
		alert("Verifique que la confirmación sea igual a la contraseña");
		jQuery('[data-interactive="contrasena2"]').focus();
		return false;
	}

	return true;
}

function esVacio(valor){
	if(valor.trim() == ""){
		return true;		
	}
	return false;
}