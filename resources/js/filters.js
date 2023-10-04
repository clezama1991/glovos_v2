
Vue.filter('truncate', function (text, length, suffix) {
   
	if (text.length > length) {
	    return text.substring(0, length) + suffix;
	} else {
	    return text;
	}

});




Vue.filter('filtrarSelect', function (value,data) {

    if(value == null){ return 'Sin Información'; }else{

      var select = data.filter((values) => {            
          return values.id == value;
      });
      
      if(select == null && select.length == 0){
          return 'Sin Información';
      }else{
          return select[0].nombre      
      }

    }

});


Vue.filter('validateEstadoFilter', function (value,estado) {

  var vigencia = value;
  var hoy = moment().format('YYYY-MM-DD');
  var un_mes_despues = moment().add(1, 'months').format('YYYY-MM-DD');

   if(hoy>vigencia){
    return 'Caducada';
   }else{
    if(un_mes_despues>vigencia){
      return 'Por Renovar';
    }else{
      return estado;
    }
   } 

});

Vue.filter('formatDay', function (value) {

   return moment(value).format('ddd');

});

Vue.filter('formatDate', function (value) {

   return moment(value).format('DD/MM/YYYY');

});

Vue.filter('formatDateAvisos', function (value) {

   return moment(value).format('DD/MM');

});

Vue.filter('formatDateFull', function (value) {

   return moment(value).format('DD/MM/YYYY HH:mm');

});

Vue.filter('ShowEstado', function (estado) {

	if (estado == 1) {
	    return "Publicado";
	} else {
	    return "No Publicado";
	}

});

Vue.filter('percentage', function(value, decimals) {
  if(!value) {
    value = 0;
  }

  if(!decimals) {
    decimals = 0;
  }

  value = value * 100;
  value = Math.round(value * Math.pow(10, decimals)) / Math.pow(10, decimals);
  value = value + '%';
  return value;
});

Vue.filter('round', function(value, decimals) {
  if(!value) {
    value = 0;
  }

  if(!decimals) {
    decimals = 0;
  }

  value = Math.round(value * Math.pow(10, decimals)) / Math.pow(10, decimals);
  return value;
});
