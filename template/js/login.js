jQuery(document).ready(function(){
	jQuery('[data-interactive="login"]').click(function(e){
		var email = jQuery('[data-interactive="email"]').val();
		var password = jQuery('[data-interactive="contrasena"]').val();

		var usuario = new Usuario();
		usuario.email = email;
		usuario.password = password;
		usuario.login(function(data){
			switch(data.status){
				case 200:
					location.href = "/index";
				break;
				case 401:
					alert("Verifique los datos ingresados");
				break;
			}
		}); 
	});
});