<html>
<head>
<script LANGUAGE="Javascript">
function popUp(URL){
	day=new Date();
	id=day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=500,height=300,left = 212,top =134');");
}
</script>
<title>Portal Equivalencias</title>
</head>
<style type=text/css>
.titulo {
	MARGIN-TOP: 0px; FONT-WEIGHT: normal; FONT-SIZE: 18px; font-style:oblique; MARGIN-BOTTOM: 0px; FONT-FAMILY: Verdana; TEXT-ALIGN: center;
	
}
.enca {
	MARGIN-TOP: 0px; FONT-WEIGHT: bolder; FONT-SIZE: 20px; MARGIN-BOTTOM: 0px; FONT-FAMILY: Arial; TEXT-ALIGN: center; font-variant:small-caps
}
.tit {
	text-align: left;font-family:Arial;font-size: 14px;font-weight: bolder;font-variant: small-caps;
}
.trans {
	margin-top: 0px; font-weight:lighter; font-size: 14px; color:#999999; font-family: Arial; margin-bottom:0px;
}
.tit1 {
	text-align: center;font-family:Arial;font-size: 12px;font-weight: normal;
}
.tit12 {
	text-align: center;font-family:Arial;font-size: 16px;font-weight: bolder;font-variant: small-caps;color: #000066;
}
.boton {
  text-align: center; font-family:Arial; font-size: 11px; font-weight: normal; background-color:#e0e0e0; font-variant: small-caps;
  height: 20px; padding: 0px;
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
</style>
<?php
	include_once('inc/config.php');
	function mostrar_fecha($tipo){
		global $basededatos,$$usuariodb,$clavedb;
		$conn=odbc_connect($basededatos,$usuariodb,$clavedb);
		$sql="SELECT * FROM FECHA_PROCESO";
		$stmt=odbc_exec($conn,$sql);
		$fecha=odbc_result($stmt,'FECHA');
		$fechaf=odbc_result($stmt,'FECHAF');
		$fecha=implode("-",array_reverse(explode("-",$fecha)));
		$fechaf=implode("-",array_reverse(explode("-",$fechaf)));
		if ($tipo == 'solicitud'){
			$datos = "<div class='tit1'><b>Inicio:</b> $fecha<br><b>Final:</b> $fechaf</div>";
		}
		if ($tipo == 'documentos'){
			$dias=explode("-",$fechaf);
			$diai = $dias[0]+1;// Inicio de recepcion
			$diaf = $dias[0]+11;// Fin recepcion
			//$fecha = $diai."-".$dias[1]."-".$dias[2];
			//$fechaf = $diaf."-".$dias[1]."-".$dias[2];
			$fecha = "02-11-2022";
			$fechaf = "13-11-2022";

			
			$datos = "<div class='tit1'><b>Inicio:</b> ".$fecha."<br><b>Final:</b> ".$fechaf."<br><span style='font-family:arial;font-size:10pt;color:red;'>(Solo para solicitudes validadas)</span></div>";
		}
		echo $datos;
	}
?>
<body>
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
	<form name="datos_p" method="POST" action="">
	<div id="contenedor">
    <div id="cabecera">
      <h1>Sistema de Equivalencias</h1>
    </div>
    <div id="columna1">
    	<div id="menu">
			<p><a href="acceso_planilla_externa.php">Planilla de Solicitud</a></p>
			<p><a href="requisitos_indispensables.php">Requisitos Indispensables</a></p>
			<p><a href="verificar_estatus.php">Verificar el Estado de tu Solicitud</a></p>
		</div>
    </div>
    <div id="columna3">
	<table cellpadding="0" cellspacing="0" border="1" width="100%" style="border-collapse:collapse;">
	<tr>
		<td><h2 align="center" class="tit12">Proceso de Solicitud</h2><br>
      <p><?php mostrar_fecha('solicitud'); ?>
	  </p><br></td>
	</tr>
	</table>
	
	<br>

	<table cellpadding="0" cellspacing="0" border="1" width="100%" style="border-collapse:collapse;">
	<tr>
		<td><h2 align="center" class="tit12">Proceso de Entrega de Documentos</h2><br>
      <p><?php mostrar_fecha('documentos'); ?>
		
	  </p><br></td>
	</tr>
	</table>
	  
    </div>
    <div id="columna2">
       <h2 align="center" class="tit12">Sistema de Equivalencia Universitaria</h2><br>
       <p class="tit1" style="text-align:justify;">La Universidad Nacional Experimental Politécnica "Antonio Jose de Sucre" - UNEXPO, Núcleo Puerto Ordaz,
	   brinda a la toda la Comunidad Estudiantil la oportunidad de ingresar a esta casa de estudio por medio del
	   nuevo Sistema de ingreso por Equivalencias vía internet.<br><br>Gracias al nuevo Sistema de Equivalencia Universitaria (S.E.U.)
	   cualquier estudiante (graduado o no), que cumpla con los requisitos exigidos, podrá ingresar a la UNEXPO en cualquiera
	   de sus 5 carreras de ingeniería: Mecánica, Eléctrica, Electrónica, Metalúrgica e Industrial.<br><br>
	   <b>Nota Importante:</b> El proceso de recepción de solicitudes se habilitará la <b>CUARTA</b> semana después del inicio de cada lapso académico. El sistema permanecerá abierto por 2 semanas.<br>
	   La entrega de documentos se realiza las dos(2) semanas siguientes de finalizado el proceso.
	   <b>NO SE ACEPTARÁN SOLICITUDES FUERA DEL RANGO PAUTADO.</b>
	   <br><br>
	   Teléfono de la Unidad Regional de Admisión y Control de Estudios (URACE) 0286-9619865 en horario de oficina.
	   <br>
	   Si presenta alguna duda o inconveniente con el sistema, comuniquese 0286-9626378 en horario de oficina.
    </div>
    <div id="pie">
		 &copy;2010 - UNEXPO - Vicerrectorado Puerto Ordaz. Oficina Regional de Tecnología y Servicios de Información
    </div>
</div>
	</form>
</body>
</html>
