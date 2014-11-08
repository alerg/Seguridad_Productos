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
	
	<script src="js/mis_precios.js"></script>

	<section data-interactive="contenedor" class="contenedor contenido" data-mode="">
		
		<div class="contenedor">
			<h2>Mis Precios</h2>
		
			<section>
				<fieldset class="producto">
					
					<div class="columna columna--doble">
						<label for="tipo">Tipo:</label><br />
						<select id="tipo" name="tipo" data-interactive="tipo">
							<option value="" selected disabled>Seleccione un Tipo de producto</option>
						</select>
					</div>
					
					<div data-interactive="producto" class="columna columna--doble hide">
						<label for="producto">Producto:</label>
						<select id="producto" name="producto" data-interactive="productoSelect">
							<option value="" selected disabled>Seleccione un producto</option>
						</select>
					</div>
					
				</fieldset>
			</section>
			
			<section class="contenedor hide" data-interactive="precios">
				<h4>Precios</h4>
				
			</section>
			
		</div>
	</section>
	
	<footer class="pie">
		<p>&copy;Seguridad y Calidad de Aplicaciones Web - 2014</p>
	</footer>
</body>

</html>