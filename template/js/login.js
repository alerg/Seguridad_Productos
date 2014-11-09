jQuery(document).ready(function(){
	jQuery('[data-interactive="login"]').click(function(e){

		var email = jQuery('[data-interactive="email"]').val();
		var password = jQuery('[data-interactive="contrasena"]').val();

		var usuario = new Usuario();
		usuario.email = email;
		usuario.contrasena = password;

		usuario.login(function(error){
			if(error){
				alert("Verifique los datos ingresados");
			}else{
				location.href = "/index";
			}
		}); 
	});
});