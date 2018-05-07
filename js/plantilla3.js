$(document).ready(function(){
	//Muestra la leccion
	var contador=0;
	var errores=0;
	var correctas=0;
	var capa=0;
	var capaActual=0;
	var capaSiguiente=0;
	var pulsaciones=0;
	var leccionHTML = "<div id=\"slide0\" class=\"slide\">";
	var limite = leccion.length-1;
	var today = new Date();
	var h = today.getHours();
	var m = today.getMinutes();
	var s = today.getSeconds();
	var dd = today.getDate();
	var mm = today.getMonth()+1;
	var yy = today.getFullYear();
	var inicio = yy+"-"+mm+"-"+dd+" "+h+":"+m+":"+s
	
	for(var i=0; i<limite; ++i){
		if (leccion[i].charCodeAt(0)==9786){   // para sustituir el enter
			capa++;
			leccionHTML += "</div><div id=\"slide"+capa+"\" class=\"slide\">"
			}
		else
			leccionHTML += "<span id=s"+i+">"+leccion[i]+"</span>";
	}
   leccionHTML += "</div>";
   $("#texto").html(leccionHTML);
   for(var j=1; j<=capa; j++) $("#slide"+j).hide();
   
   //Ejecuta la leccion
   $(document).keypress(function(e){
	  pulsaciones++;
	  if (String.fromCharCode(e.which)==leccion[contador]){
	    $("#s"+contador).css({'background':'#81f79f'});
		if (e.which==32) $("#s"+contador).css({'color':'#81f79f'});
		correctas++;
		$("#correctas").val(correctas);
	  }
	  else{
		$("#s"+contador).css({'background':'#fa5858'});
		errores++;
		$("#errores").val(errores);
	  }
	  if (leccion[contador+1].charCodeAt(0)==9786){  //Verifica el enter
	  	capaSiguiente++;
		contador++;
	  }
	  $("#s"+contador).fadeTo("fast",0);
	  contador++;
	  $("#s"+contador).css({'background':'#dba901'});//colorea el siguiente
	  if(capaSiguiente>capaActual){
		$("#slide"+capaActual).hide();//Cambiar slide
		$("#slide"+capaSiguiente).show();//Cambiar slide
		capaActual = capaSiguiente;
	  }
	  $("#escrito").val($("#escrito").val()+String.fromCharCode(e.which));
   });
	
   	//contador timer
	var delay = tiempo;
	startTime();
	function startTime() {
		$("#count").html("<b>"+delay+"</b>");
		if(delay > 0 && limite>contador){
			t = setTimeout(function(){ startTime() }, 1000);
		}
		else{
			$("#Capa1").hide("slide", { direction: "left" }, 700);//Cambiar slide
			var today = new Date();
		    var h = today.getHours();
		    var m = today.getMinutes();
		    var s = today.getSeconds();
		    var dd = today.getDate();
		    var mm = today.getMonth()+1;
		    var yy = today.getFullYear();
			$("#usuario").val(usuarioID);
			$("#leccion").val(leccionID);
			$("#inicio").val(inicio);
			$("#final").val(yy+"-"+mm+"-"+dd+" "+h+":"+m+":"+s);
			$("#correctas").val(contador);
			$("#tiempo").val(tiempo - delay);
			$("#errores").val(errores);
			var nota = ((contador/limite)-(errores/limite))*10;
			$("#nota").val(nota.toFixed(2));
			$("#ppm").val(contador/((tiempo-delay)/60));
			$("#wpm").val(contador/5/((tiempo-delay)/60));
		}
		delay--;
	}

})