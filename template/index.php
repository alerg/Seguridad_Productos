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
		
		<div class="contenedor">
			<h2>Estadísticas de los productos</h2>
		</div>
		
		<section class="buscar">
			<fieldset>
				<form data-interactive="formBuscar" class="search">
					<div class="columna columna--doble">
							<label for="producto">Producto:</label>
							<select id="product" name="product" data-interactive="product">
								<option value="" selected disabled>Seleccione un producto</option>
							</select>
					</div>
					<div class="columna columna--doble">
						<label for="semana">Semana:</label>
						<input type="text" id="semana" data-interactive="semana" placeholder="Seleccione un día de una semana"/>
					</div>
					<div class="columna columna--doble">
						<button class="boton" data-interactive='buscarProducto'>Buscar</button>
					</div>
				</form>
			</fieldset>
		</section>	
		
		<section class="datos">
			<fieldset>
				<div class="columna columna--simple">
					<h3 id="nombre" data-interactive="nombre">Notebook</h3>
				</div>
				<div class="columna columna--triple">
					<label>Precio m&aacute;ximo</label>
					<span id="maximo" class="estadistica" data-interactive="maximo">$43.000</span>
				</div>
				<div class="columna columna--triple">
					<label>Precio m&iacute;nimo</label>
					<span id="minimo" class="estadistica" data-interactive="minimo">$1.640</span>
				</div>
				<div class="columna columna--triple">
					<label>Precio promedio</label>
					<span id="promedio" class="estadistica" data-interactive="promedio">$5.400</span>
				</div>
			</fieldset>
		</section>
		
		<section class="caja-comentarios contenedor">
			<h4>Comentarios</h4>
			
			<div class="comentario">
				<header>Anónimo</header>
				<p>Este es el comentario de un usuario.</p>
				<footer>01/11/2014 &nbsp;10:37hs</footer>
			</div>
			
			<div class="comentario">
				<header>Anónimo</header>
				<p>Este es el comentario de otro usuario. Es un comentario más largo que el anterior, lo suficiente como para abarcar varias líneas y poder ver el interlineado que tienen los comentarios.</p>
				<footer>01/11/2014 &nbsp;10:35hs</footer>
			</div>
			
			<div class="comentario">
				<header>Anónimo</header>
				<p>Este es el comentario de un usuario.</p>
				<footer>01/11/2014 &nbsp;9:21hs</footer>
			</div>
		</section>
		
	</section>
	<footer class="pie">
		<p>&copy;Seguridad y Calidad de Aplicaciones Web - 2014</p>
	</footer>
</body>

</html>