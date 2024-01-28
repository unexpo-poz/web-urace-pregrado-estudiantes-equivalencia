// JavaScript Document
function calcularEdad() {
	var hoy = new Date();
	with(document) {
		dia  = parseInt('0'+getElementById('diaN_S_1').selectedIndex,10);
		if (dia < 1){
			dia=1;
		}
		mes  = parseInt('0'+getElementById('mesN_S_1').value,10);
		anio = 1900 + parseInt('0'+getElementById('anioN_N_2').value,10);
	}
	var fnac= new Date(anio,mes,dia);
	var edad = new Date();
	if (fnac.getTime() < 0) {
		edad.setTime(hoy.getTime() - fnac.getTime());
		aniosEdad = edad.getYear();
		if (aniosEdad < 200) {
		aniosEdad = 1900 + aniosEdad;
		}
		aniosEdad = aniosEdad/1.0 + (edad.getMonth()+1)/12 + (edad.getDate())/365.25;
		aniosEdad = aniosEdad - 1970.0;
	}
	else {
		edad.setTime(hoy.getTime() - fnac.getTime());
		aniosEdad = edad.getYear()/1.0 + (edad.getMonth()+1)/12 + (edad.getDate())/365.25;
		if (aniosEdad < 200){
			aniosEdad = aniosEdad - 70.0;
		}
		else aniosEdad = aniosEdad - 1970.0;
	}
//	alert(aniosEdad);
	document.getElementById('edad').value = Math.floor(aniosEdad);
	document.getElementById('edad_S').value = Math.floor(aniosEdad);
}

function soloBlancos (campo) {
	var i = 0;
	var c = 0;
	if(campo.value.length == 1) {
		return false;
	}
	for (i = 0; i < campo.value.length - 1; i++) {
		if (campo.value.charAt(i) != campo.value.charAt(i + 1)) {
			return false;
		}
   }
  campo.value = "";
  return true ;
 }

function validarN(campo) {

	var cadena = campo.value;
    var nums="1234567890.";
    var i=0;
    var cl=cadena.length;
    while(i < cl)  {
		cTemp= cadena.substring (i, i+1);
        if (nums.indexOf (cTemp, 0)==-1) {
            cadT = cadena.split(cTemp);
            var cadena = cadT.join("");
            campo.value=cadena;
            i=-1;
            cl=cadena.length;
		}
        i++;
    }
}

function validarL(campo) {

	var cadena = campo.value;
    var nums="ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ" + "abcdefghijklmnñopqrstuvwxyzáéíóú " + "Üü";
	if (campo.alt == 'Apellidos' || campo.alt == 'Nombres') {
		nums = nums + "'";
	}
    var i=0;
    var cl=cadena.length;
    while(i < cl)  {
		cTemp= cadena.substring (i, i+1);
        if (nums.indexOf (cTemp, 0)==-1) {
            cadT = cadena.split(cTemp);
            var cadena = cadT.join("");
            campo.value=cadena;
            i=-1;
            cl=cadena.length;
		}
        i++;
    }
	campo.value = campo.value.toUpperCase();
}

function validarA(campo) {

	var cadena = campo.value;
	var nums ="ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ" + "abcdefghijklmnñopqrstuvwxyzáéíóú " + "Üü" + "0123456789" + "@.-_()#ºª/,";
    var i=0;
    var cl=cadena.length;
    while(i < cl)  {
		cTemp= cadena.substring (i, i+1);
        if (nums.indexOf (cTemp, 0)==-1) {
            cadT = cadena.split(cTemp);
            var cadena = cadT.join("");
            campo.value=cadena;
            i=-1;
            cl=cadena.length;
		}
        i++;
    }
	campo.value = campo.value.toUpperCase();
}

function validarLetras(campo, longitud, nValido, conMsg) {
	
	var valido = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ" + "abcdefghijklmnñopqrstuvwxyzáéíóú " + "Üü";
	if (nValido.length>0) {
		valido = nValido;
	}
	if (campo.alt == 'Apellidos' || campo.alt == 'Nombres') {
		valido = valido + "'";
	}
	var invalido = false;
	var temp;
	var msg ="";
	for (var i=0; i<campo.value.length; i++) {
		temp = "" + campo.value.substring(i, i+1);
		if (valido.indexOf(temp) == "-1") {
			invalido = true;
			msg = "- No se permite el caracter \""+temp+"\" en este campo.\n";
			break;
		}
	}
	var longInvalida = (campo.value.length < longitud);
	if (longInvalida || soloBlancos(campo) && (longitud > 0)) {
		msg = msg+"- No ha escrito un valor correcto para este campo.\n";
		invalido = true;
	}
	if (invalido) {
		msg = "Han ocurrido los siguientes errores:\n" + msg;
		if(conMsg){
			msg = msg + "Por favor corrija el campo " + campo.alt.toUpperCase();
			alert(msg);
		}
		campo.style.backgroundColor = "#FFFF99";
	}
	else {
		campo.style.backgroundColor = "#FFFFFF";
	}

	return !invalido;
}

function validarAlfaN(campo,longitud, conMsg) {

	var alfaC ="ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ" + "abcdefghijklmnñopqrstuvwxyzáéíóú " + "Üü" + "0123456789" + "@.-_()#ºª/,@";

	return validarLetras(campo,longitud, alfaC, conMsg);
}

