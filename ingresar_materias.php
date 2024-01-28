<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Inserción, Modificación y Eliminación de Materias</title>
</head>
<script LANGUAGE="Javascript" SRC="validacion.js"></script>
<script languaje="javaScript">
	function verificar(){
		var k=1;
		band=0;
		band1=0;
		band2=0;
		with(document.materias){
			while(k<=inc.value){
				codi=eval("cod"+k+".value");
				mate=eval("mat"+k+".value");
				nota=eval("not"+k+".value");
				if(codi=='' || mate=='' || nota==''){
					if(codi==''){
						campo=eval("cod"+k+"");
						campo.style.background='#FFFF88';
					}
					if(mate==''){
						campo=eval("mat"+k+"");
						campo.style.background='#FFFF88';
					}
					if(nota==''){
						campo=eval("not"+k+"");
						campo.style.background='#FFFF88';
					}
					band=1;
				}
				else{
					if(codi!=''){
						campo=eval("cod"+k+"");
						campo.style.background='#FFFFFF';
							cont=0;
							b=1;
							while(b<=inc.value){
								code=eval("cod"+b+".value");
								if(codi==code){
									cont=cont+1;
									if(cont>1){
										band2=1;
										campo=eval("cod"+b+"");
										campo.style.background='#CCCCCC';
										campo=eval("cod"+k+"");
										campo.style.background='#CCCCCC';
									}
									else{
										campo=eval("cod"+b+"");
										campo.style.background='#FFFFFF';
										campo=eval("cod"+k+"");
										campo.style.background='#FFFFFF';
									}
								}
								b++;
							}
							if(band2=='1'){
								alert('El Código de Asignatura ingresado ya existe. Debe modificarlo.');
								return band2;
							}
					}
					if(mate!=''){
						campo=eval("mat"+k+"");
						campo.style.background='#FFFFFF';
					}
					if(nota!=''){
						campo=eval("not"+k+"");
						campo.style.background='#FFFFFF';
						esca=eval("escala.value");
						mini=eval("notaA.value");
						if(nota-mini<0){ 
							campo.style.background='#9BD898';
							alert('La nota en VERDE debe ser mayor a la Mínima Nota Aprobatoria.');
							band1=1;}
						if(esca!='150' && esca-nota<0){ 
							campo.style.background='#8FF2F8';							
							alert('La nota en AZUL esta fuera de la Escala de Evaluación.');
							band1=1;}
						if(escala=='150' && 100-nota<0){ 
							campo.style.background='#8FF2F8';
							alert('La nota en AZUL esta fuera de la Escala de Evaluación.');
							band1=1;}
					}
				}
				k++;
			}
			if(band=='1')
				alert('Los campos en AMARILLO deben tener algún valor.');
			else{
				if(band1=='1') return band1;
				if(band2=='1') return band2;
			}
			return band;
		}
	}
</script>
<style type=text/css>
	.tit1 {
		text-align: left; font-family:Arial; font-size: 12px; font-weight: normal; font-variant: small-caps;
	}
	.tit2 {
		text-align: left; font-family:Arial; font-size: 14px; font-weight: normal; font-variant: small-caps; color:#FF0000
	}
	.boton {
 		text-align: center; font-family:Arial; font-size: 11px; font-weight: normal; background-color:#e0e0e0; font-variant: small-caps; height: 20px;
  		padding: 0px;
  }
