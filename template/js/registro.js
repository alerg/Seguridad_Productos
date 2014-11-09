jQuery(document).ready(function(){
	jQuery('[data-interactive="registrar"]').click(function(){
		var email = jQuery('[data-interactive="email"]').val();
		var nombre = jQuery('[data-interactive="nombre"]').val();
		var apellido = jQuery('[data-interactive="apellido"]').val();		
		var password = jQuery('[data-interactive="contrasena"]').val();
		var password2 = jQuery('[data-interactive="contrasena2"]').val();

		var usuario = new Usuario();
		usuario.email = email;
		usuario.contrasena = password;
		usuario.nombre = nombre;
		usuario.apellido = apellido;

		usuario.crear(function(data){
			if(data){
				location.href = "/template/index.php";
			}else{
				alert("Ah ocurrido un error. Verifique los datos y vuelva a intertarlo.");
			}
		});
	});
});