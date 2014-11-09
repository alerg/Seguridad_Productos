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
	
	<script src="js/index.js"></script>

	<section data-interactive="contenedor" class="contenedor contenido" data-mode="">
		
		<div class="contenedor">
			<h2>Estadísticas de los productos</h2>
		</div>
		
		<section>
			<fieldset class="producto">
				
				<div class="columna columna--doble">
					
					<div>
						<label for="tipo">Tipo:</label><br/>
						<select id="tipo" name="tipo" data-interactive="tipo">
							<option value="" selected disabled>Seleccione un Tipo de producto</option>
						</select>
					</div>
					<br/>
					
					<div data-interactive="producto" class="hide">
						<label for="producto">Producto:</label>
						<select id="producto" name="producto" data-interactive="productoSelect">
							<option value="" selected disabled>Seleccione un producto</option>
						</select>
					</div>
				</div>
				
				<div data-interactive="buscar" class="columna columna--doble hide">
					<div>
						<label for="semana">Semana:</label>
						<input type="text" id="semana" data-interactive="semana" placeholder="Seleccione un día de una semana"/>
					</div>
					<div>
						<button class="boton" data-interactive='buscarProducto'>Buscar</button>
					</div>
				</div>
				
			</fieldset>
		</section>
		
		<section data-interactive="datos" class="datos">
			<fieldset>
				<div class="columna columna--triple">
					<label>Precio m&aacute;ximo</label>
					<span id="maximo" class="estadistica" data-interactive="maximo"></span>
				</div>
				<div class="columna columna--triple">
					<label>Precio m&iacute;nimo</label>
					<span id="minimo" class="estadistica" data-interactive="minimo"></span>
				</div>
				<div class="columna columna--triple">
					<label>Precio promedio</label>
					<span id="promedio" class="estadistica" data-interactive="promedio"></span>
				</div>
			</fieldset>
		</section>
		
		<section class="cargar">
			<a data-interactive="cargarPrecio" href="">Cargar Precio</a>
		</section>
		
		<section class="caja-comentarios contenedor" data-interactive="comentarios">
			
		</section>
		
	</section>
	
	<footer class="pie">
		<p>&copy;Seguridad y Calidad de Aplicaciones Web - 2014</p>
	</footer>
</body>

</html>