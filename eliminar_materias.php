
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Inserción, Modificación y Eliminación de Materias</title>
</head>
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
	if($ced=='' || $opc==''){
		$ced=$_POST['ced'];
		$opc=$_POST['opc'];
	}
	$inc=$_POST['inc'];
	if($inc!='0'){
		for($j=1;$j<=$inc;$j++){
			if(isset($_POST['elim'.$j.''])){
				$cod=$_POST['cod'.$j.''];
				$sql="DELETE FROM MATERIAS WHERE C_ASIGNA='$cod'";
				$stmt=odbc_exec($conn,$sql);
			}
		}
	}

	function mostrar_msj($opc){
		echo "<div class='tit2'><b>Marque las asignaturas haciendo click en el recuadro correspondiente a la fila y luego pulse el boton \"Guardar Cambios y Regresar\", para eliminarlas y volver a la Planilla de Solicitud.</b><br><br></div>";
	}
	
	function mostrar_opcion($ced,$opc){
		global $basededatos,$$usuariodb,$clavedb;
		$conn=odbc_connect($basededatos,$usuariodb,$clavedb);
		$sql="SELECT * FROM MATERIAS WHERE CI_E='$ced'";
		$stmt=odbc_exec($conn,$sql);
		$i=0;
		echo "<tr><td style='width: 80;'><div class='tit1' id='etqelimmat' style='color: red; text-align:center'><b>Eliminar</b></div></td>
				<td style='width: 100;'><div class='tit1' id='etqcodmat'><b>Código</b>
				</div></td>
               	<td style='width: 520;'><div class='tit1' id='etqnommat'><b>Asignatura</b></div></td>
				<td style='width: 100;'><div class='tit1' id='etqnotmat'><b>Nota(Ej: 9.0)</b>
				</div></td>
				</tr>";
		while($x=odbc_fetch_array($stmt)){
			$i++;
			echo "<tr><td align='center'><input type='checkbox' name='elim$i'></td>
				<td><input type='text' disabled='disabled' size='7' value='$x[C_ASIGNA]'></td>
				<td><input type='text' disabled='disabled' size='80' value='$x[ASIGNATURA]'></td>
				<td><input type='text' disabled='disabled' size='2' value='$x[NOTA]'></td>
				</tr>
				<input type='hidden' name='cod$i' size='7' value='$x[C_ASIGNA]'>
				<input type='hidden' name='mat$i' size='80' value='$x[ASIGNATURA]'>
				<input type='hidden' name='not$i' size='2' value='$x[NOTA]'>";
		}
		echo "<input type='hidden' name='inc' value='$i'>";
	}
?>
<body>
<form name="materias" method="POST" action="eliminar_materias.php">	
	<?php mostrar_msj($opc); ?>
	<input type="hidden" name="flag" value="1">
	<input type="hidden" name="ape" value="<?php echo $ape; ?>">
	<input type="hidden" name="ced" value="<?php echo $ced; ?>">
	<input type="hidden" name="opc" value="<?php echo $opc; ?>">
	<table id="thetab" width="840" style="background:#DAF0FC" cellpadding="2" cellspacing="0">
	<tr>
		<?php mostrar_opcion($ced,$opc); ?>
		<td colspan="5" align="center"><br><input class="boton" type="button" value="Aplicar Cambios" id="anadir" 
		name="anadir" onClick="materias.submit();">
		</td>
	</tr>
	</table>
	<table width="840">
	<tr><td align="center"><br><input class="boton" type="button" value="Volver a la Planilla" name="anadir" onClick="opener.location.reload('planilla_externa_solicitud.php?ced='+ced.value+'&ape='+ape.value+'&flag='+flag.value+''); window.close();"></td></tr></table>
</form>
</body>
</html>