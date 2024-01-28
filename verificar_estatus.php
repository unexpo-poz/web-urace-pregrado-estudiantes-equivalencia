<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<script LANGUAGE="Javascript" SRC="inscni.js"></script>
<script LANGUAGE="Javascript" SRC="asrequest.js"></script> 
<TITLE>Sistema de Equivalencia Externa</TITLE>
<STYLE type=text/css>#prueba {
	BACKGROUND: #f7f7f7; OVERFLOW: hidden; COLOR: #00ffff
}
.titulo {
	MARGIN-TOP: 0px; FONT-WEIGHT: normal; FONT-SIZE: 18px; font-style:oblique; MARGIN-BOTTOM: 0px; FONT-FAMILY: Verdana; TEXT-ALIGN: center;
	
}
.tit1 {
	font-weight:bolder; font-size: 18px; color: #000066; font-family: Arial; text-align:center; font-variant:small-caps
}
.tit12 {
	font-weight:bolder; font-size: 14px; color: #000000; font-family: Arial; text-align:center; font-variant:small-caps
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
	<form method="post" name="chequeo" onSubmit="return validar(this)" action="">

	<div id="contenedor">
    <div id="cabecera">
      <h1>Solicitud de Equivalencia</h1>
    </div>
    <div id="columna1">
    	<p class="tit">
		<br>Cédula o Nro. Pasaporte:<br>
		<input type="text" size=10 maxlength="10" name="cedula" onKeyUp="validarN(this);">
		<br><br><input value="Entrar" type="button" onClick="if(cedula.value=='') alert('Debe ingresar su número de Cédula'); else fajax('ESTATUS.php','solicitud','ced='+cedula.value+'','post','0');">
		</p>
    </div>
    <div id="columna3">
	  <div id="menu">
			<p><a href="portada_equivalencias.php">&lt;&lt;Volver</a></p>
	</div>
    </div>
    <div id="columna2">
       <h2 class="tit1">Acceso al Estado de Solicitud</h2>
       <div id="solicitud">
	   </div>	
         <br><br>
       </p>
    </div>
    <div id="pie">
		&copy;2010 - UNEXPO - Vicerrectorado Puerto Ordaz. Oficina Regional de Tecnología y Servicios de Información
    </div>
</div>
</FORM>
</body>
</html>
