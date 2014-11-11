//Necesita CORE
var Usuario = function (){
	this.email = null;
	this.contrasena = null;
	this.nombre = null;
	this.apellido = null;
}

Usuario.prototype = {
	crear: function(cb){
		jQuery.post('/api/usuarios/crear', {
			email: this.email,
			contrasena: this.contrasena,
			nombre: this.nombre,
			apellido: this.apellido,
			confirmacion: this.confirmacion
		}, function(response){
			if(cb)
				cb(null,response);
		}, "json")
		.always(function(data, statusName, jqXHR){
			var statusCode = jqXHR.status || data.status;
			switch(statusCode){
				case 200:
					if(cb)
						cb();
				break;
				case 400:
					if(cb)
						cb({error:'BAD_REQUEST'});
				break;
				case 409:
					if(cb)
						cb({error:'CONFLICT'});
				break;
			}
		});
	},
	login : function(cb){
		var that = this;

		var basic = btoa(this.email + '&' + this.contrasena); 

		jQuery.post('/api/usuarios/login', {
			basic: basic 
		}, "json")
		.always(function(data, statusName, jqXHR){
			if(jqXHR.status == 204){
				cb(null);			
			}else{
				if(cb)
					cb({});
			}
		});
	},
	logout: function(cb){
		jQuery.post('/api/usuarios/logout', {})
		.always(function(data, statusName, jqXHR){
			if(jqXHR.status == 204){
				cb();			
			}else{
				if(cb)
					cb({});
			}
		});
	},
	userInfo: function(cb){
		var that = this;
		jQuery.get('/api/usuarios/userInfo', {})
		.always(function(resp, statusName, jqXHR){
			if(jqXHR.status == 200 && resp.nombre){
				this.nombre = resp.nombre;
				this.apellido = resp.apellido;
				cb(null, true);
			}else{
				if(cb)
					cb(null, false);
			}
		});
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
	},
	obtenerPorSemanaPorUsuario: function(idProducto, cb){
		jQuery.get('/api/precios/obtenerPorSemanaPorUsuario', {
			idProducto: idProducto
		}, function(response){}, "json")
		.always(function(data, statusName, jqXHR){
			var statusCode = jqXHR.status || data.status;
			switch(statusCode){
				case 200:
					if(cb)
						cb();
				break;
				case 401:
					if(cb)
						cb({error:'UNAUTHORIZED'});
				break;
			}
		});	
	}
}

var Comentarios = function (){
	this.fecha = null;
	this.idProducto = null;
	this.idUsuario = null;
	this.nickname = null;
	this.comentario = null;
}

Comentarios.prototype = {
	crear: function(cb){
		jQuery.post('/api/comentarios/crear', {
			idProducto: this.idProducto,
			comentario: this.comentario,
			nickname: this.nickname
		}, function(){}, "json")
		.always(function(data, statusName, jqXHR){
			var statusCode = jqXHR.status || data.status;
			switch(statusCode){
				case 200:
					if(cb)
						cb();
				break;
				case 400:
					if(cb)
						cb({error:'BAD_REQUEST'});
				break;
			}
		});
	},
	obtenerPorProducto: function(cb){
		jQuery.post('/api/precios/comentarios', this, function(response){
			if(cb)
				cb(response);
		}, "json"); 
	}
}