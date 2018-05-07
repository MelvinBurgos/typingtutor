$(document).ready(function(){
	//Muestra la leccion
	var contador=0;
	var errores=0;
	var pulsaciones=0;
	var leccionHTML = "<p>";
	var limit = leccion.length;
	var today = new Date();
	var h = today.getHours();
	var m = today.getMinutes();
	var s = today.getSeconds();
	var dd = today.getDate();
	var mm = today.getMonth()+1;
	var yy = today.getFullYear();
	var inicio = yy+"-"+mm+"-"+dd+" "+h+":"+m+":"+s
	
	for(var i=0; i<limit; ++i){
		if (leccion[i].charCodeAt(0)==9786)   // para sustituir el enter
			leccionHTML += "<span id=s"+i+">"+"<img src=\"../images/enter.png\" width=40 height=20 />  <BR>"+"</span>";
		else if(leccion[i].charCodeAt(0)==32)
			leccionHTML += "<span id=s"+i+" style=\"color:#fafafa\">."+leccion[i]+"</span>";
		else
			leccionHTML += "<span id=s"+i+">"+leccion[i]+"</span>";
	}
   leccionHTML += "</p>";
   $("#texto").html(leccionHTML);
//   $('#mensaje').hide();
   
   //Ejecuta la leccion
   $(document).keypress(function(e){
	  pulsaciones++;
	  if (String.fromCharCode(e.which)==leccion[contador]){
		//$("#mitexto").before(String.fromCharCode(e.which));
	    $("#s"+contador).css({'background':'#81f79f'});
		if (e.which==32) $("#s"+contador).css({'color':'#81f79f'});
		contador++;
		$("#s"+contador).css({'background':'#ffffa5'});//colorea el siguiente
	  }
	  else if (e.which==13 && leccion[contador].charCodeAt(0)==9786){  //Verifica el enter
	  	$("#s"+contador).css({'background':'#81f79f'});
		contador++;
		$("#s"+contador).css({'background':'#ffffa5'});//colorea el siguiente
	  }
	  else{
		//$("#loescrito").html(e.which + ": " + String.fromCharCode(e.which));
		errores++;
		$("#errores").val(errores);
	  }
	  $("#escrito").val($("#escrito").val()+String.fromCharCode(e.which));
   });
	
   	//contador timer
	var delay = tiempo;
	startTime();
	function startTime() {
		$("#count").html("<b>"+delay+"</b>");
		if(delay > 0 && limit!=contador)
			t = setTimeout(function(){ startTime() }, 1000);
		else{
			var today = new Date();
		    var h = today.getHours();
		    var m = today.getMinutes();
		    var s = today.getSeconds();
		    var dd = today.getDate();
		    var mm = today.getMonth()+1;
		    var yy = today.getFullYear();
			alert("Ha finalizado tienes\n "+contador+" correctas\n"+errores+" errores \nfecha:"+h+":"+m+":"+s);
			$("#usuario").val(usuarioID);
			$("#leccion").val(leccionID);
			$("#inicio").val(inicio);
			$("#final").val(yy+"-"+mm+"-"+dd+" "+h+":"+m+":"+s);
			$("#correctas").val(contador);
			$("#tiempo").val(tiempo - delay);
			$("#errores").val(errores);
			var nota = ((contador/limit)-(errores/limit))*10;
			$("#nota").val(nota.toFixed(2));
			$("#ppm").val(contador/((tiempo-delay)/60));
			$("#wpm").val(contador/5/((tiempo-delay)/60));
		}
		delay--;
	}

})