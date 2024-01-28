<?php
//print_r($_POST);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<script LANGUAGE="Javascript" SRC="asrequest.js"></script>
<script LANGUAGE="Javascript" SRC="inscni.js"></script>
<script language="javascript">
	var numero = 1;    
	var fila = 1;   
	function insertrow()
	{
		with(document.datos_p){
		numero = numero + 1;
		fila = fila +1;
		campo=eval("inc");
		campo.value=numero;
		var newRow = document.getElementById("thetable").insertRow(fila);
		var newCell1 = newRow.insertCell(0);
		newCell1.innerHTML ='<tr><td align="center"><input type="text" name="cod'+numero+'" id="cod'+numero+'_N_1" size="7" onKeyUp="validarN(this);" onBlur="if(this.value==\'\') flag1.value=\'1\'; else flag1.value=\'\';" onClick="this.style.background=\'#FFFFFF\';"></td>';
		var newCell2 = newRow.insertCell(1);	
		newCell2.innerHTML ='<td align="center"><input type="text" name="mat'+numero+'" id="mat'+numero+'_A_1" size="80" onKeyUp="validarA(this);" onBlur="if(this.value==\'\') flag2.value=\'1\'; else flag2.value=\'\';" onClick="this.style.background=\'#FFFFFF\';"></td>';
		var newCell3 = newRow.insertCell(2);
		newCell3.innerHTML = '<td align="center"><input type="text" name="not'+numero+'" id="notmat'+numero+'_N_1" size="2" onKeyUp="validarN(this);" onBlur="if(this.value==\'\') flag3.value=\'1\'; else{ flag3.value=\'\'; if(this.value-notaA.value<0){ alert(\'La nota ingresada es errónea.\'); this.value=\'\'; flag3.value=\'1\';} if(escala.value!=\'150\' && escala.value-this.value<0){ alert(\'La nota ingresada es errónea.\'); this.value=\'\'; flag3.value=\'1\';} if(escala.value==\'150\' && 100-this.value<0){ alert(\'La nota ingresada es errónea.\'); this.value=\'\'; flag3.value=\'1\';}}" onClick="this.style.background=\'#FFFFFF\';"></td></tr>';
		var newCell4 = newRow.insertCell(3);	
		newCell4.innerHTML ='<td>Eliminar<input type="checkbox" name="elimmat'+numero+'"></td>';
	}
	}
	function removerow()
	{
		var tbl = document.getElementById('thetable');
		var lastRow = tbl.rows.length;
		if (lastRow > 3) {
		tbl.deleteRow(lastRow - 3);
		fila=fila-1;      
		numero=numero-1;    
		}
	}
	
	function recargar(formulario){
		if(formulario.bondera.value!=""){
			with(formulario){
				switch(bondera.value){
					case '1': ruta="planilla_externa_solicitud.php"; break;
					case '2': ruta="registrado_externa.php"; break;				
				}
			}
			formulario.action=ruta;
			formulario.submit();
		}
	}
	
	function verificar(){
		var k=1;
		var b=1;
		var b1;
		band=0;
		band1=0;
		band2=0;
		band21=0;
		with(document.datos_p){
			if(inc.value>=1){
				cont1=0;
				b1=1;
				for(b=1;b<=inc.value;b++){
					campo=eval("cod"+b+"");
					campo.style.background='#FFFFFF';
				}
				alert('ulaula');
				while(b1<=inc.value){
					code=eval("cod"+b1+".value");
					cont2=0;
					for(b=1;b<=inc.value;b++){
						codu=eval("cod"+b+".value");
						if(codu==code){
							cont2=cont2+1;
							if(cont2>1){
								band21=1;
								campo=eval("cod"+b1+"");
								campo.style.background='#CCCCCC';
								campo=eval("cod"+b+"");
								campo.style.background='#CCCCCC';
							}
							else{
								campo=eval("cod"+b1+"");
								campo.style.background='#FFFFFF';
								campo=eval("cod"+b+"");
								campo.style.background='#FFFFFF';
							}
						}
					}
					b1++;
				}
				if(band21=='1')
					alert('Los códigos en GRIS están repetidos. Debe modificarlos.');
				return band21;
			}
/*			else
				return 0;			
			while(k<=inc.value){
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
						band1=1;
					}
					if(esca!='150' && esca-nota<0){ 
						campo.style.background='#8FF2F8';							
						alert('Las notas en AZUL están fuera de la Escala de Evaluación.');
						band1=1;
					}
					if(escala=='150' && 100-nota<0){ 
						campo.style.background='#8FF2F8';
						alert('Las notas en AZUL están fuera de la Escala de Evaluación.');
						band1=1;
					}
				}
				k++;
			}
			if(band=='1')
				alert('Los campos en AMARILLO deben tener algún valor.');
			else
				band=band1;*/
			return band;
		}
	}
function popUp(URL){
	day=new Date();
	id=day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=1,scrollbars=1,location=1,statusbar=1,menubar=1,resizable=1,width=400,height=400,left = 212,top =134');");
}
</script>
<title>Planilla</title>
</head>

<style type=text/css>#prueba {
	OVERFLOW: hidden
}
.titulo {
	MARGIN-TOP: 0px; FONT-WEIGHT: normal; FONT-SIZE: 14px; MARGIN-BOTTOM: 0px; FONT-FAMILY: Arial; TEXT-ALIGN: center
}
.enca {
	MARGIN-TOP: 0px; FONT-WEIGHT: bold; FONT-SIZE: 20px; MARGIN-BOTTOM: 0px; FONT-FAMILY: Arial; TEXT-ALIGN: center
}
.tit {
	text-align: left; 
  	font-family:Arial; 
  	font-size: 14px;
  	font-weight: bolder	; 
  	font-variant: small-caps;
}
.trans {
	margin-top: 0px; font-weight:lighter; font-size: 14px; color:#999999; font-family: Arial; margin-bottom:0px;
}
.tit1 {
	text-align: left; 
  	font-family:Arial; 
  	font-size: 12px;
  	font-weight: normal; 
  	font-variant: small-caps;
}
.tit15 {
	text-align: left; 
  	font-family:Arial; 
  	font-size: 11px;
  	font-weight: normal; 
  	font-variant: small-caps;
	color:red;
}
.tit12 {
	text-align: left; 
  	font-family:Arial; 
  	font-size: 13px;
  	font-weight: bold; 
  	font-variant: small-caps;
	color:#FF0000;
}
.boton {
  text-align: center; 
  font-family:Arial; 
  font-size: 11px;
  font-weight: normal;
  background-color:#e0e0e0; 
  font-variant: small-caps;
  height: 20px;
  padding: 0px;
  }
