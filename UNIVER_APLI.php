<?php
	include_once('inc/config.php');
	$conn=odbc_connect($basededatos,$usuariodb,$clavedb);
	$contador=$_POST['contador'];
	$ced=$_POST['ced'];
	$ape=$_POST['ape'];
	$flag=$_POST['flag'];
	$flagest=$_POST['flagest'];
	
	//print_r($_POST);
		
		if($contador!=''){
				$sql="SELECT * FROM UNIVEXTER ORDER BY UNIVERSIDAD";
				$stmt=odbc_exec($conn,$sql);
				$r=1;
				while($h=odbc_fetch_array($stmt)){
					if($r==$contador){
						$uni=$h['UNIVERSIDAD'];
						$codc=$h['CODIGO_C'];
						$men=$h['MENCION'];
						$nuc=$h['NUCLEO'];
						$sqlso="SELECT SOLICITUD FROM DATOSA";
						$stmtso=odbc_exec($conn,$sqlso);
						$solicitud=10000;
						while($z=odbc_fetch_array($stmtso)){
							if($z['SOLICITUD']>$solicitud)
								$solicitud=$z['SOLICITUD'];
						}
						$solicitud++;
						$sqlve="SELECT * FROM DATOSA WHERE CI_E='$ced'";
						$stmtve=odbc_exec($conn,$sqlve);
						$unix=odbc_result($stmtve,'CI_E');
						
						
						
						if($unix==''){
							$sqlin="INSERT INTO DATOSA VALUES('$ced','0','$uni','$codc','$men','','','','','','','$nuc','0','$solicitud')";
							$stmtin=odbc_exec($conn, $sqlin);
						}
						else{
							$sqlac="UPDATE DATOSA SET UNIVERSIDAD='$uni', CODIGO_C='$codc', MENCION='$men', NUCLEO='$nuc' WHERE CI_E='$ced'";
							$stmtac=odbc_exec($conn,$sqlac);
						}
						echo "La informacion ha sido procesada, cierre esta ventana para continuar.";
						echo "<br><button onCLick='window.close();'>Cerrar</button>";
						
						break;
					}
					$r++;
				}
			}
		
?>