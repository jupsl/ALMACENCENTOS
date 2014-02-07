 <html>

<head><title>Entregas</title>
<link href='IMAGES/LOGO.png' rel='shortcut icon' type='image/png'>

	<LINK REL="stylesheet" HREF="CSS/stylem.css" TYPE="text/css">
	<meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>

</head>
<body>

<?php

//Code Here

	
?>
<!---------------------------------->
<div id="main">
    <header>
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="index.html">Control<span class="logo_colour">_Almacen</span></a></h1>
          <h2>Comite Directivo Estatal PRI Chih.</h2>
        </div>
      </div>
      <?php require_once("menu.php");?>
    </header>
    <div id="site_content">
      
      
        <h1>Configuracion de Entregas</h1>
        <?php
        
       require_once('BIN/controler.php');
       
					$db= new dbManager();
					$db->configuracion("salidas.php");
					if(ISSET($_POST["cancelb"])){
					    setcookie("idart","");
						header("Location:salidas.php");
					}
					if(ISSET($_POST["idartb"])){
					    $valida=true;
					    $message="";
					    if(!$db->valida($_POST["idartb"],false)){
							    $valida=false;
							    $message="Clave de Producto no valida";   			
					    }
					    if($valida==true){
						
						
						setcookie("idart",$_POST["idartb"]);
						header("Location:salidas.php");
					    }else{
						?><h2><?php echo($message); ?></h2><?php
					    }
					}
			if(ISSET($_COOKIE["message"])){
				?> <h2><?php echo($_COOKIE["message"]); ?></h2> 
				<?php			
			}		

	///your code here 
	if(ISSET($_POST["idpet"])){
		$valida=true;
		$message="";
		if(!$db->valida($_POST["idart"],true)){
					$valida=false;
					$message="articulo incorrecto";				
				
				}
		if(!$db->valida($_POST["cant"],true)){
					$valida=false;
					$message="cantidad incorrecta";				
				
				}
		if(!$db->valida($_POST["idus"],true)){
					$valida=false;
					$message="usuario incorrecto";				
				
				}
				
	   if(!$db->valida($_POST["idusrecibe"],true)){
					$valida=false;
					$message="usuario incorrecto";				
				
				}
				
		if(!$db->valida($_POST["idpet"],true)){
					$valida=false;
					$message="peticion incorrecta";				
				
				}
	    if(!$db->valida($_POST["disponibles"],true)){
					$valida=false;
					$message="disponibles incorrecto";				
				
				}	
		if($valida==true){
				if(intval($_POST["cant"])>intval($_POST["disponibles"])){
				
					 $db->generaRequicision($_POST["idart"],$_POST["cant"],$_POST["idpet"],$_POST["idus"]);
					 ?> <h2>Se genero peticion de aprobacion Aprobacion </h2>  <?php
				}else{
					$db->generaSalida($_POST["idart"],$_POST["cant"],$_POST["idus"],$_POST["idusrecibe"],$_POST["idpet"]);
					//se generan las cookies para entregar los recibos
						if($_COOKIE["userrecibo"]==""){					
					
					setcookie("userrecibo",$_POST["idusrecibe"]);
					}else{
						//echo("hola");
						setcookie("userrecibo",$_COOKIE["userrecibo"].",".$_POST["idusrecibe"]);	
					}
					if($_COOKIE["cant"]==""){
					setcookie("cant",$_POST["cant"]);
					}else
					{
					//echo("hola2");
						setcookie("cant",$_COOKIE["cant"].",".$_POST["cant"]);					
					
					}
					if($_COOKIE["idart"]==""){
					setcookie("idart",$_POST["idart"]);
					}else
					{
					//echo("hola3");
						setcookie("idart",$_COOKIE["idart"].",".$_POST["idart"]);					
					
					}
					setcookie("message","Salida Generada Correctamente");
					header("location:salidas.php");
				
				
				}		
			
		}else{
			?> <h2><?php echo($message); ?></h2> <?php 
		}
		
	}
	if(ISSET($_POST["id_art"])){
	    if($_POST["id_art"]!="0"){
				$valida=true;
				$message="";
				if(!$db->valida($_POST["id_art"],true)){
					$valida=false;
					$message="articulo incorrecto";				
				
				}
				if(!$db->valida($_POST["cant"],true)){
					$valida=false;
					$message="cantidad incorrecta";				
				}
				if(!$db->haySuficientes($_POST["id_art"],$_POST["cant"])){
					$valida=false;
					$message="No hay suficientes articulos para Satisfacer la demanda";				
				
				}
				if($valida==true){
					$db->generaSalidasinPet($_POST["id_art"],$_POST["cant"],$_COOKIE["idUs"]);
					?><h2>Se reporto la salida correctamente</h2> <?php
				}else
				{
					?><h2><?php echo($message); ?></h2><?php 
				}							
			}	    
	}
	//---------------------------

      ?>
     
        <table class="tab" align="center" border="1" >
        
        <tr >
				<th style="color:black;" colspan="10" align="center" ><center>Generar Salida Sin Peticion</center></th>
			</tr>
	<?php
	    if(ISSET($_COOKIE["idart"])){
	?>
			<form action="salidas.php" method="post">
			<tr>
			<th colspan="2">Nombre del Articulo</th>
			<th colspan="2">Cantidad</th>	
			<th colspan="4" align="center"><center>Generar</center></th>		
			</tr>
			<tr>
			<td colspan="2">
			<?php 
					
					$art=$db->getProducto($_COOKIE["idart"]);
				$nart=$art[1];
				$idart=$art[9];				
				?>
				<input type="hidden" name="id_art" value="<?php echo($idart); ?>" />
				<?php
				echo($nart);
				?>
			</td>	
			<td colspan="2"><input type="text" name="cant" class="prec" id="cant"/></td>	
			<td colspan="4"><center><input type="submit" class="button" value="GENERAR"/></center></td>	
			</tr>
			</form>
			<tr>
	<td colspan="8"><center><form action="salidas.php" method="post"><input type="submit" class="button" name="cancelb" value="Cerrar Busqueda"/></form></center></td>
    </tr>
			<?php
	    }else{
		?>
		<tr>
		    <th style="color:black;" colspan="10" align="center" ><center>Buscar Producto</center></th>
		    
		</tr>
		<tr>
		    <td colspan="8">Buscar Por Nombre<br/><form action="salidas.php" method="post"><input type="text" name="nprod" /><input type="submit" value="Buscar" class="button"/></form></td>
		</tr>
		<tr>
		    <td colspan="8">Buscar Por Codigo<form action="salidas.php" method="post"><input type="text" name="codeprod" /><input type="submit" value="Buscar" class="button"/></form></td>
		</tr>
		<?php
		if(ISSET($_POST["codeprod"])||ISSET($_POST["nprod"])){
		    $valida=true;
		    $mesage="";
		    if(ISSET($_POST["codeprod"])){
			if($db->valida($_POST["codeprod"],true)){
			$art=$db->getProductosByCode($_POST["codeprod"]);
			}else{
			    echo("fallosc");
			    $valida=false;
			}
		    }
		    if(ISSET($_POST["nprod"])){
			if($db->valida($_POST["nprod"],false)){
			$art=$db->getproductosB($_POST["nprod"]);
			}else{
			    $valida=false;
			    echo("fallosn");
			}
		    }
		    if($valida==true){
			$idsart=explode(",",$art[0]);
			$names=explode(",",$art[1]);
			?>
			<tr>
			    <th colspan="8">Resultados de la Busqueda</th>
			</tr>
			<?php
			if($names[0]!="")
			for($i=0;$i<count($names);$i++){
			    ?>
			    <tr>
				<td colspan="4"><?php echo($names[$i]); ?></td>
				<td colspan="4"><form action="salidas.php" method="post"><input type="hidden" name="idartb" value="<?php echo($idsart[$i]); ?>" /><input type="submit" class="button" value="Seleccionar"/></form></td>
			    </tr>
			    <?php
			}
		    }
		}
	    }
			?>
			<tr >
				<th style="color:black;" colspan="10" align="center" ><center>Resumen de Peticiones</center></th>
			</tr>       
			
			<tr>
			<th>Articulo</th>
			<th>Cantidad</th>	
			<th>Disponibles</th>
			<th>Fecha</th>
			<th>Req. Ap.*</th>
			<th>Usuario</th>
			<th>Departamento</th>
			<th>Entregar</th>		
			</tr>
			<tr>
				<?php 
					$detp= $db->getDetallePeticiones();
					$idpet=explode(",",$detp[0]);
					$npet=explode(",",$detp[1]);
					$cantpet=explode(",",$detp[2]);
					$dispet=explode(",",$detp[3]);
               $fechapet=explode(",",$detp[4]);  
               $nuspet=explode(",",$detp[5]);
               $dept=explode(",",$detp[6]); 
               $idusrecibe=explode(",",$detp[7]);  
               $idarticulos=explode(",",$detp[8]); 
               for($i=0;$i<count($idpet);$i++){
						?>
						<form action="salidas.php" method="post" >
						<tr>
							<td><center><?php echo($npet[$i]); ?></center></td>		
							<td><center><input type="text" name="cant" class="prec"  value="<?php echo($cantpet[$i]); ?>" />	</center></td>	
							<td><center><?php echo($dispet[$i]); ?></center></td>	
							<td><center><?php echo($fechapet[$i]); ?></center></td>	
							<td><center><?php if(intval($dispet[$i])<intval($cantpet[$i])){echo("s");}else{echo("n");} ?></center></td>	
							<td><center><?php echo($nuspet[$i]); ?></center></td>	
							<td><center><?php echo($dept[$i]); ?></center></td>	
							<td><center>
							
							<input type="hidden" name="idart" value="<?php echo($idarticulos[$i]); ?>" />		
							
							<input type="hidden" name="idus" value="<?php echo($_COOKIE['idUs']); ?>" />	
							<input type="hidden" name="idusrecibe" value="<?php echo($idusrecibe[$i]); ?>" />	
							<input type="hidden" name="idpet" value="<?php echo($idpet[$i]); ?>" />	
							<input type="hidden" name="disponibles" value="<?php echo($dispet[$i]); ?>" />
							<input type="submit" class="button" value="ENTREGAR"/>			
							<input type="hidden" name="disponibles" value="<?php echo($dispet[$i]); ?>" />
							</center></td>	
							
						</tr>						
							</form>		
						<?php               
               
               }?>
</table>
<span style="font-size:0.6em;">*.- Requiere Aprobacion de a cuerdo a la candidad original la cual se puede modificar</span>
<span style="font-size:0.6em;">*.- Antes de hacer cualquier entrega debes tener habilitados los POP UPS para esta página</span>
<br/>
<?php
if(ISSET($_COOKIE["userrecibo"])){
?>
<a href="firma_salida.php" target="_blank" id="salida" onclick="document.getElementById('salida').style.display = 'none';">Generar Recibo</a>
<?php
}
?>
    <footer>
      <p>&copy; 2013 Secretaria de Analisis de la Informacion, Evaluacion y Seguimiento  | <a href="http://www.prichihuahua.org.mx">Comite Directivo Estatal Chih.</a></p>
    </footer>
  </div>
  <!-- javascript at the bottom for fast page loading -->
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery.easing-sooper.js"></script>
  <script type="text/javascript" src="js/jquery.sooperfish.js"></script>
  <script type="text/javascript" src="js/image_fade.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('ul.sf-menu').sooperfish();
    });
  </script>



</div>

</body>
</html>