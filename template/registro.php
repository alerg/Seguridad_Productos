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
	
<script src="js/registro.js">
</script>

<section data-interactive="contenedor" class="contenedor contenido">
	<section>
		<fieldset>
			<h2>Registrarse</h2>
			<div class="columna columna--doble">
				<label for="email">Email:</label>
				<input name="email" class="datos" data-interactive="email" type="text"/>
				
				<label for="nombre">Nombre:</label>
				<input name="nombre" class="datos" data-interactive="nombre" type="text"/>

				<label for="apellido">Apellido:</label>
				<input name="apellido" class="datos" data-interactive="apellido" type="text"/>
			</div>
			<div class="columna columna--doble">
				<label for="contrasena">Contraseña:</label>
				<input name="contrasena" class="datos" data-interactive="contrasena" type="password"/>
				
				<label for="contrasena2">Repetir contraseña:</label>
				<input name="contrasena2" class="datos" data-interactive="contrasena2" type="password"/>
			</div>
			<div class="columna columna--simple">
				<button class="boton" data-interactive="registrar">Registrarse</button>
			</div>
		</fieldset>
	</section>
		
</section>
	
	<footer class="pie">
			<p>&copy;Seguridad y Calidad de Aplicaciones Web - 2014</p>
	</footer>
</body>

</html>