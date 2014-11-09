<!doctype html>
<html lang="es-ar">
<head>
	<title>Productos</title>
	<meta name="description" content="" />
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="js/jquery/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="js/jquery/jquery-ui.min.js"></script>
	<script src="js/api.js"></script>

	<link rel="icon" href="img/favicon.png" type="image/png" />
	<link rel="stylesheet" type="text/css" href="css/estilos.css" />
	<link rel="stylesheet" type="text/css" href="js/jquery/jquery-ui.theme.min.css" />
	<link rel="stylesheet" type="text/css" href="js/jquery/jquery-ui.structure.min.css" />
</head>

<body>
	<?php
    include "/header.php";
    ?>
	
	<script src="js/cargar.js"></script>

	<section data-interactive="contenedor" class="contenedor contenido" data-mode="">
		
		<div class="contenedor">
			<h2>Cargar producto</h2>
		</div>
		<section>
			<fieldset class="producto">
				<div class="columna columna--doble">
					<label for="tipo">Tipo:</label>
					<input id="tipo" name="tipo" data-interactive="tipo" disabled/>
				</div>
				<div class="columna columna--doble">
					<label for="producto">Producto:</label>
					<input id="producto" name="producto" data-interactive="producto" disabled/>
				</div>
				<div class="columna columna--doble">
					<label for="precio">Precio:</label>
					<input id="precio" name="precio" data-interactive="precio"/>
				</div>
				<div class="columna columna--doble">
					<button class="boton" data-interactive='agregar'>Agregar</button>
				</div>
			</fieldset>
		</section>	
	</section>
	<footer class="pie">
		<p>&copy;Seguridad y Calidad de Aplicaciones Web - 2014</p>
	</footer>
</body>

</html>