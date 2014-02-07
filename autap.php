<html>

<head>
<title>Aprobacion de Compras</title>
<link href='IMAGES/LOGO.png' rel='shortcut icon' type='image/png'>

	<LINK REL="stylesheet" HREF="CSS/stylem.css" TYPE="text/css">
	<meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="refresh" content="30"/>
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
      
      <div id="content">
        <h1>Compras Autorizadas</h1>
        <?php
        
        
       require_once('BIN/controler.php');
       
					$db= new dbManager();
					$db->configuracion("autap.php");
					//--- area de proceso
					
					//--------area de vista
					$req= $db->getRequicisiones();
					$idrq=explode(",",$req[0]);
					$nombre=explode(",",$req[1]);
	            
					$cantidad=explode(",",$req[2]);
					$costo=explode(",",$req[3]);
					$fecha=explode(",",$req[4]);
					$proveedor=explode(",",$req[5]);
					$aprueba=explode(",",$req[6]);
					
					//---------------------
					if(ISSET($_POST["cancelb"])){
					    setcookie("idart","");
						header("Location:autap.php");
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
						header("Location:autap.php");
					    }else{
						?><h2><?php echo($message); ?></h2><?php
					    }
					}
					if(ISSET($_POST["id_art"])){
					    $valida=true;
					    $message="";
					    if(!$db->valida($_POST["id_art"],true)){
						$valida=false;
						$message="Id articulo No Valido";
					    }
					    if(!$db->valida($_POST["cant"],true)){
						$valida=false;
						$message="Cantidad no Valida";
					    }
					    if($valida==true){
						$db->generaRequicision($_POST["id_art"],$_POST["cant"],0,$_COOKIE["idUs"]);
						 ?> <h2>Se genero peticion de  Aprobacion </h2>  <?php
					    }else{
						?><h2><?php echo($message); ?></h2><?php
					    }
					}
					?>
					
					<table class="tab" align="center" border="1" >
					    <tr>
						<th  colspan="6">Generar Requicision de Compra</th>
					    </tr>
					    
					    			
	<?php
	    if(ISSET($_COOKIE["idart"])){
	?>
			<form action="autap.php" method="post">
			<tr>
			<th colspan="2">Nombre del Articulo</th>
			<th colspan="2">Cantidad</th>	
			<th colspan="2" align="center"><center>Generar</center></th>		
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
			<td colspan="2"><center><input type="submit" class="button" value="GENERAR"/></center></td>	
			</tr>
			</form>
			<tr>
	<td colspan="6"><center><form action="autap.php" method="post"><input type="submit" class="button" name="cancelb" value="Cerrar Busqueda"/></form></center></td>
    </tr>
			<?php
	    }else{
		?>
		<tr>
		    <th style="color:black;" colspan="10" align="center" ><center>Buscar Producto</center></th>
		    
		</tr>
		<tr>
		    <td colspan="6">Buscar Por Nombre<br/><form action="autap.php" method="post"><input type="text" name="nprod" /><input type="submit" value="Buscar" class="button"/></form></td>
		</tr>
		<tr>
		    <td colspan="6">Buscar Por Codigo<form action="autap.php" method="post"><input type="text" name="codeprod" /><input type="submit" value="Buscar" class="button"/></form></td>
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
			    <th colspan="6">Resultados de la Busqueda</th>
			</tr>
			<?php
			if($names[0]!="")
			for($i=0;$i<count($names);$i++){
			    ?>
			    <tr>
				<td colspan="4"><?php echo($names[$i]); ?></td>
				<td colspan="4"><form action="autap.php" method="post"><input type="hidden" name="idartb" value="<?php echo($idsart[$i]); ?>" /><input type="submit" class="button" value="Seleccionar"/></form></td>
			    </tr>
			    <?php
			}
		    }
		}
	    }
			?>
					    
					<tr>
					    <th colspan="6">Requicisiones de Compra Aprobadas</th>
					</tr>
					<?php
					if($idrq[0]!=""){
					    ?>
					<tr>
					    <th>Nombre</th>
					    <th>Cantidad</th>
					    <th>Costo</th>
					    <th>Fecha</th>
					    <th>Proveedor</th>
					    <th>Aprobada por..</th>
					</tr>
					<?php
					
					 for($i=0;$i<count($idrq);$i++){
					    ?>
						<tr>
						    <td><?php echo($nombre[$i]); ?></td>
						    <td><?php echo($cantidad[$i]); ?></td>
						    <td><?php echo($costo[$i]); ?></td>
						    <td><?php echo($fecha[$i]); ?></td>
						    <td><?php echo($proveedor[$i]); ?></td>
						     <td><?php echo($aprueba[$i]); ?></td>
						</tr>
					    <?php
					 }
					?>
					<tr>
					    <th colspan="6">
						
						   <a href="reportes/autap.php?ids=<?php echo($req[0]); ?>" target="_BLANK" ><input type="button" class="button" value="Generar Recibo" /></a>
						
						
					    </th>
					</tr>
					<?php
					}else{
					    ?>
					    <tr>
						<th colspan="6">No Tienes Autorizaciones Aprobadas</th>
					    </tr>
					    <?php
					}
					?>
					<tr>
					    <th colspan="6">Requicisiones de Compra no Aprobadas</th>
					</tr>
					
					<?php
					$req= $db->getRequicisionesN();
					$idrq=explode(",",$req[0]);
					$nombre=explode(",",$req[1]);
	            
					$cantidad=explode(",",$req[2]);
					$costo=explode(",",$req[3]);
					$fecha=explode(",",$req[4]);
					$proveedor=explode(",",$req[5]);
					$aprueba=explode(",",$req[6]);
					//----------------
					if($idrq[0]!=""){
					    ?>
					<tr>
					    <th colspan="3">Nombre</th>
					    <th colspan="3">Cantidad</th>
					</tr>
					<?php
					
					 for($i=0;$i<count($idrq);$i++){
					    ?>
						<tr>
						    <td colspan="3"><?php echo($nombre[$i]); ?></td>
						    <td colspan="3"><?php echo($cantidad[$i]); ?></td>
						</tr>
					    <?php
					 }
					}
					?>
					
		</table>
		
       </div>
    </div>
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

</table>
</form>
</div>

</body>
</html>