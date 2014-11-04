<!doctype html>
<html lang="es-ar">
<head>
	<title>Productos</title>
	<meta name="description" content="" />
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="/js/jquery/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="/js/jquery/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/js/api.js"></script>
	<link rel="icon" href="img/favicon.png" type="image/png" />
	<link rel="stylesheet" type="text/css" href="css/estilos.css" />
	<link rel="stylesheet" type="text/css" href="/js/jquery/jquery-ui.theme.min.css" />
	<link rel="stylesheet" type="text/css" href="/js/jquery/jquery-ui.structure.min.css" />
</head>

<body>
	<?php
    include "/header.php";
    ?>
	
<script src="js/login.js">
</script>

<section data-interactive="contenedor" class="contenedor contenido">
	<section>
		<fieldset>
			<h2>Login</h2>
			<div class="columna columna--doble">
				<label for="email">Email:</label>
				<input name="email" class="datos" data-interactive="email" type="text"/>
				<label for="contrasena">Contraseña:</label>
				<input name="contrasena" class="datos" data-interactive="contrasena" type="password"/>
			</div>
			<div class="columna columna--doble">
				<button class="boton" data-interactive="login">Loguearse</button>
			</div>
		</fieldset>
	</section>
		
</section>
	
	<footer class="pie">
			<p>&copy;Seguridad y Calidad de Aplicaciones Web - 2014</p>
	</footer>
</body>

</html>