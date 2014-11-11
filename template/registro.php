<!doctype html>
<html lang="es-ar">
<head>
	<title>Productos</title>
	<meta name="description" content="" />
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="js/jquery/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="js/jquery/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/api.js"></script>

	<link rel="icon" href="img/favicon.png" type="image/png" />
	<link rel="stylesheet" type="text/css" href="css/estilos.css" />
	<link rel="stylesheet" type="text/css" href="js/jquery/jquery-ui.theme.min.css" />
	<link rel="stylesheet" type="text/css" href="js/jquery/jquery-ui.structure.min.css" />
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
			<form data-interactive="registrarForm">
				<div class="columna columna--doble">
					<label for="email">Email:</label>
					<input name="email" nombre="Email" class="datos" data-interactive="email" type="email" required/>
					
					<label for="nombre">Nombre:</label>
					<input name="nombre" nombre="Nombre" class="datos" data-interactive="nombre" type="text" required/>

					<label for="apellido">Apellido:</label>
					<input name="apellido" nombre="Apellido" class="datos" data-interactive="apellido" type="text" required/>
				</div>
				<div class="columna columna--doble">
					<label for="contrasena">Contraseña:</label>
					<input name="contrasena" nombre="Contraseña" class="datos" data-interactive="contrasena" type="password" min="8" max="20" required/>
					
					<label for="contrasena2">Repetir contraseña:</label>
					<input name="contrasena2" nombre="Repetir contraseña" class="datos" data-interactive="contrasena2" type="password"  min="8" max="20" required/>
				</div>
				<div class="columna columna--simple">
					<button class="boton" type="submit" data-interactive="registrar">Registrarse</button>
				</div>
			</form>
		</fieldset>
	</section>
		
</section>
	
	<footer class="pie">
			<p>&copy;Seguridad y Calidad de Aplicaciones Web - 2014</p>
	</footer>
</body>

</html>