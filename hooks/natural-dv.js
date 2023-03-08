function show_error(field, msg){
	
	modal_window({
		message: '<div class="alert alert-danger">' + msg + '</div>',
		title: 'Error in ' + field,
		close: function(){
			$j('#' + field).focus();
			$j('#' + field).parents('.form-group').addClass('has-error');
		}
	});
	
	return false;
}

function get_date(date_field){
	var y = $j('#' + date_field).val();
	var m = $j('#' + date_field + '-mm').val();
	var d = $j('#' + date_field + '-dd').val();
	
	var date_object = new Date(y, m - 1, d);
	
	if(!y) return false;
	
	return date_object;
}

$j(function(){
	
/* fecha de solicitud VcrFecVis no puede ser mayor a la actual */

	/*$j('#VcrFecVis, #VcrFecVis-mm, #VcrFecVis-dd').change(function(){
		
		var now = new Date();
		var fecha = get_date('VcrFecVis');
		
		if(fecha && (fecha > now)){
			show_error('fecha', 'La fecha no puede ser mayor a la actual');
			$j('#' + 'fecha').focus();
			$j('#' + 'fecha').parents('.form-group').addClass('has-error');
		} else {
			$j('#' + 'fecha').parents('.form-group').removeClass('has-error');
		}
	});*/

	$j('#VcrFecVis, #VcrFecVis-mm, #VcrFecVis-dd').change(function(){
		var fecha = get_date('VcrFecVis');
		if (fecha) {
		  var year = fecha.getFullYear();
		  if (year < 2020) {
			show_error('fecha', 'El año de la visita debe ser mayor a 2020');
			$j('#' + 'fecha').focus();
			$j('#' + 'fecha').parents('.form-group').addClass('has-error');
			return;
		  }
		  var now = new Date();
		  if (fecha > now) {
			show_error('fecha', 'La fecha no puede ser mayor a la actual');
			$j('#' + 'fecha').focus();
			$j('#' + 'fecha').parents('.form-group').addClass('has-error');
			return;
		  }
		}
		$j('#' + 'fecha').parents('.form-group').removeClass('has-error');
	  });
	  

/* Valida el campo cedula VcrNoIde de la persona que atiende */	

	$j('#VcrNoIde').change(function(){
		var VcrNoIde = $j('#VcrNoIde').val();

		if(isNaN(VcrNoIde) || VcrNoIde < 1000000 || VcrNoIde > 9999999999){
			show_error('Identificación', 'el número de identificación es incorrecto');
			$j('#' + 'VcrNoIde').focus();
			$j('#' + 'VcrNoIde').parents('.form-group').addClass('has-error');
		} else {
			$j('#' + 'VcrNoIde').parents('.form-group').removeClass('has-error');
		}
	});	

	/* Valida el campo email */	

$j('#VcrCorEle').change(function(){
	var email = $j('#VcrCorEle').val();

	if(!email.match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/)){
		show_error('Correo electrónico', 'El correo electrónico es incorrecto');
		$j('#' + 'VcrCorEle').focus();
		$j('#' + 'VcrCorEle').parents('.form-group').addClass('has-error');
	} else {
		$j('#' + 'VcrCorEle').parents('.form-group').removeClass('has-error');
	}
});

/* fecha de radicado VcrFecSol no puede ser mayor a la actual */


$j('#VcrFecSol, #VcrFecSol-mm, #VcrFecSol-dd').change(function(){

		var fecha = get_date('VcrFecSol');
		if (fecha) {
		  var year = fecha.getFullYear();
		  if (year < 2020) {
			show_error('fecha', 'El año de la radicación debe ser mayor a 2020');
			$j('#' + 'fecha').focus();
			$j('#' + 'fecha').parents('.form-group').addClass('has-error');
			return;
		  }
		  var now = new Date();
		  if (fecha > now) {
			show_error('fecha', 'La fecha no puede ser mayor a la actual');
			$j('#' + 'fecha').focus();
			$j('#' + 'fecha').parents('.form-group').addClass('has-error');
			return;
		  }
		}
		$j('#' + 'fecha').parents('.form-group').removeClass('has-error');
	  });
	  
			
/* Validación del numero telefónico VcrCel que no vaya vacio y que contenga 10 digitos númericos */

$j('#VcrCel').blur(function(){
    var cel = $j('#VcrCel').val();
    var regex = /^\d{3}-?\d{3}-?\d{4}$/; // Expresión regular para validar el número de teléfono

    if(!regex.test(cel)){
        return show_error('Número Celular', 'Ingrese un número de teléfono válido de 10 digitos, si es un número fijo anteponga 602');
    }
});

/* Validación del nombre de la persona que atiende que tenga mas de 8 caracteres y que tenga letras y espacios */

$j('#VcrNomAti').on('blur', function(){
    var nombre = $j('#VcrNomAti').val();

    if(nombre.length < 8){
        return show_error('Nombre persona que atiende', 'El nombre debe tener al menos 8 caracteres');
    }

    if (!/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/.test(nombre)) {
        return show_error('Nombre persona que atiende', 'El nombre solo debe contener letras y espacios');
    }

});


function on_change_VcrIdUbi() {
	// obtener el valor seleccionado de la lista desplegable VcrIdUbi
	var VcrIdUbiValue = $("#VcrIdUbi").val();
  
	// ocultar campos según el valor de VcrIdUbi
	if (VcrIdUbiValue === 8001011701) {
	  $("#VcrCorr").hide();
	} else if (VcrIdUbiValue === 8001011702 || VcrIdUbiValue === 8001011703) {
	  $("#VcrBarVe").hide();
	  $("#VcrCom").hide();
	} else if (VcrIdUbiValue === 8001011704) {
	  $("#VcrCorr").hide();
	  $("#VcrBarVe").hide();
	  $("#VcrCom").hide();
	} 
  }

}
);
