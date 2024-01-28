<html>
<head>
<title>Código Materias</title>
</head>
<script LANGUAGE="Javascript" SRC="asrequest.js"></script>
<script language="javascript">
	function seleccionar_p(formulario){
		var i=0;
		with(formulario){
			while(i>=0){
				if(seleccion[i].checked){
					contador.value=i+1;
					
					fajax('UNIVER_APLI.php','univerapli','contador='+contador.value+'&ced='+ci_e.value+'&ape='+apellidos.value+'&flag='+flag.value+'&flagest='+flagest.value+'','post','0');
					opener.location.reload('planilla_externa_solicitud.php');
					//window.close();
					break;
				}
				i++;
				if(i>=flagi.value){
					alert('Debes elegir un Instituto para Continuar.');
					break;
				}
			}
		}
	}
</script>
<?php
	include_once('inc/config.php');
	$flagest=$_GET['flagest'];
	$ced=$_GET['ced'];
	$ape=$_GET['ape'];
	$conn=odbc_connect($basededatos,$usuariodb,$clavedb);
	$sql="SELECT CODIGO_C,UNIVERSIDAD,MENCION,NUCLEO FROM UNIVEXTER ORDER BY UNIVERSIDAD";
	$stmt=odbc_exec($conn,$sql);
	$i=0;
	echo "<form name='datos' method='post' action='planilla_externa_solicitud.php'><div id='univerapli'><b>CARRERAS EN SISTEMA</b><br>";
	echo "<table><tr style='font-size:16; text-align:center'>
			<td><b>Elegir</b></td>
			<td><b>C&oacute;digo Opsu</b></td>
			<td><b>Instituto/Universidad</b></td>
			<td><b>N&uacute;cleo</b></td>
			<td><b>Menci&oacute;n</b></td>
			<td>&nbsp;</td>
		</tr>";
		while($x=odbc_fetch_array($stmt)){
			$i++;
			if($i%2==0)
				$color='white';
			else
				$color='#BBBDFF';
			echo "<tr style='background-color:$color'>
					<td style='width:10'><input type='radio' name='seleccion'></td>
					<td style='font-size:12; width:100; text-align:center'>$x[CODIGO_C]</td>
					<td style='font-size:12; width:500; text-align:center'>$x[UNIVERSIDAD]</td>
					<td style='font-size:12; width:100; text-align:center''>$x[NUCLEO]</td>
					<td style='font-size:12; width:400; text-align:center''>$x[MENCION]</td>
					<td><input type='button' value='Aceptar' onClick='if(confirm(\"Seguro que desea continuar?\")) seleccionar_p(datos);'></td></div>
				</tr>";
		}
	echo "</table>";
?>
<body>
	<table><tr>
		<td style="width:200; text-align:center">
		<input type="hidden" name="contador" value="">
		<input type="hidden" name="ci_e" value="<?php echo $ced; ?>">
		<input type="hidden" name="apellidos" value="<?php echo $ape; ?>">
		<input type="hidden" name="flagest" value="<?php echo $flagest; ?>">
		<input type="hidden" name="flagi" value="<?php echo $i; ?>">
		<input type="hidden" name="flag" value="1"></td>
	</tr>
	</table>
</form>
</body>
</html>
