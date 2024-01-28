<html>
<head>
<title>Planilla Registrada</title>
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
	$flag = $_POST['flag'];
	$n = $_POST['num'];
	$i=$_POST['inc'];	
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
	$uni = $_REQUEST['nombre_u'];
	$men = $_REQUEST['mencion'];
	$codc = $_REQUEST['codigoc'];
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
	if($nac=='E')
		$tipo = $_REQUEST['res_extrajS'];
	
	$conn=odbc_connect($basededatos,$usuariodb,$clavedb);
	$conn1=odbc_connect($basededatos1,$usuariodb1,$clavedb1);
	$sql="SELECT CI_E FROM DATOS_P WHERE CI_E='$ced'";
	$stmt=odbc_exec($conn,$sql);
	$cedg=odbc_result($stmt,'CI_E');
	$sql="SELECT CARRERA1 FROM TBLACA010 WHERE C_UNI_CA='$espc'";
	$stmt=odbc_exec($conn1,$sql);
	$espec=odbc_result($stmt,'CARRERA1');
	$sql="SELECT NIVEL FROM NIVELES WHERE NIVEL_C='$niv'";
	$stmt=odbc_exec($conn,$sql);
	$niv=odbc_result($stmt,'NIVEL');
	
	if($flag=='0' && $cedg==''){
		$fecha=date("Y-m-d");
		$year=date("Y")+2;
		$fechaf=date("-m-d");
		$tel1="$ctel-$ntel";
		$tel2="$ccel-$ncel";
		$tel3="$cfax-$nfax";
		$telr="$ctelr-$ntelr";
		$sql="INSERT INTO DATOS_P VALUES('$ced','$ave','$ape','$ape2','$nom','$nom2','$sex','$anion-$mesn-$dian',
		'$pnac','$lnac','$edoc','$corr1','$corr2','$espc','$nac','$urb','$man','$nro','$ciu','$edo','$tel1','$tel2','$tel3','$aver','$urbr','$nror','$ciur','$edor','$telr','$tipo','$fecha','$year$fechaf','')";

		$stmt=odbc_exec($conn,$sql);
		$sqlso="SELECT SOLICITUD FROM DATOSA";
		$stmtso=odbc_exec($conn,$sqlso);
		$solicitud=10000;
		while($z=odbc_fetch_array($stmtso)){
			if($z['SOLICITUD']>$solicitud)
				$solicitud=$z['SOLICITUD'];
		}
		$solicitud++;
		$sql="INSERT INTO DATOSA
		VALUES('$ced','0','$uni','$codc','$men','$esc','$mod','$min','$niv','$nia','$cre','$nuc','0','$solicitud')";
		$stmt=odbc_exec($conn, $sql);
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
		
		$sql="UPDATE DATOSA SET UNIVERSIDAD='$uni', ESTATUS='0', CODIGO_C='$codc', MENCION='$men', ESCALA='$esc', MODO='$mod', MIN_APROB='$min', NIVEL='$niv', NIV_APROB='$nia', CRED_APROB='$cre', NUCLEO='$nuc' WHERE CI_E='$ced'";
		$stmt=odbc_exec($conn,$sql);
	}
	
	if($niv=="Estudiante Universitario"){
		$sql="DELETE FROM MATERIAS WHERE CI_E='$ced'";
		$stmt=odbc_exec($conn,$sql);
		for($j=1;$j<=$i;$j++){
			$cod=$_POST['cod'.$j.''];
			$mat=$_POST['mat'.$j.''];
			$not=$_POST['not'.$j.''];
			$sql="INSERT INTO MATERIAS VALUES ('$ced','$mat','$not','$cod')";
			$stmt=odbc_exec($conn,$sql);
		}
	}
	
	function mostrar($uni,$nuc,$codc,$men){
			echo "<td class='tit1' colspan='3' style='width: 840'><input type='hidden' name='nombre_u' value='$uni'>
					<input type='hidden' name='codigoc' value='$codc'>
					<input type='hidden' name='mencion' value='$men'>
					<input type='hidden' name='nucleo' value='$nuc'>
					<b>Instituto:</b> $uni<br>
					<b>Nucleo:</b> $nuc<br>
					<b>Carrera (Codigo):</b> $men ($codc)<br></td>";
	}
	function mostrar_materias($niv,$ced)
	{
		global $basededatos,$$usuariodb,$clavedb;
		$conn=odbc_connect($basededatos,$usuariodb,$clavedb);
		if($niv=="Estudiante Universitario"){
			$sql="SELECT * FROM MATERIAS WHERE CI_E='$ced'";
			$stmt=odbc_exec($conn,$sql);
			$sql1="SELECT CI_E FROM MATERIAS WHERE CI_E='$ced'";
			$stmt1=odbc_exec($conn,$sql1);
			$cedu=0;
			while($a=odbc_fetch_array($stmt1)) $cedu++;
			if($cedu>0)
				echo "<table><tr class='tit1'><b>Materias Aprobadas:</b>
					<td class='tit1' style='width:120'><b>CODIGO</b></td>
					<td class='tit1' style='width:600'><b>ASIGNATURA</b></td>
					<td class='tit1' style='width:100'><b>NOTA</b></td></tr><table>";
			else
				echo "<table><tr class='tit' style='color:red'><td><br><b>NOTA: Recuerda agregar las materias aprobadas de tu carrera para hacer válida esta planilla antes de que el proceso cierre. De lo contrario serás rechazado del sistema.<b><br></td></tr><table>";
			while($x=odbc_fetch_array($stmt)){
				echo "<table><tr>
						<td class='tit1' style='width:120'>$x[C_ASIGNA]<td>
						<td class='tit1' style='width:600'>$x[ASIGNATURA]<td>
						<td class='tit1' style='width:100'>$x[NOTA]<td><tr><table>";
			}
		}
	}
	
	function mostrar_sexo($sex)
	{
		switch($sex)
		{
			case 0: echo "FEMENINO"; break;
			case 1: echo "MASCULINO"; break;
		}		
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
	<table>
		<tr>
			<td width=750> 
        		<p class=enca>Planilla de Solicitud de Equivalencia Externa</p></td>
    	</tr>
	</table>
	<table>
		<tr>
			<td width="850" align="center">
		</td>	
    	</tr>
	</table>
<form name="datos_p" method="POST" action="eliminar_externa.php">		
	<table>	
		<tr>
    		<td width="850">
			<p><a href="acceso_planilla_externa.php">&lt;&lt;Volver</a></p><br><br>
			<div class="tit1"><b>FECHA DE SOLICITUD:</b>
			<?php 
				if($flag=='0'){
					$fecha=implode("-",array_reverse(explode("-",$fecha)));
					echo $fecha;
				}
				else{
					$fechaS=implode("-",array_reverse(explode("-",$fechaS)));
					echo $fechaS;
				}
			?>	
				<div class="tit" style="text-align:left; width:600px">
					<hr size="1" width="950">
					Datos Personales:
					<span class="trans">
						(Coloque sus datos completos)
					</span>
				</div>
				<table width="840" cellpadding="2" cellspacing="0">
        			<tr>
						<td style="width: 250px">
							<p class=tit1>C&eacute;dula:</font></p></td>
						<td style="width: 150px; color:#FFFFFF;"><div id="tipoEtq" class="tit1">Tipo:</div></td>
						<td style="width: 150px; color:#FFFFFF;"><div id="docEtq" class="tit1">Documento:</div></td>
						<td style="width: 150px; color:#FFFFFF;"><div id="pasaporteEtq" class="tit1">N&uacute;mero:</div></td>							
        			</tr>
        			<tr>
          				<td style="width: 150px">
		 					<div class="tit1"><?php echo "$nac - $ced";?></div>
							<input name="ci_eS" type="hidden" value="<?php echo $ced;?>">
              				
						</td>						
					</tr>
	       			<tr>
          				<td  class="tit1" style="width: 200px;" >Primer Apellido</td>
          				<td  class="tit1" style="width: 200px;" >Segundo Apellido</td>
          				<td  class="tit1" style="width: 200px;" >Primer Nombre</td>
          				<td  class="tit1" style="width: 200px;" >Segundo Nombre</td>
        			</tr>
        			<tr>
          				<td class="tit1" style="width: 200px;" >
						<input name="apellidosS" type="hidden" value="<?php echo $ape;?>"> 
						<div class="tit1"><?php echo $ape;?></div>
						</td>
          				<td class="tit1" style="width: 200px;" ><?php echo $ape2;?>						</td>
          				<td class="tit1" style="width: 200px;" ><?php echo $nom;?>
						<input name="nombresS" type="hidden" value="<?php echo $nom;?>">
						</td>
          				<td class="tit1" style="width: 200px;" ><?php echo $nom2;?>						</td>
        			</tr>
        			<tr>
          				<td class="tit1" style="width: 220px;" >Fecha de Nacimiento:</td>
          				<td class="tit1" style="width: 220px;" >Pa&iacute;s de Nacimiento:</td>
          				<td class="tit1" style="width: 150px;" >Lugar de Nacimiento:</td>
          				<td class="tit1" style="width: 180px;" >Especialidad a Cursar:</td>
        			</tr>
        			<tr>
   		  				<td class="tit1" style="width: 300px;" ><?php echo "$dian-$mesn-$anion";?>
              			</td>
          				<td class="tit1" style="width: 150px;" ><?php echo $pnac;?></td>
          				<td class="tit1" style="width: 150px;" ><?php echo $lnac;?></td>
          				<td class="tit1" style="width: 150px;" ><?php echo $espec; ?></td>
        			</tr>
        			<tr>
        				<td class="tit1" style="width: 220px;" >Estado Civil:</td>
          				<td class="tit1" style="width: 220px;" >Sexo:</td>
          				<td class="tit1" style="width: 220px;" >e-mail Principal:</td>
          				<td class="tit1" style="width: 220px;" >e-mail Secundario:</td>
        			</tr>
        			<tr>
        				<td class="tit1" style="width: 200px;" ><?php echo $edoc;?></td>
          				<td class="tit1"><?php mostrar_sexo($sex);?></td>
          				<td class="tit1" style="width: 150px;" ><?php echo $corr1;?></td>
          				<td class="tit1" style="width: 150px;" ><?php echo $corr2;?></td>
        			</tr>	
    			</table>
			</td>
		</tr>
		<tr>
			<td width="750">
    			<br><hr size="1" width="950"><div class="tit" style="text-align:left;" width:"500px">Dirección Permanente:</div>
				<table width="840" cellpadding="2" cellspacing="0">
                	<tr class="datosp">
                		<td class="tit1" colspan="2" style="width: 400px;" >Avenida/Calle:</td>
                    	<td class="tit1" style="width: 200px;" >Barrio/Urbanizaci&oacute;n</td>
						<td class="tit1" style="width: 200px;" >Manzana/Edificio</td>
                    	<td class="tit1" style="width: 140px;" >Casa/Apto Nro:</td>
                	</tr>
                	<tr>
                    	<td class="tit1" colspan="2" style="width: 300px;" ><?php echo $ave;?>
						</td>
                    	<td class="tit1" style="width: 200px;" ><?php echo $urb;?>
						</td>
						<td class="tit1" style="width: 200px;" ><?php echo $man;?>
						</td>
                    	<td class="tit1" style="width: 140px;" ><?php echo $nro;?>
						</td>
					</tr>
                	<tr>
                    	<td class="tit1" style="width: 200px;" >Ciudad:</td>
                    	<td class="tit1" style="width: 200px;" >Estado:</td>
                    	<td class="tit1" style="width: 200px;" >Tlf Hab:</td>
						<td class="tit1" style="width: 200px;" >Tlf Celular:</td>
						<td class="tit1" style="width: 200px;" >FAX:</td>
                	</tr>
                	<tr>
                   	  <td class="tit1" style="width: 200px;" ><?php echo $ciu;?>
			    	  </td>
                    	<td class="tit1" style="width: 200px;" ><?php echo $edo;?>
				    	</td>
                    	<td class="tit1" style="width: 200px;" ><?php echo "$ctel-$ntel";?>
						</td>                    
						<td class="tit1" style="width: 200px;"><?php echo "$ccel-$ncel";?>
						</td>
						<td class="tit1" style="width: 200px"><?php echo "$cfax-$nfax";?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
    		<td width="850">
				<br><hr size="1" width="950"><div class="tit" style="text-align:left;">Direcci&oacute;n de Residencia:
				<span class="trans">(completar s&oacute;lo si es diferente a la Direcci&oacute;n Permanente)</span>
				</div>
        		<table width="840" cellpadding="2" cellspacing="0">
                	<tr>
                    	<td class="tit1" colspan="2" style="width: 400px">Avenida/Calle:</td>
                    	<td class="tit1" style="width: 200px">Barrio/Urbanizaci&oacute;n/Edificio:</td>
                    	<td class="tit1" style="width: 140px">Casa/Apto Nro:</td>
                	</tr>
                	<tr>
                    	<td class="tit1" colspan="2" style="width: 400px;" ><?php echo $aver;?>
				    	</td>
                    	<td class="tit1" style="width: 200px"><?php echo $urbr;?>
						</td>
                    	<td class="tit1" style="width: 140px"><?php echo $nror;?>
						</td>
					</tr>
					<tr>
                    	<td class="tit1" style="width: 200px">Ciudad:</td>
                    	<td class="tit1" style="width: 200px">Estado:</td>
                    	<td class="tit1" style="width: 200px">Tel&eacute;fono:</td>
                    	<td style="width: 140px;" >
                    </tr>
                	<tr>
                    	<td class="tit1" style="width: 200px;" ><?php echo $ciur;?>
				    	</td>
                    	<td class="tit1" style="width: 200px;" ><?php echo $edor;?>
				    	</td>
                    	<td class="tit1" style="width: 200px"><?php echo "$ctelr-$ntelr";?>
						</td>	
                    	<td style="width: 140px;" >&nbsp;
						</td>
					</tr>
			</table>
    	</td>
    </tr>
	<tr>
    	<td width="850">
			<br><hr size="1" width="950"><div class="tit" style="text-align:left">Datos Acad&eacute;micos:</div>
        		<table width="840" cellpadding="2" cellspacing="0">
					<tr>
                <?php mostrar($uni,$nuc,$codc,$men); ?>
            	</tr>
                <tr>
                <td class="tit1" style="width: 350px;" ><b>Nivel de Estudio:&nbsp;</b><?php echo $niv; ?></td>
                <td class="tit1" style="width: 150px;" >&nbsp;</td>
                <td class="tit1" style="width: 200px;" >&nbsp;</td>
              </tr>
					<tr style="width:850px">
                    		<td class="tit1" style="width: 150px;" >Escala de Evaluación:</td>
                    		<td class="tit1" style="width: 150px;" >Mínima Nota Aprobatoria:</td>
							<td class="tit1" style="width: 500px;" >Modo de Estudio:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							Nivel Aprobado:&nbsp;&nbsp;&nbsp;&nbsp;Créditos Aprobados:</td>
					</tr>	
                	<tr>						
						<td class="tit1"><?php echo $esca;?><font class="tit1">Puntos</font></td>
						<td class="tit1"><?php echo $min;?><font class="tit1">Puntos</font>						</td>
       				  <td class="tit1"><?php echo $mod;?>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<?php echo $nia;?>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<?php echo $cre; ?>
                    <font class="tit1">U.C.</font></td>
               	</tr>																										
				</table>				
	  </td>
		</tr>
    	<td width="850" class="tit1">
        		<table id="thetable" width="840" style="background: #E1F7F5" cellpadding="2" cellspacing="0" border="1"><br><br>
					<?php mostrar_materias($niv,$ced); ?><br>				
				</table>				
		</td>		
		<tr  class="datosp" style="background-color:white;">
			<td width="840" class="tit1"><hr size="1" width="840"><b>NOTAS IMPORTANTES:</b><br>
- NO OLVIDES IMPRIMIR TU PLANILLA Y VERIFICAR EL ESTADO DE TU SOLICITUD. PARA VERIFICAR EL ESTADO DE TU SOLICITUD&nbsp;<a href="verificar_estatus.php">HAGA CLICK AQUI</a><br><br>
- DEBES REVISAR CONSTANTEMENTE TU ESTADO DE SOLICITUD, YA QUE, CUANDO SE VALIDE TU SOLICITUD, SE TE MOSTRARÁ UN MENSAJE DONDE TE INFORMAREMOS QUE DEBERÁS ACUDIR A NUESTRAS OFICINAS A CONSIGNAR LOS REQUISITOS INDISPENSABLES.<br><br>
-UNICAMENTE SE PROCESARÁN 30 SOLICITUDES DE EQUIVALENCIAS, QUE CUMPLAN CON LOS REQUISITOS EXIGIDOS POR LA INSTITUCIÓN.<br><br>
-<b>NOTA IMPORTANTE:</b> ESTA PLANILLA NO GARANTIZA LA APROBACIÓN DE SU EQUIVALENCIA.<br>
				<hr size="1" width="840">
			</td>
		</tr>
			<td>        
				<table id="tBoton" align="center" border="0" cellpadding="1" cellspacing="2"
		 		width="840" style="border-collapse:collapse;border-color:white; border-style:solid; background:white;">
				<tr align="center">			
					<td width="200px"><input class="boton" type="button" value="Eliminar Solicitud" onClick="if(confirm('Seguro(a) que deseas eliminar tu solicitud de equivalencia? (Todos tus datos serán borrados de nuestro sistema)')) datos_p.submit();"></td>
					<td width="200px"><input class="boton" type="button" value="Imprimir" onClick="window.print();"></td>
					<td width="200px"><input class="boton" type="button" value="Salir" id="Salir" onClick="if(confirm('Seguro(a) que deseas salir de esta ventana?')) window.close();"></td>

				</tr>
				</table>
			</td>																						
	</table>
	</form>			
</body>
</html>