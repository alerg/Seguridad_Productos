jQuery(document).ready(function(){
	jQuery('[data-interactive="logout"]').click(function(){
		var usuario = new Usuario();

		usuario.logout(function(){
			location.href = "/template/index.php";
		});
	});

	var usuario = new Usuario();
	usuario.userInfo(function(error, estaLoggeado){
		if(estaLoggeado){
			jQuery('[data-interactive="login"]').remove();
			jQuery('[data-interactive="registro"]').remove();
		}else{
			jQuery('[data-interactive="misprecios"]').remove();
			jQuery('[data-interactive="logout"]').remove();
		}
	});

});