<!doctype html>
<html lang="es-ar">
<head>
	<title>Productos</title>
	<meta name="description" content="" />
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="/js/jquery/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="/js/jquery/jquery-ui.min.js"></script>
	<script src="js/api.js"></script>

	<link rel="icon" href="img/favicon.png" type="image/png" />
	<link rel="stylesheet" type="text/css" href="css/estilos.css" />
	<link rel="stylesheet" type="text/css" href="/js/jquery/jquery-ui.theme.min.css" />
	<link rel="stylesheet" type="text/css" href="/js/jquery/jquery-ui.structure.min.css" />
</head>

<body>
	<?php
    include "/header.php";
    ?>
	
	<script src="js/index.js"></script>

	<section data-interactive="contenedor" class="contenedor contenido" data-mode="">
		<section class="buscar">		
			<fieldset>
				<form data-interactive="formBuscar" class="search">
					<div class="columna columna--doble">
							<label for="producto">Producto:</label>
							<input name="producto" data-interactive='producto' type="text" required>
					</div>
					<!--
					<div class="columna columna--doble">
						<label for="semana">Semana:</label>
						<input type="text" id="semana" data-interactive="semana" required/>
					</div>
					-->
					<div class="columna columna--doble">
						<button class="boton" data-interactive='buscarProducto'>Buscar</button>
					</div>
				</form>
			</fieldset>
		</section>	
		<section class="datos">
			<fieldset>
				<h2>Productos</h2>
				<div class="columna columna--triple">
					<label>Nombre</label>
				</div>
				<div class="columna columna--triple">
					<label>Precio m&aacute;ximo</label>
				</div>
				<div class="columna columna--triple">
					<label>Precio m&iacute;nimo</label>
				</div>
				<div class="columna columna--triple">
					<input name="nombre" class="datos" data-interactive="nombre" type="text" disabled />
				</div>
				<div class="columna columna--triple">
					<input name="maximo" class="datos" data-interactive="maximo" type="text" disabled />
				</div>
				<div class="columna columna--triple">
					<input name="minimo" class="datos" data-interactive="minimo" type="text" disabled />
				</div>
			</fieldset>
		</section>
	</section>
	<footer class="pie">
		<p>&copy;Seguridad - 2014</p>
	</footer>
</body>

</html>