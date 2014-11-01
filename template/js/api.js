//Necesita CORE
var Usuario = function (usuario, contraseña){
	this.usuario = usuario;
	this.contraseña = contraseña;
}

Usuario.prototype = {
	login : function(cb){
		var that = this;
		jQuery.get('/api/usuario/login', {}, function(response){
			if(cb)
				cb(that);
		});
	}
}

//Necesita CORE
var Producto = function (){}

Producto.prototype = {
	buscar : function(nombre, semana, pagina, cb){
		var that = this;
		jQuery.get('/api/producto/buscar',
			{
				'nombre':nombre,
				'semana':semana,
				'pagina':pagina
			}, 
			function(data){
				that = data;
				if(cb)
					cb(that);
			}
		);
	},
	obtener: function(cb){
		var that = this;
		jQuery.get('/api/productos/obtener', {'id':this.id}, function(data){
			that = data;
			if(cb)
				cb(that);
		});	
	}
}

//Necesita CORE
var Mensaje = function (vuelo, nombre, email, fecha, dni, categoria){
	this.id = null;
}

Mensaje.prototype = {
	crear : function(cb){
		var that = this;

		jQuery.post('/api/mensajes/', {
			producto: that.producto,
			usuario: that.usuario,
			mensaje: that.mensaje
		}).done( function(data) {
		    jQuery.extend(that, data);
			if(cb)
				cb(that);
	    });
	},
	obtener: function(cb){
		var that = this;
		jQuery.get('/api/mensajes/obtener', {
			id: that.producto
		}).done( function(data) {
			if(data != {}){
				jQuery.extend(that, data);
				if(cb)
					cb(that);
			}
	    });	
	}
}