<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<?php
include_once('inc/config.php'); 
?>
<HEAD>
<script LANGUAGE="Javascript" SRC="asrequest.js"></script>
<script LANGUAGE="Javascript" SRC="inscni.js"></script>
<script languaje="Javascript">
	function validar(f)
	{
		if (f.cedula_v.value == "")
		{
			alert("Por favor, escriba su Cédula antes de pulsar el botón Entrar");
			return false;
		}
		if (f.apellido_v.value == "")
		{
			alert("Por favor, escriba su primer Apellido antes de pulsar el botón Entrar");
			return false;
		}					 
	}
</script>  
<TITLE>Sistema de Equivalencia Externa</TITLE>
<STYLE type=text/css>#prueba {
	BACKGROUND: #f7f7f7; OVERFLOW: hidden; COLOR: #00ffff
}
.titulo {
	MARGIN-TOP: 0px; FONT-WEIGHT: normal; FONT-SIZE: 18px; font-style:oblique; MARGIN-BOTTOM: 0px; FONT-FAMILY: Verdana; TEXT-ALIGN: center;
	
}
.tit1 {
	font-weight:bolder; font-size: 18px; color: #000000; font-family: Arial; text-align:center; font-variant:small-caps
}
.tit12 {
	font-weight:bolder; font-size: 30px; color: #000000; font-family: Arial; text-align:center;
}
.tit {
	font-family:Arial;font-size: 12px;font-weight: normal;font-variant: small-caps;
}
.instruc {
	FONT-WEIGHT: normal; FONT-SIZE: 13px; FONT-FAMILY: Arial; BACKGROUND-COLOR: #ffff99
}
.normal {
	FONT-WEIGHT: normal; FONT-SIZE: 12px; FONT-FAMILY: Arial; BACKGROUND-COLOR: white
}
.boton {
	PADDING-RIGHT: 0px; PADDING-LEFT: 0px; FONT-WEIGHT: normal; FONT-SIZE: 11px; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; FONT-FAMILY: Arial; HEIGHT: 20px; BACKGROUND-COLOR: #e0e0e0; TEXT-ALIGN: center; FONT-VARIANT: small-caps
}

* {
  margin:0px;
  padding:0px;
}
#contenedor
{
  width:100%;
  margin:0px;
  line-height:130%;
  background-image:url(unexp1.jpg);
  background-color:#FFFFFF; 
}
#cabecera
{
  padding:10px;
  color:#fff;
  text-align:center;
  font-family:Arial;
  font-variant:small-caps;
  background-color:#becdfe;
  clear:left;
}
#columna1
{
  float:left;
  width:200px;
  margin:0;
  padding:1em;
}
#columna2
{
  margin-left:210px;
  margin-right:230px;
  border-left:1px solid #aaa;
  border-right:1px solid #aaa;
  padding:1em;
}
#columna3
{
  float:right;
  width:200px;
  margin:0;
  padding:1em;
}
#pie {
  padding:10px;
  color:#fff;
  background-color:#becdfe;
  clear:left;
  font-family:Arial;
  font-size:12px;
  color:#000066;
  font-variant:small-caps
}

	#menu {
		font-family: Arial;
	}

	#menu p {
		margin:0px;
		padding:0px;
	}

	#menu a {
		display: block;
		padding: 3px;
		width: 180px;
		background-color: #FFFFFF;		
		border-bottom: 1px solid #eeeeee;
		text-align:center;
	}

	#menu a:link, #menu a:visited {
		color: #336699;
		text-decoration: none;
	}

	#menu a:hover {
		background-color: #336699;
		color: #ffffff;
	}		
</STYLE>

<META content="MSHTML 6.00.2715.400" name=GENERATOR>
</HEAD>

<BODY>

