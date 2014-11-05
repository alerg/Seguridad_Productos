//Necesita CORE
var Usuario = function (){
	this.email = null;
	this.contrasena = null;
	this.nombre = null;
	this.apellido = null;
}

Usuario.prototype = {
	login : function(cb){
		var that = this;
		jQuery.get('/api/usuarios/login', {
			email: this.email,
			contrasena: this.contrasena
		}).always(function(resp){
			if(cb)
				cb(resp);
		});
	},
	crear: function(cb){
		jQuery.post('/api/usuarios/crear', {
			email: this.email,
			contrasena: this.contrasena,
			nombre: this.nombre,
			apellido: this.apellido
		}, function(response){
			if(cb)
				cb(response);
		}, "json"); 
	}
}

//Necesita CORE
var TiposProducto = function (){
	this.id = null;
	this.descripcion = null;
}

TiposProducto.prototype = {
	obtenerTodos: function(cb){
		var that = this;
		jQuery.get('/api/tiposProducto/obtenerTodos',
			function(data){
				that = data;
				if(cb)
					cb(that);
			}
		);
	}
}

var Producto = function (){
	this.tipo = null;
	this.descripcion = null;
}

Producto.prototype = {
	crear: function(cb){
		jQuery.post('/api/productos/crear', {
			tipo: this.tipo,
			descripcion: this.descripcion
		}, function(response){
			if(cb)
				cb(response);
		}, "json"); 
	},
	obtenerTodos: function(cb){
		var that = this;
		jQuery.get('/api/productos/obtenerTodos',{
				tipo : this.tipo
			},
			function(data){
				that = data;
				if(cb)
					cb(that);
			}
		);
	},
	obtenerDetalle: function(data, cb){
		var that = this;
		jQuery.get('/api/productos/obtenerDetalle',{'id':data.id, fecha:data.fecha}, function(data){
			that = data;
			if(cb)
				cb(that);
		});	
	}
}