</style>
<?php
	include_once('inc/config.php');
	$conn=odbc_connect($basededatos,$usuariodb,$clavedb);
	$flagest=$_GET['flagest'];
	if($flagest=='')
		$flagest=$_POST['flagest'];
	$ced=$_GET['ced'];
	$ape=$_GET['ape'];
	if($ape=='')
		$ape=$_POST['ape'];
	$opc=$_GET['opc'];
	$min=$_GET['min'];
	$mini='1';
	$esca=$_GET['escala'];
	$maxi=$esca;
	if($esca=='150'){
		$maxi='100';
		$mini='50';
	}
	if($ced=='' || $opc==''){
		$ced=$_POST['ced'];
		$opc=$_POST['opc'];
	}
	if($min=='' || $esca==''){
		$min=$_POST['notaA'];
		$esca=$_POST['escala'];
	}
	$niveles=$_GET['nivel_estudioS'];
	$sql="SELECT NIVEL FROM NIVELES WHERE NIVEL_C='$niveles'";
	$stmt=odbc_exec($conn,$sql);
	$niveles=odbc_result($stmt,'NIVEL');
	$modoes=$_GET['modo_estudioS'];
	$naprobs=$_GET['naprobS'];
	$creda=$_GET['credA'];
	$inc=$_POST['inc'];
	$sql="SELECT CI_E FROM DATOSA WHERE CI_E='$ced'";
	$stmt=odbc_exec($conn,$sql);
	$cede=odbc_result($stmt,'CI_E');
	if($cede==''){
		$sql="INSERT INTO DATOSA(CI_E,NIVEL,NIV_PROB,CRED_APROB,MODO,ESCALA,MIN_APROB,ESTATUS) VALUES('$ced','$niveles','$naprobs','$creda','$modoes','$mini-$maxi','$min','0')";
		$stmt=odbc_exec($conn,$sql);
	}
	else{
		$sql="UPDATE DATOSA SET NIVEL='$niveles',NIV_APROB='$naprobs',CRED_APROB='$creda',MODO='$modoes',ESCALA='$mini-$maxi',MIN_APROB='$min' WHERE CI_E='$ced'";
		$stmt=odbc_exec($conn,$sql);
	}
	if($inc>'0'){
		$sql="DELETE FROM MATERIAS WHERE CI_E='$ced'";
		$stmt=odbc_exec($conn,$sql);
		for($j=1;$j<=$inc;$j++){
			$cod=$_POST['cod'.$j.''];
			$mat=$_POST['mat'.$j.''];
			$not=$_POST['not'.$j.''];
			$sql="INSERT INTO MATERIAS VALUES ('$ced','$mat','$not','$cod')";
			$stmt=odbc_exec($conn,$sql);
		}
	}
	
	function mostrar_msj($opc){
		echo "<div class='tit2'><b>LLene todos los campos de la nueva asignatura. Si desea agregar otra asignatura pulse el botón \"Añadir Materias\". Cuando termine, pulse el boton \"Guardar Cambios y Regresar\", para volver a la Planilla de Solicitud.</b><br><br></div>";
	}
	
	function mostrar_opcion($ced,$opc){
		global $basededatos,$$usuariodb,$clavedb;
		$conn=odbc_connect($basededatos,$usuariodb,$clavedb);
		$i=$_GET['inc'];
		if($i=='')
			$i=$_POST['inc'];
		$bandera=$_POST['bandera'];
		if($i!='0'){
			$sql="SELECT * FROM MATERIAS WHERE CI_E='$ced' ORDER BY C_ASIGNA ASC";
			$stmt=odbc_exec($conn,$sql);
			$i=0;
			echo "<tr><td style='width: 100;'><div class='tit1' id='etqcodmat'><b>CÓDIGO</b>
					</div></td>
               		<td style='width: 520;'><div class='tit1' id='etqnommat'><b>ASIGNATURA</b></div></td>
					<td style='width: 100;'><div class='tit1' id='etqnotmat'><b>NOTA(Ej: 9.0)</b>
					</div></td>
					<td style='width: 80;'><div class='tit1' id='etqelimmat' style='color: red'></div></td></tr>";
			while($x=odbc_fetch_array($stmt)){
				$i++;
				echo "<tr><td><input type='text' disabled='discabled' size='7' value='$x[C_ASIGNA]'></td>
					<td><input type='text' size='80' disabled='discabled' value='$x[ASIGNATURA]'></td>
					<td><input type='text' size='2' disabled='discabled' value='$x[NOTA]'></td>
					</tr>
					<input type='hidden' name='cod$i' size='7' value='$x[C_ASIGNA]'>
					<input type='hidden' name='mat$i' size='80' value='$x[ASIGNATURA]'>
					<input type='hidden' name='not$i' size='2' value='$x[NOTA]'>";
			}
		}
		if($bandera=='1'){
			$i++;
			if($i==1){
		 		echo "<tr><td style='width: 100;'><div class='tit1' id='etqcodmat'><b>CÓDIGO</b>
					</div></td>
               		<td style='width: 520;'><div class='tit1' id='etqnommat'><b>ASIGNATURA</b></div></td>
					<td style='width: 100;'><div class='tit1' id='etqnotmat'><b>NOTA(Ej: 9.0)</b>
					</div></td>
					<td style='width: 80;'><div class='tit1' id='etqelimmat' style='color: red'></div></td></tr>";
			}
			echo "<tr><td><input type='text' name='cod$i' size='7' value='' onKeyUp='validarA1(this);'></td>
					<td><input type='text' name='mat$i' size='80' value='' onKeyUp='validarA(this);'></td>
					<td><input type='text' name='not$i' size='2' value='' onKeyUp='validarN(this);' maxlength='5'></td>
					</tr>";
		}
		echo "<input type='hidden' name='inc' value='$i'>";
	}
?>
<body>
<form name="materias" method="POST" action="ingresar_materias.php">	
	<?php mostrar_msj($opc); ?>
	<input type="hidden" name="flagest" value="<?php echo $flagest; ?>">	
	<input type="hidden" name="ced" value="<?php echo $ced; ?>">
	<input type="hidden" name="flag" value="1">
	<input type="hidden" name="bandera" value="">
	<input type="hidden" name="ape" value="<?php echo $ape; ?>">
	<input type="hidden" name="opc" value="<?php echo $opc; ?>">
	<input type="hidden" name="escala" value="<?php echo $esca; ?>">
	<input type="hidden" name="notaA" value="<?php echo $min; ?>">
	<table id="thetab" width="840" style="background:#DAF0FC" cellpadding="2" cellspacing="0">
	<tr>
		<?php mostrar_opcion($ced,$opc); ?>
		<td colspan="5" align="center"><input class="boton" type="button" value="Añadir Materias" onClick="if(verificar()=='1'){} else{ bandera.value='1'; materias.submit();}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input class="boton" type="button" value="Guardar Cambios" onClick="if(verificar()=='1'){} else materias.submit();"><br>
		</td>
	</tr>
	</table>
	<table width="840">
	<tr><td align="center"><br><input class="boton" type="button" value="Volver a la Planilla" name="anadir" onClick="opener.location.reload('planilla_externa_solicitud.php?ced='+ced.value+'&ape='+ape.value+'&flag='+flag.value+'&flagest='+flagest.value+''); window.close();"></td></tr></table>
</form>
</body>
</html>