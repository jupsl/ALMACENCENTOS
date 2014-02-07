<html>

<head><title>Peticiones</title>
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
      
      
        <h1>Solicitar Productos al Departamento de Sistemas</h1>
        <?php
        
       require_once('BIN/controler.php');
       
					$db= new dbManager();
					$db->configuracion("peticiones.php");
					if(ISSET($_POST["cancelb"])){
					    setcookie("idart","");
						header("Location:peticiones.php");
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
						header("Location:peticiones.php");
					    }else{
						?><h2><?php echo($message); ?></h2><?php
					    }
					}

		//echo($_COOKIE["idUs"]);
   		if(ISSET($_POST["idart"])){
   			$valida=true;
   			$message="";
   			if(!$db->valida($_POST["idart"],true)){
					$valida=false;
					$message="Clave de Producto no valida";   			
   			}
   			if(!$db->valida($_POST["cantidad"],true)){
					$valida=false;
					$message="cantidad no valida";   			
   			}
   			if($valida==true&&$_POST["idart"]!='0'){
   			$db->agregarPeticion($_POST["idart"],$_POST["cantidad"],$_COOKIE["idUs"]);
   			?><h2>Agregado Correctamente</h2><?php
					}else{
					?><h2><?php echo($message); ?></h2><?php
					}   			
   		}

      ?>
        <form action="peticiones.php" method="post">
        <table class="tab" align="center" border="1" >
			<tr >
				<th style="color:black;" colspan="10" align="center" ><center>Agregar Peticion</center></th>
			</tr>       
			<?php
			if(ISSET($_COOKIE["idart"])){
			?>
			<tr>
			<th>Nombre del Articulo</th>
			<th>Cantidad</th>	
			<th>Agregar</th>		
			</tr>
			<tr>
				<?php 
					
					$art=$db->getProducto($_COOKIE["idart"]);
				$nart=$art[1];
				$idart=$art[9];				
				?>
			
				
				<td><input type="hidden"  name="idart" value="<?php echo($idart); ?>" >
				<?php
				echo($nart);
				?>
				</td>
				<td><input type="text" name="cantidad" class="prec" /></td>	
				
				
				<td><input class="button" type="submit" value="AGREGAR" /></td>				
			</tr>
        
     </form>
     
<tr >
    <tr>
	<td colspan="4"><center><form action="peticiones.php" method="post"><input type="submit" class="button" name="cancelb" value="Cerrar Busqueda"/></form></center></td>
    </tr>
    <?php
			}else{
		?>
		<tr>
		    <th style="color:black;" colspan="10" align="center" ><center>Buscar Producto</center></th>
		    
		</tr>
		<tr>
		    <td colspan="4">Buscar Por Nombre<br/><form action="peticiones.php" method="post"><input type="text" name="nprod" /><input type="submit" value="Buscar" class="button"/></form></td>
		</tr>
		<tr>
		    <td colspan="4">Buscar Por Codigo<form action="peticiones.php" method="post"><input type="text" name="codeprod" /><input type="submit" value="Buscar" class="button"/></form></td>
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
			    <th colspan="4">Resultados de la Busqueda</th>
			</tr>
			<?php
			for($i=0;$i<count($names);$i++){
			    ?>
			    <tr>
				<td colspan="2"><?php echo($names[$i]); ?></td>
				<td colspan="2"><form action="peticiones.php" method="post"><input type="hidden" name="idartb" value="<?php echo($idsart[$i]); ?>" /><input type="submit" class="button" value="Seleccionar"/></form></td>
			    </tr>
			    <?php
			}
		    }
		}
	    }
    ?>
				<th style="color:black;" colspan="10" align="center" ><center>Peticiones del Usuario&nbsp;<?php echo($_COOKIE["useralmacen"]); ?></center></th>
			</tr>       
			
			<tr>
			<th>Nombre</th>
			<th>Cantidad</th>
			<th>Fecha</th>		
			</tr>
			<?php
			$pet=$db->getPeticiones($_COOKIE["idUs"]);
			$nom=explode(",",$pet[0]);
			$cant=explode(",",$pet[1]);
			$fec=explode(",",$pet[2]);
			$disp=explode(",",$pet[3]);
			$color="white"; 
			for($i=0;$i<count($cant);$i++){
			  if($disp[$i]=="" || intval($disp[$i])<2)
			  $color= "red";
			  else
			  $color="white"; 
			?><tr>
					<td style="background-color:<?php echo($color); ?>;"><?php echo($nom[$i]); ?></td>
					<td style="background-color:<?php echo($color); ?>;"><?php echo($cant[$i]); ?></td>	
					<td style="background-color:<?php echo($color); ?>;"><?php echo($fec[$i]); ?></td>		
			</tr> <?php
			}
			?>
			
</table>
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