<?php
	include_once('inc/config.php');
	$conn=odbc_connect($basededatos,$usuariodb,$clavedb);
	$ced=$_POST['ced'];
	$sql="SELECT * FROM DATOSA WHERE CI_E='$ced'";
	$stmt=odbc_exec($conn,$sql);
	$ced=odbc_result($stmt,'CI_E');
	if($ced=='')
		echo "<div class='tit1' style='text-align:center; color:black'><br><br>Usted no ha realizado solicitud en nuestro Sistema o ha sido eliminado del mismo.</div>";
	else{
		$estatus=odbc_result($stmt,'ESTATUS');
		switch($estatus){
			case 0:
				echo "<div class='tit1' style='text-align:center; color:red'><br><br>Su solicitud esta en proceso de VALIDACI&Oacute;N.</div>";
			break;
			case 1:
				$sqlf="SELECT FECHA,FECHAF FROM FECHA_PROCESO";
				$stmtf=odbc_exec($conn,$sqlf);
				$fecha=odbc_result($stmtf,'FECHA');
				$fechaf=odbc_result($stmtf,'FECHAF');
				$fechaf=implode("-",array_reverse(explode("-",$fechaf)));
				
				/*$dias=explode("-",$fechaf);
				$diai = $dias[0]+3;// Inicio de recepcion
				$diaf = $dias[0]+13;// Fin recepcion
				
				$fecha = "03-12-".$dias[2];
				$fechaf = "07-06-".$dias[2];*/

				$dias=explode("-",$fechaf);
				$diai = $dias[0]+1;// Inicio de recepcion
				$diaf = $dias[0]+11;// Fin recepcion
				/*$fecha = "11-05-".$dias[2];
				$fechaf = "22-05-".$dias[2];*/
				$fecha = "02-03-2018";
				$fechaf = "13-03-2018";

				echo "<div class='tit12' align='center'><br><br><b>Su solicitud ha sido procesada. Debe llevar los siguientes documentos a las oficinas de URACE antes del $fechaf</b>:</div><br><br>
							<div class='tit1' style='text-align:justify;'>
							-&nbsp;&nbsp;Copia de c&eacute;dula de identidad<br>
							-&nbsp;&nbsp;Notas certificadas en original<br>
							-&nbsp;&nbsp;Programas sellados y firmados en original<br>
							-&nbsp;&nbsp;Carta de vigencia de programas<br>
							-&nbsp;&nbsp;Copia de t&iacute;tulo de bachiller<br>
							-&nbsp;&nbsp;Una (1) foto tipo carnet vigente<br>
							-&nbsp;&nbsp;Carta de buena conducta<br>
							-&nbsp;&nbsp;Pensum de la carrera que cursa<br>
							-&nbsp;&nbsp;Copia del t&iacute;tulo (Si es graduado)<br>
							-&nbsp;&nbsp;Recibo de pago ARANCEL por concepto de manejo y revisi&oacute;n
							<ul style=\"padding-left:25px;\">
								<li>- Banco Caron&iacute; (Cuenta Corriente).</li>
								<li>- Nro. de Cuenta: <b>0128-0038-003821542101.</b></li>
								<li>- Monto:
									<ul style=\"padding-left: 50px;\">
										<li>Solicitud desde Instituci&oacute;n de Educaci&oacute;n Superior P&uacute;blica: 3 UT</li>
										<li>Solicitud desde Instituci&oacute;n de Educaci&oacute;n Superior Privada: 5 UT</li>
										<li>Solicitud desde Instituci&oacute;n de Educaci&oacute;n Superior Extranjera (Para Venezolanos): 4 UT</li>
										<li>Solicitud desde Instituci&oacute;n de Educaci&oacute;n Superior Extranjera (Para Extranjeros): 10 UT</li>
										<li>Solicitud desde la UNEXPO: 3 UT</li>
									</ul>
								
								</li>
							</ul>
							<br><br>
							</div>
							<div class='tit1' style='text-align:left; color:red; padding-left: 50px;'><br><br>
							<b>NOTA IMPORTANTE:</b>
							<ul style='font-family:Arial;font-size:12pt;'>
								<li>Todos los documentos deben ser entregados dentro de un sobre manila.</li>
								<li>Solo ser&aacute;n tramitadas las solicitudes de equivalencia que cumplan con todos los requisitos exigidos.</li>
								<li>Recuerde consignar los documentos los antes posible ya que s&oacute;lo se tramitan 30 solicitudes por semestre.</li>
							</ul>
							
							
							</div>";
			break;
			case 2:
				echo "<div class='tit1' style='text-align:center; color:green'><br><br>Su Equivalencia ha sido aplicada Satisfactoriamente.<br></div> 
				<div class='tit' align='center'><b>Recuerde que su Equivalencia NO GARANTIZA el cupo de estudio en el lapso pautado.</b></div>";
			break;
			case 3:
				echo "<div class='tit1' style='text-align:center; color:orange'><br><br>Su Equivalencia ha sido aplicada Satisfactoriamente pero usted no se inscribi&oacute; en el semestre pautado. Debe dirigirse a las oficinas de URACE para solicitar su reingreso por Equivalencia NO UTILIZADA.</div>";
			break;
			case 4:
				echo "<div class='tit1' style='text-align:center; color:red'><br><br>Su Solicitud ha sido RECHAZADA por no cumplir con los requisitos exigidos.<br>Verifique los requisitos indispensables.</div>
				<div style='text-align:center; color:black'><br>En caso de cumplir con los requisitos indispensables, dir&iacute;jase a las oficinas de U.R.A.C.E. (Edificio Administrativo) de la Unexpo Puerto Ordaz, para plantear su situaci&oacute;n.</div>";
			break;
		}
	}	
?>
