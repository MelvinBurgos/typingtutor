$(document).ready(function(){
	//Muestra la leccion
	var contador=0;
	var errores=0;
	var correctas=0;
	var leccionHTML = "<p>";
	var limite = leccion.length;
	var today = new Date();
	var h = today.getHours();
	var m = today.getMinutes();
	var s = today.getSeconds();
	var dd = today.getDate();
	var mm = today.getMonth()+1;
	var yy = today.getFullYear();
	var inicio = yy+"-"+mm+"-"+dd+" "+h+":"+m+":"+s
	
	//$("#resultado").hide();
	
	for(var i=0; i<limite; ++i){
		if (leccion[i].charCodeAt(0)==9786)   // para sustituir el enter
			leccionHTML += "<span id=s"+i+">"+"<img src=\"../images/enter.png\" width=20 height=15 /><BR>"+"</span>";
		else if(leccion[i].charCodeAt(0)==32) // ocultar y separar el espacio
			leccionHTML += "<span id=s"+i+" class=\"oculta\">."+leccion[i]+"</span>";
		else
			leccionHTML += "<span id=s"+i+">"+leccion[i]+"</span>";
	}
   leccionHTML += "</p>";
   $("#modelo").html(leccionHTML);
   $("#s"+contador).addClass('enfocada');//colorea el siguiente
   
   //Ejecuta la leccion
   $(document).keypress(function(e){
if (e.which==8) return false;//bloque la tecla Backspace
   var s = String.fromCharCode( e.which ); //da mensaje de Caps lock activado
   if ( s.toUpperCase() === s && s.toLowerCase() !== s && !e.shiftKey ) {
       $('#mensaje').show();
   } else $('#mensaje').hide();
   if(delay > 0 && limite>contador){
	  if (String.fromCharCode(e.which)==leccion[contador]){
		correctas++;
		$("#correctas").val(correctas);
		$("#s"+contador).removeClass('enfocada').addClass('bien');
		if (leccion[contador].charCodeAt(0)==32) $("#s"+contador).addClass('ocultaBien');
	  }
	  else if (e.which==13 && leccion[contador].charCodeAt(0)==9786){  //Verifica el enter
	  	$("#s"+contador).removeClass('enfocada').addClass('bien');
	  }
	  else{
		errores++;
		$("#errores").val(errores);
		$("#s"+contador).removeClass('enfocada').addClass('mal');
		if (leccion[contador].charCodeAt(0)==32) $("#s"+contador).addClass('ocultaMal');
	  }
	  contador++;
	  $("#s"+contador).addClass('enfocada');//colorea el siguiente
	  if (leccion[contador].charCodeAt(0)==32) $("#s"+contador).addClass('ocultaEnfocada');
	  $("#escrito").val($("#escrito").val()+String.fromCharCode(e.which));
	}
   });
	
   	//contador timer
	var delay = tiempo;
	startTime();
	function startTime() {
		cm=~~(delay/60);
		cs=delay%60;
		$("#contador").html("<b>"+cm+":"+cs+"</b>");
		if(delay > 0 && limite>contador)
			t = setTimeout(function(){ startTime() }, 1000);
		else{
			var today = new Date();
		    var h = today.getHours();
		    var m = today.getMinutes();
		    var s = today.getSeconds();
		    var dd = today.getDate();
		    var mm = today.getMonth()+1;
		    var yy = today.getFullYear();
			$("#resultado").show();
			$("#usuario").val(usuarioID);
			$("#leccion").val(leccionID);
			$("#inicio").val(inicio);
			$("#final").val(yy+"-"+mm+"-"+dd+" "+h+":"+m+":"+s);
			$("#correctas").val(correctas);
			$("#tiempo").val(tiempo - delay);
			$("#errores").val(errores);
			var nota = ((correctas/limite)-(errores/limite))*10;
			$("#nota").val(nota.toFixed(1));
			var ppm = contador/((tiempo-delay)/60);
			$("#ppm").val(ppm.toFixed(0));
			var wpm = contador/5/((tiempo-delay)/60);
			$("#wpm").val(wpm.toFixed(0));
		}
		delay--;
	}

})