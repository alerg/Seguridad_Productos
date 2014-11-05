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
	
	<script src="js/cargar.js"></script>

	<section data-interactive="contenedor" class="contenedor contenido" data-mode="">
		
		<div class="contenedor">
			<h2>Cargar producto</h2>
		</div>
		<section>
			<fieldset class="producto">
				<div class="columna columna--doble">
					<label for="tipo">Tipo de Producto:</label>
					<select id="tipo" name="tipo" data-interactive="tipo">
						<option value="" selected disabled>Seleccione un tipo</option>
					</select>
				</div>
				<div class="columna columna--doble hide">
					<label for="producto">Producto:</label>
					<select id="producto" name="producto" data-interactive="producto">
						<option value="" selected disabled>Seleccione un producto</option>
					</select>
				</div>
			</fieldset>
		</section>
		<section data-interactive="datos" class="datosIngreso">
			<fieldset>
				<div class="columna columna--triple">
					<label>Precio m&aacute;ximo</label>
					<input id="maximo" class="estadistica" data-interactive="maximo"></input>
				</div>
				<div class="columna columna--triple">
					<label>Precio m&iacute;nimo</label>
					<input id="minimo" class="estadistica" data-interactive="minimo"></input>
				</div>
				<div class="columna columna--triple">
					<label>Precio promedio</label>
					<input id="promedio" class="estadistica" data-interactive="promedio"></input>
				</div>
				<div class="columna columna--doble">
					<button class="boton" data-interactive='agregar'>Agregar</button>
				</div>
			</fieldset>
		</section>
		<section class="caja-comentarios contenedor" data-interactive="comentarios">
			<h4>Comentarios</h4>
		</section>
		
	</section>
	<footer class="pie">
		<p>&copy;Seguridad y Calidad de Aplicaciones Web - 2014</p>
	</footer>
</body>

</html>