</style>


<?php
	include_once('inc/config.php');
	
	$flagest = $_POST['flagest'];
	if($flagest=='')
		$flagest=$_GET['flagest'];
	$flag = $_POST['flag'];
	if($flag=='')
	
		$flag = $_GET['flag'];

	$ced=$_POST['cedula_v'];
	if($ced=='')
		$ced=$_POST['ci_e'];
	$ape=$_POST['apellido_v'];
	if($ape=='')
		$ape=$_GET['ape'];
	$bondera=$_POST['bondera'];
	$estatus = $_POST['estatus'];
	$contador=$_GET['contador'];
	
	$ced = $_POST['cedula_v'];
	
	$conn=odbc_connect($basededatos,$usuariodb,$clavedb);
	$conn1=odbc_connect($basededatos1,$usuariodb1,$clavedb1);
	$sqlver="SELECT * FROM DATOSA WHERE CI_E='$ced'";
	$stmtver=odbc_exec($conn,$sqlver);
	$uni=odbc_result($stmtver,'UNIVERSIDAD');
	$unix=odbc_result($stmtver,'CI_E');
	$codc=odbc_result($stmtver,'CODIGO_C');
	$men=odbc_result($stmtver,'MENCION');
	$nuc=odbc_result($stmtver,'NUCLEO');

	if($bondera =='1'){
		$flag='1';	
		$ced = $_REQUEST['ci_e'];
		$ape = $_REQUEST['apellidos'];
		$ape2 = $_REQUEST['apellidos2'];
		$nom = $_REQUEST['nombres'];
		$nom2 = $_REQUEST['nombres2'];
		$dian = $_REQUEST['diaN'];
		$mesn = $_REQUEST['mesN'];
		$anion = $_REQUEST['anioN'];
		$ye=date("y");
		if($anion>$ye)
			$anion="19$anion";
		else
			$anion="20$anion";
		$nac = $_REQUEST['nac_eS'];
		$sex = $_REQUEST['sexoS'];
		$pnac = $_REQUEST['p_nac_e'];
		$lnac = $_REQUEST['l_nac_e'];
		$espc = $_REQUEST['c_uni_ca'];
		$corr1 = $_REQUEST['correo1'];
		$corr2 = $_REQUEST['correo2'];
		$edoc = $_REQUEST['edo_c_eS'];
		$ave = $_REQUEST['avenida'];
		$urb = $_REQUEST['urbanizacion'];
		$man = $_REQUEST['manzana'];
		$nro = $_REQUEST['nrocasa'];
		$ciu = $_REQUEST['ciudad'];
		$edo = $_REQUEST['estado'];
		$ctel = $_REQUEST['codT'];
		$ntel = $_REQUEST['telefono'];
		$ccel = $_REQUEST['celcod'];
		$ncel = $_REQUEST['celnro'];
		$cfax = $_REQUEST['codfax'];
		$nfax = $_REQUEST['nrofax'];
		$aver = $_REQUEST['avenidar'];
		$urbr = $_REQUEST['urbanizacionr'];
		$manr = $_REQUEST['manzanar'];
		$nror = $_REQUEST['nrocasar'];
		$ciur = $_REQUEST['ciudadr'];
		$edor = $_REQUEST['estador'];
		$ctelr = $_REQUEST['codTR'];
		$ntelr = $_REQUEST['telefonoR'];
		if($uni=='')	
			$uni = $_REQUEST['nombre_u'];
		if($men=='')
			$men = $_REQUEST['mencion'];
		if($codc=='')
			$codc = $_REQUEST['codigoc'];
		if($nuc=='')
			$nuc = $_REQUEST['nucleo'];
		$niv = $_REQUEST['nivel_estudioS'];
		$esc = $_REQUEST['escala'];
		if($esc=='150'){
			$esca="50 - 100";
			$esc="50-100";
		}
		else{
			$esca="1 - $esc";
			$esc="1-$esc";
		}
		$min = $_REQUEST['notaA'];
		$nia = $_REQUEST['naprobS'];
		$mod = $_REQUEST['modo_estudioS'];
		$cre = $_REQUEST['credA'];
		$tipo='';
		if($nac=='E')
			$tipo = $_REQUEST['res_extrajS'];
		$sql="SELECT CI_E FROM DATOS_P WHERE CI_E='$ced'";
		$stmt=odbc_exec($conn,$sql);
		$cedx=odbc_result($stmt,'CI_E');
		$sql="SELECT CARRERA1 FROM TBLACA010 WHERE C_UNI_CA='$espc'";
		$stmt=odbc_exec($conn1,$sql);
		$espec=odbc_result($stmt,'CARRERA1');
		$sql="SELECT NIVEL FROM NIVELES WHERE NIVEL_C='$niv'";
		$stmt=odbc_exec($conn,$sql);
		$niv=odbc_result($stmt,'NIVEL');
		
		if($cedx==''){
			$fecha=date("Y-m-d");
			$year=date("Y")+2;
			$fechaf=date("-m-d");
			$tel1="$ctel-$ntel";
			$tel2="$ccel-$ncel";
			$tel3="$cfax-$nfax";
			$telr="$ctelr-$ntelr";
			$sql="INSERT INTO DATOS_P VALUES('$ced','$ave','$ape','$ape2','$nom','$nom2','$sex','$anion-$mesn-$dian',
			'$pnac','$lnac','$edoc','$corr1','$corr2','$espc','$nac','$urb','$man','$nro','$ciu',							 						 			 		'$edo','$tel1','$tel2','$tel3','$aver','$urbr','$nror','$ciur','$edor','$telr','$tipo','$fecha','$year$fechaf','')";
			$stmt=odbc_exec($conn,$sql);
			if($unix!=''){
				$sqlso="SELECT SOLICITUD FROM DATOSA";
						$stmtso=odbc_exec($conn,$sqlso);
						$solicitud=10000;
						while($z=odbc_fetch_array($stmtso)){
							if($z['SOLICITUD']>$solicitud)
								$solicitud=$z['SOLICITUD'];
					}
				$solicitud++;
				$sqlun="INSERT INTO DATOSA VALUES('$ced','0','$uni','$codc','$men','','','','','','','$nuc','0','$solicitud')";
				$stmtun=odbc_exec($conn, $sqlun);
			}
		}
		else{
			$sql="SELECT FECHA_SOLICITUD FROM DATOS_P WHERE CI_E='$ced'";
			$stmt=odbc_exec($conn,$sql);
			$fechaS=odbc_result($stmt,'FECHA_SOLICITUD');
			$tel1="$ctel-$ntel";
			$tel2="$ccel-$ncel";
			$tel3="$cfax-$nfax";
			$telr="$ctelr-$ntelr";
			$sql="UPDATE DATOS_P SET APELLIDOS2='$ape2', NOMBRES='$nom', NOMBRES2='$nom2', F_NAC_E='$anion-$mesn-$dian', SEXO='$sex', P_NAC_E='$pnac', L_NAC_E='$lnac', EDO_C_E='$edoc', CORREO1='$corr1', CORREO2='$corr2', AVENIDA='$ave', URBANIZACION='$urb', MANZANA='$man', NROCASA='$nro', CIUDAD='$ciu', ESTADO='$edo', TELEFONO1='$tel1', TELEFONO2='$tel2', TELEFONO3='$tel3', ESP_CURSAR='$espc', AVENIDA_R='$aver', URBANIZACION_R='$urbr', NROCASA_R='$nror', CIUDAD_R='$ciur', ESTADO_R='$edor', TELEFONO_R='$telr', TIPO_EXTRANJERO='$tipo' WHERE CI_E='$ced'";
			$stmt=odbc_exec($conn,$sql);
			if($uni!='' && $unix==''){
			$sql="UPDATE DATOSA SET UNIVERSIDAD='$uni', CODIGO_C='$codc', MENCION='$men', ESCALA='$esc', MODO='$mod', MIN_APROB='$min', NIVEL='$niv', NIV_APROB='$nia', CRED_APROB='$cre', NUCLEO='$nuc' WHERE CI_E='$ced'";
			$stmt=odbc_exec($conn,$sql);}
		}
	}
	$sql="SELECT CI_E FROM DATOS_P WHERE CI_E='$ced'";
	$stmt=odbc_exec($conn,$sql);
	$cedu=odbc_result($stmt,'CI_E');
	//if($flag=='1'){
	if(!empty($cedu)){
		$sql="SELECT * FROM DATOS_P WHERE CI_E='$ced'";
		$stmt=odbc_exec($conn,$sql);
		$sql1="SELECT * FROM DATOSA WHERE CI_E='$ced'";
		$stmt1=odbc_exec($conn,$sql1);
		$estatus=odbc_result($stmt1,'ESTATUS');
		$ape2=odbc_result($stmt,'APELLIDOS2');
		$nom=odbc_result($stmt,'NOMBRES');
		$nom2=odbc_result($stmt,'NOMBRES2');
		$sexo=odbc_result($stmt,'SEXO');
		$nac=odbc_result($stmt,'NAC_E');
		if($nac=='E')
			$tipo = $_POST['res_extrajS'];
		$fnac=odbc_result($stmt,'F_NAC_E');
		$fnac=implode("-",array_reverse(explode("-",$fnac)));
		list($dian,$mesn,$anion)=explode("-",$fnac);
		$anion=$anion-1900;
		switch($mesn){
			case '01': $mes="Enero"; break;
			case '02': $mes="Febrero"; break;
			case '03': $mes="Marzo"; break;
			case '04': $mes="Abril"; break;
			case '05': $mes="Mayo"; break;
			case '06': $mes="Junio"; break;
			case '07': $mes="Julio"; break;
			case '08': $mes="Agosto"; break;
			case '09': $mes="Septiembre"; break;
			case '10': $mes="Octubre"; break;
			case '11': $mes="Noviembre"; break;
			case '12': $mes="Diciembre"; break;
		}
		$pnac=odbc_result($stmt,'P_NAC_E');
		$lnac=odbc_result($stmt,'L_NAC_E');
		$edoc=odbc_result($stmt,'EDO_C_E');
		$corr=odbc_result($stmt,'CORREO1');
		$corr2=odbc_result($stmt,'CORREO2');
		$espc=odbc_result($stmt,'ESP_CURSAR');
		$sqle="SELECT CARRERA1 FROM TBLACA010 WHERE C_UNI_CA='$espc'";
		$stmte=odbc_exec($conn1,$sqle);
		$espe=odbc_result($stmte,'CARRERA1');
		$ave=odbc_result($stmt,'AVENIDA');
		$urb=odbc_result($stmt,'URBANIZACION');
		$man=odbc_result($stmt,'MANZANA');
		$nro=odbc_result($stmt,'NROCASA');
		$ciu=odbc_result($stmt,'CIUDAD');
		$est=odbc_result($stmt,'ESTADO');
		$tel=odbc_result($stmt,'TELEFONO1');
		list($cod,$tel)=explode("-",$tel);
		$tel2=odbc_result($stmt,'TELEFONO2');
		list($cod2,$tel2)=explode("-",$tel2);
		$tel3=odbc_result($stmt,'TELEFONO3');
		list($cod3,$tel3)=explode("-",$tel3);
		$aver=odbc_result($stmt,'AVENIDA_R');
		$urbr=odbc_result($stmt,'URBANIZACION_R');
		$nror=odbc_result($stmt,'NROCASA_R');
		$ciur=odbc_result($stmt,'CIUDAD_R');
		$estr=odbc_result($stmt,'ESTADO_R');
		$telr=odbc_result($stmt,'TELEFONO_R');
		list($codr,$telr)=explode("-",$telr);	
		$uni=odbc_result($stmt1,'UNIVERSIDAD');
		$nuc=odbc_result($stmt1,'NUCLEO');
		if($nac=='E')
			$codc="NULO";
		else
			$codc=odbc_result($stmt1,'CODIGO_C');
		$men=odbc_result($stmt1,'MENCION');
		$niv=odbc_result($stmt1,'NIVEL');
		$sqln="SELECT NIVEL_C FROM NIVELES WHERE NIVEL='$niv'";
		$stmtn=odbc_exec($conn,$sqln);
		$nive=odbc_result($stmtn,'NIVEL_C');
		$esca=odbc_result($stmt1,'ESCALA');
		$mix=explode("-",$esca);
		$minima=$mix[0];
		$maxima=$mix[1];
		$mina=odbc_result($stmt1,'MIN_APROB');
		$mod=odbc_result($stmt1,'MODO');
		$niva=odbc_result($stmt1,'NIV_APROB');
		$cred=odbc_result($stmt1,'CRED_APROB');
		$nros=odbc_result($stmt1,'SOLICITUD');	
		if($sexo=='1')
			$sex='Masculino';
		else
			$sex='Femenino';
	}
	else{
		//**21/03/2018 SI NO ESTÁ EN DATOS_P**//
		$flag = '0';//CUANDO SE REGISTRA POR PRIMERA VEZ
	}
	
	function show_m($flag,$nive,$ced){
		if($flag=='1' && $nive=='0'){
			global $basededatos,$$usuariodb,$clavedb;
			$conn=odbc_connect($basededatos,$usuariodb,$clavedb);
			$sql="SELECT CI_E FROM MATERIAS WHERE CI_E='$ced'";
			$stmt=odbc_exec($conn,$sql);
			$cedu=0;
			while($x=odbc_fetch_array($stmt)) $cedu++;
			if($cedu>0){}
				echo "<tr><td style='width: 100;'><div class='tit1' id='etqcodmat'><b>CÓDIGO</b>
						</div></td>
                    	<td style='width: 520;'><div class='tit1' id='etqnommat'><b>ASIGNATURA</b></div></td>
						<td style='width: 100;'><div class='tit1' id='etqnotmat'><b>NOTA(Ej: 9.0)</b>
						</div></td>
						<td style='width: 80;'><div class='tit1' id='etqelimmat' style='color: red'></div></td></tr>";
		}
	}
	
	function show_materias($flag,$ced,$nive){
		global $basededatos,$$usuariodb,$clavedb;
		if($flag=='1' && $nive=='0'){
			$conn=odbc_connect($basededatos,$usuariodb,$clavedb);
			$sql="SELECT * FROM MATERIAS WHERE CI_E='$ced' ORDER BY C_ASIGNA ASC";
			$stmt=odbc_exec($conn,$sql);
			$i=0;
			show_m($flag,$nive,$ced);
			while($x=odbc_fetch_array($stmt)){
				$i++;
				echo "<tr><td><input type='text' disabled='disabled' size='7' value='$x[C_ASIGNA]'></td>
						<td><input type='text' disabled='disabled' size='80' value='$x[ASIGNATURA]'></td>
						<td><input type='text' disabled='disabled' size='2' value='$x[NOTA]'></td>
					</tr>
					<input type='hidden' name='cod$i' size='7' value='$x[C_ASIGNA]'>
					<input type='hidden' name='mat$i' size='80' value='$x[ASIGNATURA]'>
					<input type='hidden' name='not$i' size='2' value='$x[NOTA]'>";
			}
			echo "<input type='hidden' name='inc' value='$i'>";
		}
		else
			echo "<input type='hidden' name='inc' value='0'>";
	}