function validarNum(campo, longitud, conMsg) {

	var cadena = campo.value;
    var nums="1234567890.";
    var i=0;
    var cl=cadena.length;
    var checkc = false;
	var msg ="";
    while(i < cl)  {
		cTemp= cadena.substring (i, i+1);
        if (nums.indexOf (cTemp, 0)==-1) {
			if (!checkc){
				msg =" - Ha introducido caracteres no numéricos y se eliminarán\n";
                checkc = true;
            }
            cadT = cadena.split(cTemp);
            var cadena = cadT.join("");
            campo.value=cadena;
            i=-1;
            cl=cadena.length;
		}
        i++;
    }
	var longInvalida = (campo.value.length < longitud);
	if (longInvalida) {
		msg = msg+"- No ha escrito un valor correcto para este campo.\n";
		invalido = true;
	}
	if (checkc || longInvalida) {
		msg = "Han ocurrido los siguientes errores:\n" + msg;
		if(conMsg){
			msg = msg + "Por favor corrija el campo " + campo.alt.toUpperCase();
			alert(msg);
		}
		campo.style.backgroundColor = "#FFFF99";
	}
	else {
		campo.style.backgroundColor = "#FFFFFF";
	}
	return !(checkc || longInvalida);
}

function validarSelect(campo, conMsg) {
	if (campo.selectedIndex == 0) {
		campo.style.backgroundColor = "#FFFF99";
		if(conMsg) alert('Por favor, seleccione un valor de la lista');
		return false;
	}
	else {
		campo.style.backgroundColor = "#FFFFFF";
	}
	return true;
}

function validar(campo){
	with (campo){
		tempID = id.split('_');
		switch (tempID[1]) {
			case 'L' :	return validarLetras(campo,tempID[2],'',true);
						break;
			case 'A' :	return validarAlfaN(campo,tempID[2],true);
						break;
			case 'N' :	return validarNum(campo,tempID[2],true);
						break;
			case 'S' :	return validarSelect(campo,true);
						break;
		}
	}
}

function anyoBisiesto(anyo){
	var fin = anyo;
	if (fin % 4 != 0)
    return false;
    else {
		if (fin % 100 == 0) {
			if (fin % 400 == 0){
				return true;
			}
			else {
				return false;
			}
		}
		else {
		   return true;
		}
	}
}

function fechaValida(dia,mes,anyo, conMsg){
  var anyohoy = new Date();
  var Mensaje = "";
  var yearhoy = anyohoy.getYear();
  if (yearhoy < 1999)
    yearhoy = yearhoy + 1900;
  if(anyoBisiesto(anyo))
    febrero = 29;
  else
      febrero = 28;
  if ((mes == 2) && (dia > febrero)){
		Mensaje += "Día de nacimiento inválido.\r\n";
  }
  if (((mes == 4) || (mes == 6) || (mes == 9) || (mes == 11)) && (dia > 30)){
		Mensaje += "Día de nacimiento inválido.\r\n";
  }
  if (mes == ''){
		
  }
  if ((anyo<1950) || (yearhoy - anyo < 15)){
		Mensaje += "Año de nacimiento inválido.\r\n";
  } 
  if (Mensaje != "") {
	   alert(Mensaje);
	   return false;
  }
  else {
	  return true;
  }
}


function mostrar_ayuda(ayudaURL) {
		window.open(ayudaURL,"instruciones","left=0,top=0,width=700,height=250,scrollbars=0,resizable=0,status=0");
}

function verificarFecha(f, conMsg){
	with(f){
		var dia = parseInt (diaN.selectedIndex);
		var mes = parseInt (mesN.selectedIndex);
		var anyo = parseInt ('0'+anioN.value,10) + 1900;

		if (!fechaValida(dia,mes,anyo, conMsg)) {
			diaN.style.backgroundColor = "#FFFF99";
			mesN.style.backgroundColor = "#FFFF99";
			anioN.style.backgroundColor = "#FFFF99";
			return false;
		}
		else {
			diaN.style.backgroundColor = "#FFFFFF";
			mesN.style.backgroundColor = "#FFFFFF";
			anioN.style.backgroundColor = "#FFFFFF";
			return true;
		}
	}
}

function validarF(f){
	var hayError = false;
	totalE = 0;
	with (f){
		for (i =0;i<elements.length ;i++ ){
			temp = elements[i].id.split('_');
			if (temp.length == 3 && elements[i].style.display !='none') {
				switch (temp[1]) {
					case 'L' :	hayError = !validarLetras(elements[i],temp[2],'',false);
								break;
					case 'A' :	hayError = !validarAlfaN(elements[i],temp[2],false);
								break;
					case 'N' :	hayError = !validarNum(elements[i],temp[2],false);
								break;
					case 'S' :  hayError = !validarSelect(elements[i],false);
								break;
				}
				if(hayError){
					totalE++;
				}
			}
		}
	}
	if (!verificarFecha(f,false)) totalE++;
	if(totalE>0){
		document.getElementById('msgError').style.display='block';
		alert('Verifique: \nExisten errores en los campos marcados en amarillo.');
		document.getElementById('Procesar').style.display='block';
		var sex = sexoS.value;
		if(sex){
			
		
		}
		//return false;
	}
	else {
//		prepdata();	
//		if (f.apellidos.value.indexOf(f.apellido_v.value) >= 0) {
//			f.submit();
			return true;
//		}
//		else {
			/*alert('Disculpe, El apellido introducido no esta registrado.\n Por favor corrija e intente de nuevo.');
			alert(f.contra.value);
			f.apellidos.style.backgroundColor='#FFFF99';
			f.apellidos.focus();
			document.getElementById('Procesar').style.display='block';*/
//			f.submit();
//			return true;
//		}
	}
}
