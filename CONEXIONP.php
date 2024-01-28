<?php
	include_once('inc/config.php');
	$codc1=$_POST['cod'];
	if($codc1=='aeiou'){
				echo "Nombre Universidad: <input type='text' name='nombre_u' id='nombreu_L_1' size='70' maxlength='100' onkeyup='validarL(this)' onchange='validar(this)'>
				 &nbsp;&nbsp;&nbsp;&nbsp;Pa&iacute;s: <input type='text' name='nucleo' id='nucleo_L_1' size='25' maxlength='50' onkeyup='validarL(this)' onchange='validar(this)'><br>
				Menci&oacute;n/Carrera: <input type='text' name='mencion' id='mencion_L_1' size='60' maxlength='50' onkeyup='validarL(this)' onchange='validar(this)'><br>";
			}
?>