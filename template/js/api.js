//Necesita CORE
var Usuario = function (){
	this.email = null;
	this.contrasena = null;
	this.nombre = null;
	this.apellido = null;
}

Usuario.prototype = {
	userInfo: function{
		var that = this;
		jQuery.get('/api/usuarios/userInfo', {})
		.always(function(resp){
			if(resp.isLogged){
				this.nombre = resp.nombre;
				this.apellido = resp.apellido;
				cb(true);
			}else{
				cb(false);
			}
		});
	},
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
			descripcion: this.descripcion,
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
	},
	obtenerDetallePorUsuario: function(data, cb){
		var that = this;
		jQuery.get('/api/productos/obtenerDetallePorUsuario',{'id':data.id}, function(data){
			that = data;
			if(cb)
				cb(that);
		});	
	}
}

var Precio = function (){
	this.fecha = null;
	this.idProducto = null;
	this.monto = null;
	this.idUsuario = null;
}

Precio.prototype = {
	crear: function(data, cb){
		jQuery.post('/api/precios/crear', data, function(response){
			if(cb)
				cb(null, response);
		}, "json")
		.fail(function() {
		    if(cb){
				cb({});
			}
		});
	},
	obtenerPorProducto: function(cb){
		jQuery.post('/api/precios/obtenerPorProducto', this, function(response){
			if(cb)
				cb(response);
		}, "json"); 
	},
	obtenerPorProductoUsuario: function(data, cb){
		jQuery.get('/api/precios/obtenerPorProductoUsuario', data, function(response){
			if(cb)
				cb(null, response);
		}, "json")
		.fail(function() {
		    if(cb){
				cb({});
			}
		}); 
	}
}