<?php
	include_once('inc/config.php');
	$conn=odbc_connect($basededatos,$usuariodb,$clavedb);
	$conn1=odbc_connect($basededatos1,$usuariodb1,$clavedb1);
	$ced=$_POST['cedula_v'];
	$ape=$_POST['apellido_v'];
	
	# Verifica si esta habilitado el proceso
	$sqlP="SELECT ESTATUS FROM HABILITAR_P";
	$stmtP=odbc_exec($conn,$sqlP);
	$proceso=odbc_result($stmtP,'ESTATUS');
	if ($proceso == 1){// si esta habilitado
		#Verifica si no es estudiante regular
		$sql="SELECT CI_E FROM DACE002 WHERE CI_E='$ced'";
		$stmt=odbc_exec($conn1,$sql);
		$cedulax=odbc_result($stmt,'CI_E');
		
		$sql="SELECT * FROM DATOSA WHERE CI_E='$cedula' AND ESTATUS='E' ";
		$stmt=odbc_exec($conn,$sql);
		$cedulaE=odbc_result($stmt,'CI_E');
		
		if (!empty($cedulax)){
			$bander = 1;			
		}
		if($cedulaE == ''){// si no es Est. Regular o en espera por documentos
			#Busca los datos personales
			$sql="SELECT CI_E,APELLIDOS FROM DATOS_P WHERE CI_E='$ced'";
			$stmt=odbc_exec($conn,$sql);
			$cedula=odbc_result($stmt,'CI_E');
			$apellido=odbc_result($stmt,'APELLIDOS');
			
			if($cedula==$ced && $apellido!=$ape){
				$flag='3';
				$flagest='3';
			}
			
			if (!empty($ced)){// Si consigue los datos personales
				#Busca los datos academicos
				$sql="SELECT * FROM DATOSA WHERE CI_E='$cedula' AND ESTATUS='0'";
				$stmt=odbc_exec($conn,$sql);
				$cedular=odbc_result($stmt,'CI_E');
				$flagest='1';
				
			} else{
				$flag = '3';
				$flagest='3';
			}
		}else{
			$flag = '2';
			$flagest='2';
		}
	}
	
	/*if($proceso==1){
		if(($cedulax=='') && ($cedulaE=='')){
			if($cedula=='' && $apellido==''){
				$flag='0';
				$flagest='0';
			}
			else{
				if($cedula==$ced && $apellido!=$ape){
					$flag=3;
				}
				else{
					if($cedular=='')
						$flag='2';
					else{
						$flagest='1';
						$flag='1';
					}
				}
			}
		}
		else{
			$bander=1;
		}
	}*/
	
	function mostrar($flag,$bander,$proceso){
		//echo "A".$flag,"B".$bander,"C".$proceso;
		if($proceso==1){
			if($flag=='2'){
				echo "<div style='color:red'>No puedes accesar a la planilla. Ya tus datos han sido procesados.</div>";
			}
			else{
				if($flag=='3'){
					echo "<div style='color:red'>No puedes accesar a la planilla. El Apellido ingresado es incorrecto.</div>";
				}
				else{
					if($bander==1)
						echo "<div style='color:red'>No puedes accesar a la planilla.<br><br>Ya existe un registro de sus datos en la UNEXPO, por favor dir&iacute;jase a la Unidad Regional de Admisi&oacute;n y Control de Estudios (URACE) para plantear su caso.</div>";
					else
						echo "Presione <input type='submit' value='CONTINUAR'>";
				}
			}
		}
		else
			echo "<div style='color:red'>No puedes accesar a la planilla. El sistema no se encuentra HABILITADO.</div>";
	}
?>

<table style="width:100%;">
		<tr>
			<td style="width:20%" align="right"><img height="120" width="130" src="logo_sombra.png"></td>
			<td style="width:60%" class="titulo">
				Universidad Nacional Experimental Politécnica<br>
			  	Vicerrectorado Puerto Ordaz<br>
			  	Unidad Regional de Admisión y Control de Estudios<br>
			</td>
			<td style="width:20%"><img height="120" width="180" src="SEU.jpg"></td>
		</tr>
		<tr>
			<td style="background-color:#ACE2EE" colspan="3"><font style="font-size:2px">&nbsp;</font></td>
		</tr>	
	</table>
	<form method="post" name="datos_p" action="planilla_externa_solicitud.php">
	<input type="hidden" name="flag" value="<?php echo $flag; ?>">
	<input type="hidden" name="flagest" value="<?php echo $flagest; ?>">
	<input type="hidden" name="cedula_v" value="<?php echo $ced; ?>">
	<input type="hidden" name="apellido_v" value="<?php echo $ape; ?>">
	<div id="contenedor">
    <div id="cabecera">
      <h1>Solicitud de Equivalencia</h1>
    </div>
    <div id="columna1">
		<div id="cedula" class="tit">
    	 </div>
		</p>
    </div>
    <div id="columna3">
	  <div id="menu">
			<p><a href="acceso_planilla_externa.php">&lt;&lt;Volver</a></p>
	</div>
    </div>
    <div id="columna2">
       <h1 style="color:#000066; text-align:center">Bienvenido(a)</h1><br><br>
       <p align="center" class="tit12">
	   <b><?php echo "'$ape'"; ?></b><br><br><br><p align="center" class="tit1">a nuestro Sistema de Equivalencias.<br><br><br><br>
	   <div class="tit1"><?php mostrar($flag,$bander,$proceso); ?></div>
       </p>
    </div>
    <div id="pie">
		&copy;2009 - UNEXPO - Vicerrectorado Puerto Ordaz. Oficina Regional de Tecnología y Servicios de Información
    </div>
</div>
</FORM>
</body>
</html>
