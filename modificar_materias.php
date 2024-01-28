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
								alert('Los códigos en GRIS están repetidos. Debe modificarlos.');
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
							alert('Las notas en VERDE deben ser mayor a la Mínima Nota Aprobatoria.');
							band1=1;}
						if(esca!='150' && esca-nota<0){ 
							campo.style.background='#8FF2F8';							
							alert('Las notas en AZUL están fuera de la Escala de Evaluación.');
							band1=1;}
						if(escala=='150' && 100-nota<0){ 
							campo.style.background='#8FF2F8';
							alert('Las notas en AZUL están fuera de la Escala de Evaluación.');
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
	$ced=$_GET['ced'];
	$ape=$_GET['ape'];
	if($ape=='')
		$ape=$_POST['ape'];
	$opc=$_GET['opc'];
	$min=$_GET['min'];
	$esca=$_GET['escala'];
	if($ced=='' || $opc==''){
		$ced=$_POST['ced'];
		$opc=$_POST['opc'];
	}
	if($min=='' || $esca==''){
		$min=$_POST['notaA'];
		$esca=$_POST['escala'];
	}
	$inc=$_POST['inc'];
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
		echo "<div class='tit2'><b>Modifique los datos de las asignaturas sobreescribiendo los campos. Cuando termine, pulse el boton \"Guardar Cambios y Regresar\", para volver a la Planilla de Solicitud.</b><br><br></div>";
	}
	
	function mostrar_opcion($ced,$opc){
		global $basededatos,$$usuariodb,$clavedb;
		$conn=odbc_connect($basededatos,$usuariodb,$clavedb);
		$sql="SELECT * FROM MATERIAS WHERE CI_E='$ced'";
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
			echo "<tr><td><input type='text' name='cod$i' size='7' value='$x[C_ASIGNA]' onKeyUp='validarN(this);'></td>
				<td><input type='text' name='mat$i' size='80' value='$x[ASIGNATURA]' onKeyUp='validarA(this);'></td>
				<td><input type='text' name='not$i' size='2' value='$x[NOTA]' onKeyUp='validarN(this);' maxlength='5'></td>
				</tr>";
			}
		echo "<input type='hidden' name='inc' value='$i'>";
	}
?>
<body>
<form name="materias" method="POST" action="modificar_materias.php">	
	<?php mostrar_msj($opc); ?>
	<input type="hidden" name="flag" value="1">
	<input type="hidden" name="ape" value="<?php echo $ape; ?>">
	<input type="hidden" name="ced" value="<?php echo $ced; ?>">
	<input type="hidden" name="opc" value="<?php echo $opc; ?>">
	<input type="hidden" name="escala" value="<?php echo $esca; ?>">
	<input type="hidden" name="notaA" value="<?php echo $min; ?>">
	<table id="thetab" width="840" style="background:#DAF0FC" cellpadding="2" cellspacing="0">
	<tr>
		<?php mostrar_opcion($ced,$opc); ?>
		<td colspan="5" align="center"><br><input class="boton" type="button" value="Aplicar Cambios" id="anadir" 
		name="anadir" onClick="if(verificar()=='1'){} else materias.submit();">
		</td>
	</tr>
	</table>
	<table width="840">
	<tr><td align="center"><br><input class="boton" type="button" value="Volver a la Planilla" name="anadir" onClick="opener.location.reload('planilla_externa_solicitud.php?ced='+ced.value+'&ape='+ape.value+'&flag='+flag.value+''); window.close();"></td></tr></table>
</form>
</body>
</html>