?>
<body>
	<table style="width:850">
		<tr>
			<td style="width:125" align="right"><img height=75 src="unex15.gif" width=75 border=0></td>
			<td style="width:525" class="titulo">
				Universidad Nacional Experimental Politécnica<br>
			  	Vicerrectorado Puerto Ordaz<br>
			  	Unidad Regional de Admisión y Control de Estudios<br>
			</td>
			<td style="width:200"><img height=75 src="logo_equivalencias.jpg" width=150></td>
		</tr>
		<tr>
			<td style="background-color:#ACE2EE" colspan="3"><font style="font-size:2px">&nbsp;</font></td>
		</tr>	
	</table>
	<table style="width:850">
		<tr>
			<td style="width:125">&nbsp;</td>
			<td style="width:525" class="enca">Planilla de Solicitud de Equivalencia Externa</td>
			<td style="width:200">&nbsp;</td>
    	</tr>
	</table>
	<table>
		<tr>
			<td width="850" align="center">
				<span style=" font-weight:bold; text-align:center; font-size:16px; color:red; font-family:Arial;
				text-decoration: blink">
			</span>			</td>	
    	</tr>
	</table>
	<table>
		<tr>
			<td width="850" align="center"></td>	
    	</tr>
	</table>
<form name="datos_p" method="POST" action="planilla_externa_solicitud.php">		
	<table>	
		<tr>
    		<td width="850">
			<a href="acceso_planilla_externa.php">&lt;&lt;Volver</a>
				<div class="tit" style="text-align:left; width:400px">
					<br>Datos Personales:				</div>
				<table width="840" style="background:#ACE2EE;" cellpadding="2" cellspacing="0">
        			<tr>
						<td style="width: 250px">
							<p class=tit1>Nacionalidad - C.I./Pasaporte:</p></td>
						<td style="width: 150px; color:#D2DEF0;"><div id="tipoEtq" class="tit1">Tipo:</div></td>
						<td style="width: 150px; color:#D2DEF0;"><div id="docEtq" class="tit1">Documento:</div></td>
						<td style="width: 150px; color:#D2DEF0;"><div id="pasaporteEtq" class="tit1">N&uacute;mero:</div></td>							
        			</tr>
        			<tr>
          				<td style="width: 150px">
		 					<input name="flag" type="hidden" value="<?php echo $flag; ?>">
							<input name="estatus" type="hidden" value="<?php echo $estatus; ?>">
							<input name="flagfecha" type="hidden" value="">
							<input name="flagest" type="hidden" value="<?php echo $flagest; ?>">
							<input name="nac_e" type="hidden" value="">
		 					<select name="nac_eS" id="" style="width: 40px;" onChange="with(document.datos_p){ if 		 		 							(this.value =='E')  {res_extrajS.style.display='block'; res_extrajS.focus();    	  	 	   	 	 		 							document.getElementById('tipoEtq').style.color='#000000';} else {res_extrajS.style.display='none'; 	 	 							res_extraj.value =''; document.getElementById('tipoEtq').style.color='#D2DEF0';}} { if (this.value 		 							=='E') {doc_identS.style.display='block'; doc_identS.focus(); 													document.getElementById('docEtq').style.color='#000000';} else {doc_identS.style.display='none'; doc_ident.value =''; document.getElementById('docEtq').style.color='#D2DEF0';}}{ if (this.value =='V') {pasaporte_nro.style.display='none'; pasaporte_nro.value ='';  document.getElementById('pasaporteEtq').style.color='#D2DEF0';}}validar(this);">
                              <option value="<?php echo $nac;?>"><?php echo $nac;?></option>
                              <option value="V">V</option>
                              <option value="E">E</option>
                            </select>
		 					<input name="ci_e" type="hidden" value="<?php echo $ced;?>">
              				 -&nbsp;
              				<input name="ci_eS" maxlength="8" style="width: 70px;" type="text" disabled="disabled"
							value="<?php echo $ced;?>">						</td>
						<td>
							<input name="res_extraj" type="hidden" value="">
							<select name="res_extrajS" id="resextraj_S_1" class="datospf" 
					 		style="width: 100px; display: none;" onChange="validar(this);"> 
							<option value="">-----------------</option>
							<option value="RESIDENTE">Residente</option>
							<option value="TRANSEUNTE">Transeúnte</option>		
							</select>						</td>
						<td style="width: 150px;" border="0" >&nbsp;</td>
		                <td style="width: 150px;" border="0" >
							<input name="pasaporte_nro" maxlength="8" id="pasaportenro_N_8" 
					 		class="datospf" style="width: 70px; display:none;" type="text"
					 		value="" onKeyUp="validarN(this);" onChange="validar(this);">						</td>						
					</tr>
	       			<tr>
          				<td  class="tit1" style="width: 200px;" >Primer Apellido</td>
          				<td  class="tit1" style="width: 200px;" >Segundo Apellido</td>
          				<td  class="tit1" style="width: 200px;" >Primer Nombre</td>
          				<td  class="tit1" style="width: 200px;" >Segundo Nombre</td>
        			</tr>
        			<tr>
          				<td style="width: 200px;" >
							<input name="apellidos" type="hidden" value="<?php echo $ape;?>">
							<input name="apellidosS" maxlength="25" disabled="disabled"  
							style="width: 180px;" type="text" value="<?php echo $ape;?>">						</td>
          				<td style="width: 200px;" ><input name="apellidos2" maxlength="25"  
							style="width: 180px;" type="text" value="<?php echo $ape2;?>" onKeyUp="validarL(this);">						</td>
          				<td style="width: 200px;" ><input name="nombres" id="nombres_L_1" value="<?php echo $nom;?>" maxlength="25" alt="Primer Nombre" 
							style="width: 180px;" type="text" onKeyUp="validarL(this);" onChange="validar(this);">						</td>
          				<td style="width: 200px;" ><input name="nombres2" maxlength="25" alt="Segundo Nombre" value="<?php echo $nom2;?>" 
							style="width: 180px;" type="text" onKeyUp="validarL(this);"></td>
        			</tr>
        			<tr>
          				<td class="tit1" style="width: 220px;" >Fecha de Nacimiento:</td>
          				<td class="tit1" style="width: 220px;" >Pa&iacute;s de Nacimiento:</td>
          				<td class="tit1" style="width: 150px;" >Lugar de Nacimiento:</td>
          				<td class="tit1" style="width: 180px;" >Especialidad a Cursar:</td>
        			</tr>
        			<tr>
   		  				<td class="tit1" style="width: 300px;" ><input type="hidden" name="f_nac_e">
              				<select name="diaN" id="" style="width:40px" onChange="">
                			<option ><?php echo $dian;?></option><?php echo $dian;?><option > 01</option><option > 02</option>
                			<option > 03</option><option > 04</option><option > 05</option>
               				<option > 06</option><option > 07</option><option > 08</option>
                			<option > 09</option><option > 10</option><option > 11</option>
                			<option > 12</option><option > 13</option><option > 14</option>
                			<option > 15</option><option > 16</option><option > 17</option>
                			<option > 18</option><option > 19</option><option > 20</option>
                			<option > 21</option><option > 22</option><option > 23</option>
                			<option > 24</option><option > 25</option><option > 26</option>
                			<option > 27</option><option > 28</option><option > 29</option>
                			<option > 30</option><option > 31</option>
              				</select>
            				de
            				<select name="mesN" id="" style="width:95px" onChange="">
                            <option value="<?php echo $mesn;?>" ><?php echo $mes;?></option>
                            <option value="01" >Enero</option>
            				<option value="02" >Febrero</option>
                            <option value="03" >Marzo</option>
            				<option value="04" >Abril</option>
                            <option value="05" >Mayo</option>
            				<option value="06" >Junio</option>
                            <option value="07" >Julio</option>
            				<option value="08" >Agosto</option>
                            <option value="09" >Septiembre</option>
            				<option value="10" >Octubre</option>
                            <option value="11" >Noviembre</option>
            				<option value="12" >Diciembre</option>
                            </select>
            			 	de 19
       					  	<input name="anioN" id="anioN_N_2"type="text" value="<?php echo $anion;?>" style="width: 20px;" maxlength="2" onKeyUp=						 							"validarN(this);" onChange="">						</td>
          				<td style="width: 150px;" ><input name="p_nac_e" maxlength="30" id="pnac_L_4" alt="Pais de Nacimiento"
							style="width: 150px;" type="text" onKeyUp="validarL(this);" value="<?php echo $pnac;?>" onChange="validar(this);">						</td>
          				<td style="width: 150px;" ><input name="l_nac_e" maxlength="30" id="lnac_L_3" alt="Lugar de Nacimiento"
							style="width: 150px;" type="text" onKeyUp="validarL(this);" value="<?php echo $lnac;?>" onChange="validar(this);">						</td>
       				  <td style="width: 150px;" ><input name="carrera" type ="hidden" value="" >
       				    <select name="c_uni_ca" id="select" style="width: 160px"onChange="validar(this);">
                          <option value="<?php echo $espc;?>"><?php echo "$espe";?></option>
                          <option value="2">Ingeniería Mecánica</option>
                          <option value="3">Ingeniería Eléctrica</option>
                          <option value="4">Ingeniería Metalúrgica</option>
                          <option value="5">Ingeniería Electrónica</option>
                          <option value="6">Ingeniería Industrial</option>
                        </select></td>
        			</tr>
        			<tr>
        				<td class="tit1" style="width: 220px;" >Estado Civil:</td>
          				<td class="tit1" style="width: 220px;" >Sexo:</td>
          				<td class="tit1" style="width: 220px;" >e-mail Principal:</td>
          				<td class="tit1" style="width: 220px;" >e-mail Secundario:</td>
        			</tr>
        			<tr>
        				<td style="width: 200px;" >
            				<input name="edo_c_e" type="hidden" value="">
            				<select name="edo_c_eS" id="" style="width: 90px" onChange="validar(this);">
              				<option value="<?php echo $edoc;?>"><?php echo $edoc;?></option>
              				<option value="SOLTERO">Soltero</option>
              				<option value="CASADO">Casado</option>
              				<option value="CONCUBINO">Concubino</option>
              				<option value="VIUDO">Viudo</option>
              				<option value="DIVORCIADO">Divorciado</option>
       				  </select>						</td>
          				<td>
							<input name="sexo" type="hidden" value="<?php echo $sexo;?>">
              				<select name="sexoS" id="" style="width: 90px" onChange="validar(this);">
                			<option value="<?php echo $sexo;?>"><?php echo $sex;?></option>
                			<option value="0">Femenino</option>
                			<option value="1">Masculino</option>
              				</select>						</td>
          				<td style="width: 150px;" >
							<input name="correo1" maxlength="40" style="width: 200px;" type="text" id="correo1_A_1"
							onKeyUp="validarA(this);" value="<?php echo $corr;?>" onChange="validar(this);">						</td>
          				<td style="width: 150px;" >
							<input name="correo2" maxlength="40" style="width: 200px;" type="text" value="<?php echo $corr2;?>"
							onKeyUp="validarA(this);">						</td>
        			</tr>	
    			</table>			</td>
		</tr>
		<tr>
			<td width="750">
    			<br><div class="tit" style="text-align:left;" width:"500px">Dirección Permanente:</div>
        		<table width="840" style="background:#ACE2EE;" cellpadding="2" cellspacing="0">
                	<tr class="datosp">
                		<td class="tit1" colspan="2" style="width: 400px;" >Avenida/Calle:</td>
                    	<td class="tit1" style="width: 200px;" >Barrio/Urbanizaci&oacute;n</td>
						<td class="tit1" style="width: 200px;" >Manzana/Edificio</td>
                    	<td class="tit1" style="width: 140px;" >Casa/Apto Nro:</td>
                	</tr>
                	<tr>
                    	<td colspan="2" style="width: 300px;" >
							<input name="avenida" id="avenida_A_1" maxlength="30" style="width: 350px;" type="text"
							onKeyUp="validarA(this);" value="<?php echo $ave;?>" onChange="validar(this);">						</td>
                    	<td style="width: 200px;" >
							<input name="urbanizacion" id="urbanizacion_A_1" maxlength="30" style="width: 180px;" type="text"
							onKeyUp="validarA(this);" value="<?php echo $urb;?>" onChange="validar(this);">						</td>
						<td style="width: 200px">
							<input name="manzana" id="manzana_A_1" value="<?php echo $man;?>" maxlength="30"style="width: 120px;" type="text"
							onKeyUp="validarA(this);" onChange="validar(this);">						</td>
                    	<td style="width: 140px;" ><input name="nrocasa" maxlength="30" style="width: 80px;" type="text"
							id="nrocasa_A_1" value="<?php echo $nro;?>" onKeyUp="validarA(this);" onChange="validar(this);"></td>
					</tr>
                	<tr>
                    	<td class="tit1" style="width: 200px;" >Ciudad:</td>
                    	<td class="tit1" style="width: 200px;" >Estado:</td>
                    	<td class="tit1" style="width: 200px;" >Tlf Hab:<font style="color:blue;">(Ej: 0286-1234567)</font></td>
						<td class="tit1" style="width: 200px;" >Tlf Celular:</td>
						<td class="tit1" style="width: 200px;" >FAX:</td>
                	</tr>
                	<tr>
                    	<td style="width: 200px;" >
							<input name="telefono1" type="hidden" value = "">
							<input name="telefono2" type="hidden" value = "">
							<input name="telefono3" type="hidden" value = "">
							<input name="ciudad" maxlength="30" style="width: 180px;" value="<?php echo $ciu;?>" type="text" id="ciudad_L_1"
							onKeyUp="validarL(this);">						</td>
						<td style="width: 200px">
							<input name="estado" maxlength="30" style="width: 180px;" value="<?php echo $est;?>" type="text" id="estado_L_1"
							onKeyUp="validarL(this);">						</td>
                    	<td style="width: 200px;" >
							<input name="codT" id="codT_N_1" maxlength="4" style="width: 35px;" type="text"
							onKeyUp="validarN(this);" value="<?php echo $cod;?>" onChange="validar(this);">&nbsp;-&nbsp;
							<input name="telefono" id="telefono_N_1" value="<?php echo $tel;?>" maxlength="7" style="width: 55px;" type="text"
							onKeyUp="validarN(this);" onChange="validar(this);">						</td>                    
						<td style="width: 200px;">
							<select name="celcod" id="" style="width: 55px" onChange="validar(this)">
							<option value="<?php echo $cod2;?>"><?php echo $cod2;?></option>
							<option value="0416">0416</option>
							<option value="0426">0426</option>
							<option value="0414">0414</option>
							<option value="0424">0424</option>
							<option value="0412">0412</option>
							</select>&nbsp;-&nbsp;
							<input name="celnro" id="celnro_N_1" maxlength="7" value="<?php echo $tel2;?>" style="width: 55px;" type="text"
							onKeyUp="validarN(this);" onChange="validar(this);">						</td>
						<td style="width: 200px">
							<input name="codfax" maxlength="4" style="width: 35px;"  value="<?php echo $cod3;?>" type="text">&nbsp;-&nbsp;
							<input name="nrofax" maxlength="7" style="width: 55px;" value="<?php echo $tel3;?>" type="text">						</td>
					</tr>
				</table>			</td>
		</tr>
		<tr>
    		<td width="850">
				<br><div class="tit" style="text-align:left;">Direcci&oacute;n de Residencia:
				<span class="trans">(completar s&oacute;lo si es diferente a la Direcci&oacute;n Permanente)</span>
				</div>
        		<table width="840" style="background:#ACE2EE;" cellpadding="2" cellspacing="0">
                	<tr>
                    	<td class="tit1" colspan="2" style="width: 400px">Avenida/Calle:</td>
                    	<td class="tit1" style="width: 200px">Barrio/Urbanizaci&oacute;n/Edificio:</td>
                    	<td class="tit1" style="width: 140px">Casa/Apto Nro:</td>
                	</tr>
                	<tr>
                    	<td colspan="2" style="width: 400px;" >
							<input name="dirr_e" type="hidden" value = "">
							<input name="telfr_e" type="hidden" value = "">
							<input name="avenidar" maxlength="100" style="width: 380px;" value="<?php echo $aver;?>" type="text"
							 onKeyUp="validarA(this);" onChange="validar(this);">				    	</td>
                    	<td style="width: 200px">
							<input name="urbanizacionr" maxlength="60" style="width: 180px;" value="<?php echo $urbr;?>" type="text"
							 onKeyUp="validarA(this);" onChange="validar(this);">						</td>
                    	<td style="width: 140px">
							<input name="nrocasar" maxlength="25" style="width: 120px;" type="text" value="<?php echo $nror;?>"
							 onKeyUp="validarA(this);" onChange="validar(this);">						</td>
					</tr>
					<tr>
                    	<td class="tit1" style="width: 200px">Ciudad:</td>
                    	<td class="tit1" style="width: 200px">Estado:</td>
                    	<td class="tit1" style="width: 200px">Tel&eacute;fono:<font style="color:blue">(Ej:              							 							0286-1234567)</font>						</td>
                   	<td style="width: 140px;" >                    </tr>
                	<tr>
                    	<td style="width: 200px" >
							<input name="ciudadr" maxlength="30" style="width: 180px;" type="text" value="<?php echo $ciur;?>"
							onKeyUp="validarL(this);" onChange="validar(this);">				    	</td>
                    	<td style="width: 200px" >
							<input name="estador" maxlength="30" style="width: 180px;" type="text" value="<?php echo $estr;?>"
							 onKeyUp="validarL(this);" onChange="validar(this);">				    	</td>
                    	<td style="width: 200px">
							<input name="codTR" maxlength="4" style="width: 35px;" type="text" value="<?php echo $codr;?>"
							onKeyUp="validarN(this);" onChange="validar(this);">&nbsp;-&nbsp;
							<input name="telefonoR" maxlength="7" style="width: 55px;" type="text" value="<?php echo $telr;?>"
							onKeyUp="validarN(this);" onChange="validar(this);">						</td>	
                    	<td style="width: 140px;" >&nbsp;						</td>
					</tr>
			</table>    	</td>
    </tr>
	<tr>
   	  <td width="850">
			<br><div class="tit" style="text-align:left">Datos Acad&eacute;micos:</div>
	        <table width="840" style="background:#ACE2EE" cellpadding="2" cellspacing="0">
              <tr>
                <td class="tit1" colspan="3" style="width: 840"><div id="planilla">
				Codigo Carrera (Opsu):<div id="codigoapli"></div><input type='text' name='codigoc' id='codigoc_N_1' value="<?php echo $codc;?>" size='7' onkeyup='validarN(this)'  maxlength='10' onchange='validar(this)'><input type="button" style="font-size:9px" value="Buscar" onClick="if(diaN.value=='' || mesN.value=='' || anioN.value=='') alert('Debes ingresar la Fecha de Nacimiento para continuar.'); else{ bondera.value='1'; recargar(datos_p); popUp('codigo_universidades.php?flagest='+flagest.value+'&ced='+ci_e.value+'&ape='+apellidos.value+''); }">
				&nbsp;&nbsp;&brvbar; <a href="javascript:popUp('http://loe.opsu.gob.ve/regiones.php')" style="font-size:12px">Buscar MÁS Códigos Opsu</a>&nbsp;&nbsp;&nbsp;&brvbar;&nbsp;&nbsp;Estudiante o Profesional del Exterior: 
				<input type="button" value="Click AQUÍ" onClick="if(flag.value =='1') alert('Acción Inválida.'); else 
				  fajax('CONEXIONP.php','planilla','cod=aeiou','post','0');"><br>
				  Nombre Universidad: <input type='text' name='nombre_u' id='nombreu_L_1' value="<?php echo $uni;?>" size='60' maxlength='100' onkeyup='validarL(this)' onchange=	'validar(this)'>
				 &nbsp;&nbsp;&nbsp;&nbsp;Nucleo/Extensión: 
				 <input type='text' name='nucleo' id='nucleo_L_1' value="<?php echo $nuc;?>" size='25' maxlength='50' onkeyup='validarL(this)' onchange='validar(this)'><br>Mencion: <input type='text' name='mencion' id='mencion_L_1' value="<?php echo $men;?>" size='60' maxlength='50' onkeyup='validarL(this)' onchange='validar(this)'><br>
				</div>			</td>
            </tr>			  
              <tr>
                <td class="tit1" style="width: 150px;" >Nivel Académico:</td>
                <td class="tit1" style="width: 150px;" >&nbsp;</td>
                <td class="tit1" style="width: 200px;" >&nbsp;</td>
              </tr>
              <tr>
                <td style="width: 140px; vertical-align:top">
				<input name="nivel_estudio" type="hidden" value = "">
                    <select name="nivel_estudioS" id="" onChange="if(nivel_estudioS.value =='0')">
                      <option value="<?php echo $nive; ?>"><?php echo $niv; ?></option>
                      <option value="0">Estudiante Universitario</option>
                      <option value="1">T.S.U. o Equivalente</option>
                      <option value="2">Licenciado o Equivalente</option>
                      <option value="3">Ingeniero o Equivalente</option>
                  </select>				</td>
                <td style="width: 140px; vertical-align:top;" >&nbsp;				</td>
                <td>&nbsp;</td>
              </tr>
              <tr style="width:850px">
                <td class="tit1" style="width: 150px;" >Escala de Evaluación:</td>
                <td class="tit1" style="width: 150px;" >Mínima Nota Aprobatoria:</td>
                <td class="tit1" style="width: 500px;" >Modo Estudio: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  Nivel Aprobado:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cr&eacute;ditos Aprobados:</td>
              </tr>
              <tr>
                <td class="tit1"><select name="escala" id="" onChange="validar(this)">
                  <option value="<?php echo $maxima;?>"><?php if($minima!='') echo "$minima - $maxima";?></option>
                  <option value="5">1 - 5</option>
                  <option value="9">1 - 9</option>
                  <option value="10">1 - 10</option>
                  <option value="20">1 - 20</option>
                  <option value="100">1 - 100</option>
                  <option value="150">50 - 100</option>
                </select>
                Puntos</td>
                <td><input type="text" name="notaA" size="2" maxlength="5"  id="notaA_N_1"  value="<?php echo $mina;?>"
							onKeyUp="validarN(this);" onChange="if(escala.value=='150'){ if(notaA.value-50<0 || 100-notaA.value<0) { alert('Introduzca un valor dentro del rango'); notaA.value='';}} else{ if(escala.value-notaA.value<0){ alert('Introduzca un valor dentro del rango'); notaA.value='';}} validar(this);">
                    <font class="tit1">Puntos</font> </td>
                <td><input name="modo_estudio" type="hidden" value="">
                    <select name="modo_estudioS" id="" style="width: 100px" onChange="validar(this);">
                      <option value="<?php echo $mod;?>"><?php echo $mod;?></option>
                      <option value="SEMESTRE">Semestre</option>
                      <option value="TRIMESTRE">Trimestre</option>
                    </select>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                    <input name="naprob" type="hidden">
                    <select name="naprobS" id="" style="width: 60px" onChange="validar(this);">
                      <option value="<?php echo $niva;?>"><?php echo $niva;?></option>
                      <option value="1ro">1er</option>
                      <option value="2do">2do</option>
                      <option value="3ro">3er</option>
                      <option value="4to">4to</option>
                      <option value="5to">5to</option>
                      <option value="6to">6to</option>
                      <option value="7mo">7mo</option>
                      <option value="8vo">8vo</option>
                      <option value="9no">9no</option>
                      <option value="10mo">10mo</option>
                      <option value="11ro">11er</option>
                      <option value="12do">12do</option>
                      <option value="13ro">13er</option>
                      <option value="14to">14to</option>
                      <option value="15to">15to</option>
                    </select>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="text" name="credA" size="3" maxlength="4" id="credA_N_1"
						onKeyUp="validarN(this);" value="<?php echo $cred;?>"  onChange="validar(this);">
                    <font class="tit1">U.C.</font>				</td>
			</tr>
            </table>
	</td>
	</tr>
    	<td width="850">
			<input type="hidden" name="bondera" value=""> 
			<br><div class="tit" style="text-align:left">Materias Aprobadas:
			<span class="trans">(Completar sólo si USTED es Estudiante Universitario)</span>
			<span class="tit12"><br></span></div>
			<table id="thetable" width="840" style="background: #DAF0FC" cellpadding="2" cellspacing="0"><tr>
				<td colspan="5" align="center"><input name="anadir" type="button" class="boton" onClick="
		if(nivel_estudioS.value=='' || escala.value=='' || notaA.value=='')
			alert('Los campos \'Nivel Académico\', \'Escala de Evaluación\' o \'Mínima Nota Aprobatoria\' están vacíos. Debe llenarlos para poder insertar materias.');
		else{
			if(nivel_estudioS.value=='0'){
				if(escala.value=='150' && 100-notaA.value<0)
					alert('La Mínima Nota Aprobatoria está fuera de la Escala de Evaluación. Debe modificarla.');
			 	else{
			 		if(escala.value!='150' && escala.value-notaA.value<0) alert('La Mínima Nota Aprobatoria está fuera de la Escala de Evaluación. Debe modificarla.');
					else{ if((mesN.value=='' || anioN.value=='') && estatus.value==''){ alert('Debe completar la fecha de Nacimiento.');} else{  bondera.value='1'; recargar(datos_p); window.open('ingresar_materias.php?ced='+ci_e.value+'&opc=1&inc='+inc.value+'&escala='+escala.value+'&min='+notaA.value+'&ape='+apellidos.value+'&flagest='+flagest.value+'&nivel_estudioS='+nivel_estudioS.value+'&modo_estudioS='+modo_estudioS.value+'&naprobS='+naprobS.value+'&credA='+credA.value+'', 'prueba', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=900,height=500,left = 212,top =134');}}
				}
			}
			else alert('No es necesario que agregue materias. Este campo debe completarlo sólo si eres Estudiante Universitario.'); }" value="A&ntilde;adir Materias">				  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input class="boton" type="button" value="Modificar Materias" id="anadir" 
						name="anadir" onClick="if(inc.value=='0') alert('No existen materias para modificar.'); else{ if(nivel_estudioS.value=='0'){ bondera.value='1'; window.open('modificar_materias.php?ced='+ci_e.value+'&opc=2&escala='+escala.value+'&min='+notaA.value+'&ape='+apellidos.value+'', 'prueba1', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=900,height=500,left = 212,top =134');} else alert('No es necesario que modifique materias. Este campo debe completarlo sólo si eres Estudiante Universitario.');}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input class="boton" type="button" value="Eliminar Materias" id="anadir" 
						name="anadir" onClick="if(inc.value=='0') alert('No existen materias para eliminar.'); else{ if(nivel_estudioS.value=='0'){ window.open('eliminar_materias.php?ced='+ci_e.value+'&opc=3&ape='+apellidos.value+'', 'prueba2', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=900,height=500,left = 212,top =134');} else alert('No es necesario que elimine materias. Este campo debe completarlo sólo si eres Estudiante Universitario.');}">			  </td></tr>
					<?php show_materias($flag,$ced,$nive); ?>
					<tr>
						<input type="hidden" name="flag1" value="0">
						<input type="hidden" name="flag2" value="0">
						<input type="hidden" name="flag3" value="0">
					</tr>
		  </table>
		  </td>
		<tr width="850" class="tit1">
        <br>				
		</tr>
		<tr  class="datosp" style="background-color:white;">
			<td width="840">
				<hr size="1" width="840">
				<div class="tit12" id="msgError" style="text-align:left;display:none; background-color:#ffff99;">
				Verifique: Existen errores en los campos marcados en amarillo.</div>			</td>
		</tr>				
		<tr  class="datosp" style="background-color:white;">
			<td width="740"><div class="tit1">Atención: Pulse el botón <b>"Procesar"</b> después de llenar la planilla con 
			todos sus datos.</div>
				<hr size="1" width="840">
			</td>
		</tr>
			<td>        
				<table id="tBoton" align="center" border="0" cellpadding="1" cellspacing="2"
		 		width="840" style="border-collapse:collapse;border-color:white; border-style:solid; background:white;">
				<tr align="center">
				  <td width="200px"><input name="button" type="button" class="boton" id="Procesar"
					onClick="if(ci_e.value=='') alert('Imposible Procesar!');
					else{ this.style.display='none'; validarF(document.datos_p); bondera.value='2';
					if(confirm('Está seguro(a) que desea procesar su Planilla de Solicitud?'))
					recargar(datos_p);
					else document.getElementById('Procesar').style.display='block';}" value="Procesar"></td>
					<td width="200px"><input class="boton" type="button" value="Salir" id="Salir"onclick="window.close();"></td>
				</tr>
				</table>			</td>																						
	</table>
</form>			
</body>
</html>