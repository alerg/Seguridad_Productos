jQuery(document).ready(function(){
	jQuery('[data-interactive="logout"]').click(function(){
		var usuario = new Usuario();

		usuario.logout(function(){
			location.href = "/template/index.php";
		});
	});
});