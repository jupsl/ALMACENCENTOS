<html>

<head><title>Articulos</title>
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
      
      
        <h1>Administracion de Productos</h1>
        <?php
       require_once('BIN/controler.php');
       
					$db= new dbManager();
					$db->configuracion("articulos.php");
		if(ISSET($_POST["cb"])){
		  setcookie("npkey","");
		  setcookie("ncodekey","");
		  header("Location:articulos.php");
		}
					if(ISSET($_POST["nkey"])){
					    $valida=true;
					    $message="";
					    if(!$db->valida($_POST["nkey"],false)){
			         		$valida=false;
			         		$message="Nombre no válido";
			         		}
					    if($valida==true){
						//echo($_POST["nkey"]);
						setcookie("npkey",strtoupper($_POST["nkey"]));
						setcookie("ncodekey","");
						header("Location:articulos.php");
					    }else{
						?><center><h2><?php echo($messaje); ?></h2></center><?php
					    }
					}
					if(ISSET($_POST["codekey"])){
					    $valida=true;
					    $message="";
					    if(!$db->valida($_POST["codekey"],false)){
			         		$valida=false;
			         		$message="Codigo no válido";
			         		}
					    if($valida==true){
						//echo($_POST["nkey"]);
						setcookie("ncodekey",strtoupper($_POST["codekey"]));
						setcookie("npkey","1");
						header("Location:articulos.php");
					    }else{
						?><center><h2><?php echo($messaje); ?></h2></center><?php
					    }
					}
		if(ISSET($_POST["idmodifica"])){
					if($_POST["texted"]!=""){
			         if($_POST["precio1"]=="")
			         	$_POST["precio1"]="0";
			         if($_POST["precio2"]=="")
			         	$_POST["precio2"]="0";
			         if($_POST["precio3"]=="")
			         	$_POST["precio3"]="0";
			         	
			         	$_POST["texted"]=strtoupper($_POST["texted"]);
			         	$_POST["desced"]=strtoupper($_POST["desced"]);
			         	$valida=true;
			         	$message="";
			         	if(!$db->valida($_POST["texted"],false)){
			         		$valida=false;
			         		$message="Nombre no válido";
			         		}
			         	if(!$db->valida($_POST["desced"],false)){
			         		$valida=false;
			         		$message="Descripcion no válida";
			         		}
			         	if(!$db->valida($_POST["precio1"],true)){
			         		$valida=false;
			         		$message="Debe ser un numero";
			         		}
			         	if(!$db->valida($_POST["precio2"],true)){
			         		$valida=false;
			         		$message="Debe ser un numero";
			         		}
			         	if(!$db->valida($_POST["precio3"],true)){
			         		$valida=false;
			         		$message="Debe ser un numero";
			         		}
			        if($valida==true) {	
			        $db->editarArticulo($_POST["texted"],$_POST["desced"],$_POST["prov1"],$_POST["precio1"],$_POST["prov2"],$_POST["precio2"],$_POST["prov3"],$_POST["precio3"],$_POST["idmodifica"]);
				
					}else{
        				?><h2><?php echo($message); ?></h2> <?php
        				}
					
					}


			}
		
      if(ISSET($_POST["proda"])){
      
      	if($_POST["proda"]!=""){
      		if($_POST["prec1"]=="")
      			$_POST["prec1"]="0";
      		if($_POST["prec2"]=="")
      			$_POST["prec2"]="0";
      			if($_POST["prec3"]=="")
      			
      			$_POST["prec3"]="0";
      			
      	$_POST["proda"]=strtoupper($_POST["proda"]);
      	$_POST["desa"]=strtoupper($_POST["desa"]);
      	$valida=true;
      	$message="";
      	$cod="";
      	if(!$db->valida($_POST["proda"],false)){
			         		$valida=false;
			         		$message="nombre no valido";
			         		}
			 if(!$db->valida($_POST["desa"],false)){
			         		$valida=false;
			         		$message="Descripcion no valida";
			         		}
			 if(!$db->valida($_POST["prec1"],true)){
			         		$valida=false;
			         		$message="Debe ser un numero";
			         		}
			  if(!$db->valida($_POST["prec2"],true)){
			         		$valida=false;
			         		$message="Debe ser un numero";
			         		}
			   if(!$db->valida($_POST["prec3"],true)){
			         		$valida=false;
			         		$message="Debe ser un numero";
			         		}
			    if($_POST["prodcodea"]!=""){
				if(!$db->valida($_POST["prodcodea"],true)){
				    $valida=false;
				    $message="Codigo Incorrecto";
				}else{
				    $cod=$_POST["prodcodea"];
				}
			    }else{
				    $cod=$db->generaCodigo();
				}
				
			    if(!$db->validaCodigo($cod)){
				$valida=false;
				    $message="Codigo no puede Repetirse";
			    }
      	if($valida==true){
      		$db->agregaArticulo($_POST["proda"],$_POST["desa"],$_POST["prov1"],$_POST["prec1"],$_POST["prov2"],$_POST["prec2"],$_POST["prov3"],$_POST["prec3"],$cod);
      		?>
      		<h2>Producto Agregado Correctamente</h2> 
      		<?php
      		}else{
      		?>
      		<h2><?php echo($message); ?></h2> 
      		<?php
      		}
      	}else{
      	
      		?>
      		<h2>Faltan algunos datos por llenar</h2>
      		<?php
      	}
      
      }
      ?>
        <form action="articulos.php" method="post">
        <table class="tab" align="center" border="1" width="100%" style="background:#BDBDBD;">
			<tr >
				<th style="color:black;" colspan="6" align="center" ><center>Agregar Producto</center></th>
			</tr>       
			<?php 
					
					$p= $db->getProovedores();
					$ids=explode(',', $p[0]);
					$np=explode(',', $p[1]);				
				?>
			<tr>
			    <th colspan="2">Codigo*</th>
			<th colspan="2">Nombre</th>
			<th colspan="2">Descripcion</th>
			</tr>
			<tr>
			<td colspan="2"><input type="text" name="prodcodea"/></td>
			<td colspan="2"><input type="text" name="proda" /></td>
			<td colspan="2"><input type="text" name="desa" /></td>
			</tr>
			<tr >
			
			<th colspan="2" >Proovedor N. 1</th>		
			<th colspan="2" >Proovedor N. 2</th>	
			<th colspan="2" >Proovedor N. 3</th>	
				
			</tr> 
			<tr>
			<th>Nombre</th>
			<th>Precio</th>	
			<th>Nombre</th>
			<th>Precio</th>	
			<th>Nombre</th>
			<th>Precio</th>	
			</tr>
			<tr>
				
				
				
				<td><select  name="prov1" class="stab" >
				<option value="0">Ninguno</option>	
				<?php
				if($ids[0]!="")
				 for($i=0;$i<count($ids);$i++){
					?><option value="<?php echo($ids[$i]); ?>"><?php echo($np[$i]); ?></option> <?php				 
				 } 
				?>			
				</select></td>
				<td><input type="text" name="prec1" class="prec" /></td>	
				<td><select  name="prov2" class="stab" >
				<option value="0">Ninguno</option>	
				<?php
				if($ids[0]!="")
				 for($i=0;$i<count($ids);$i++){
					?><option value="<?php echo($ids[$i]); ?>"><?php echo($np[$i]); ?></option> <?php				 
				 } 
				?>					
				</select></td>
				<td><input type="text" name="prec2" class="prec" /></td>	
				<td><select  name="prov3" class="stab" >
				<option value="0">Ninguno</option>	
				<?php
				//echo(count($ids));
			    if($ids[0]!="")
				 for($i=0;$i<count($ids);$i++){
					?><option value="<?php echo($ids[$i]); ?>"><?php echo($np[$i]); ?></option> <?php				 
				 } 
				?>					
				</select></td>
				
				<td><input type="text" name="prec3" class="prec" /></td>	
				</tr>
				<tr>
				<td colspan="6"><center><input class="button" type="submit" value="AGREGAR" /></center></td>				
			</tr>
        
     </form>
     </table>
	
	
	     <table class="tab" align="center" border="1" width="100%" >
		<tr>
		    <th colspan="2">Busqueda de Productos</th>
		</tr>
		<tr>
		    <form action="articulos.php" method="post">
			<th><center>Escribe el Nombre<input type="text" name="nkey" /><input type="submit" value="Buscar" class="button" /></center>
		    </th>
		    </form>
		</tr>
		<tr>
		    <form action="articulos.php" method="post">
			<th><center>Escribe el Codigo<input type="text" name="codekey" /><input type="submit" value="Buscar" class="button" /></center>
		    </th>
		    </form>
		</tr>
		
	     </table>
	    <?php
	 if(ISSET($_COOKIE["npkey"])){
	    ?>
     <table class="tab" align="center" border="1" width="100%">
<tr >
				<th style="color:black;" colspan="6" align="center" ><center>Resultados de Busqueda:&nbsp;<?php echo($_COOKIE["npkey"]); ?></center></th>
			</tr>       
			
			<?php
			if(ISSET($_COOKIE["ncodekey"]))
			$art=$db->getProductosByCode($_COOKIE["ncodekey"]);
			else
			$art= $db->getProductosB($_COOKIE["npkey"]);
			$idsart=explode(",",$art[0]);
			$names=explode(",",$art[1]);
			$desc=explode(",",$art[2]);
			$prov1=explode(",",$art[3]);
			$precio1=explode(",",$art[4]);
			$prov2=explode(",",$art[5]);
			$precio2=explode(",",$art[6]);
			$prov3=explode(",",$art[7]);
			$precio3=explode(",",$art[8]);
			if($idsart[0]!=""){
				for($i=0;$i<count($idsart);$i++){
				if(!ISSET($_POST["idart"])){				
				?>
				<form action="articulos.php" method="post">
				<tr>
				<th colspan="3">Nombre</th>		
				<th colspan="3">Descripcion</th>			
				</tr>		
				<tr>
				<th colspan="3"><input type="hidden" name="idart" value="<?php echo($idsart[$i]);?>"/><?php  echo($names[$i]); ?></th>		
				<th colspan="3"><?php echo($desc[$i]); ?></th>			
				</tr>		
					<tr >
			
			<th colspan="2" >Proovedor N. 1</th>		
			<th colspan="2" >Proovedor N. 2</th>	
			<th colspan="2" >Proovedor N. 3</th>	
				
			</tr> 
			<tr>
			<th>Nombre</th>
			<th>Precio</th>	
			<th>Nombre</th>
			<th>Precio</th>	
			<th>Nombre</th>
			<th>Precio</th>	
			</tr>		
				<tr>
				
				<td><?php echo($prov1[$i]); ?></td>
				<td><?php echo($precio1[$i]); ?></td>
				<td><?php echo($prov2[$i]); ?></td>
				<td><?php echo($precio2[$i]); ?></td>
				<td><?php echo($prov3[$i]); ?></td>
				<td><?php echo($precio3[$i]); ?></td>	
				</tr>
				<tr></tr>
				<td colspan="6"><center><input type="submit" class="button" value="EDITAR"/></center></td>		
				</tr>
				</form>
				<?php		
				}else{
							if($_POST["idart"]==$idsart[$i]){
							$articulo= $db->getProducto($_POST["idart"]);
							$idprov1=$articulo[3];
							$idprov2=$articulo[5];
							$idprov3=$articulo[7];
				?>
							<form action="articulos.php" method="post">	
							<tr>
								<th colspan="3">Nombre</th>	
								<th colspan="3">Descripcion</th>							
							</tr>
							<tr>
							<td colspan="3"><input type="hidden" name="idmodifica" value="<?php echo($idsart[$i]);?>"/><input type="text" name="texted" value="<?php  echo($names[$i]); ?>"/></td>		
							<td colspan="3"><input type="text" name="desced" value="<?php echo($desc[$i]); ?>"/></td>						
							</tr>		
								<tr >
			
			<th colspan="2" >Proovedor N. 1</th>		
			<th colspan="2" >Proovedor N. 2</th>	
			<th colspan="2" >Proovedor N. 3</th>	
				
			</tr> 
			<tr>
			<th>Nombre</th>
			<th>Precio</th>	
			<th>Nombre</th>
			<th>Precio</th>	
			<th>Nombre</th>
			<th>Precio</th>	
			</tr>		
				<tr>
				
				
				<td>
				<select  name="prov1" class="stab" >
				<option value="0">Ninguno</option>	
				<?php
				//echo(count($ids));
			    if($ids[0]!="")
				 for($j=0;$j<count($ids);$j++){
					?><option value="<?php echo($ids[$j]); ?>" <?php if($idprov1==$ids[$j]) echo("selected"); ?>><?php echo($np[$j]); ?></option> <?php				 
				 } 
				?>					
				</select>				
				</td>
				
				<td><input type="text" name="precio1" class="prec" value="<?php echo($precio1[$i]); ?>"/></td>

				<td>
				<select  name="prov2" class="stab" >
				<option value="0">Ninguno</option>	
				<?php
				//echo(count($ids));
			    if($ids[0]!="")
				 for($j=0;$j<count($ids);$j++){
					?><option value="<?php echo($ids[$j]); ?>" <?php if($idprov2==$ids[$j]) echo("selected"); ?>><?php echo($np[$j]); ?></option> <?php				 
				 } 
				?>					
				</select>								
				
				</td>
				
				<td><input type="text" name="precio2" class="prec" value="<?php echo($precio2[$i]); ?>"/></td>
				<td>
				<select  name="prov3" class="stab" >
				<option value="0">Ninguno</option>	
				<?php
				//echo(count($ids));
			    if($ids[0]!="")
				 for($j=0;$j<count($ids);$j++){
					?><option value="<?php echo($ids[$j]); ?>" <?php if($idprov3==$ids[$j]) echo("selected"); ?>><?php echo($np[$j]); ?></option> <?php				 
				 } 
				?>					
				</select>								
				</td>
				
				<td><input type="text" name="precio3" class="prec" value="<?php echo($precio3[$i]); ?>"/></td>	
				</tr>
				<tr></tr>
				<td colspan="6"><center><input type="submit" class="button" value="GUARDAR"/></center></td>		
				</tr>

				</form>
					<?php
										
							
							}else{
							?>
				<form action="articulos.php" method="post">	
				<tr>
					<th colspan="3">Nombre</th>
					<th colspan="3">Descripcion</th> 				
				</tr>	
				<tr>
					<td colspan="3"><input type="hidden" name="idart" value="<?php echo($idsart[$i]);?>"/><?php  echo($names[$i]); ?></td>
					<td colspan="3"><?php echo($desc[$i]); ?></td>				
				</tr>	
				<tr >
			
			<th colspan="2" >Proovedor N. 1</th>		
			<th colspan="2" >Proovedor N. 2</th>	
			<th colspan="2" >Proovedor N. 3</th>	
				
			</tr> 
			<tr>
			<th>Nombre</th>
			<th>Precio</th>	
			<th>Nombre</th>
			<th>Precio</th>	
			<th>Nombre</th>
			<th>Precio</th>	
			</tr>			
				<tr>	
				<td><?php echo($prov1[$i]); ?></td>
				<td><?php echo($precio1[$i]); ?></td>
				<td><?php echo($prov2[$i]); ?></td>
				<td><?php echo($precio2[$i]); ?></td>
				<td><?php echo($prov3[$i]); ?></td>
				<td><?php echo($precio3[$i]); ?></td>	
				</tr>
				<tr></tr>
				<td colspan="6"><center><input type="submit" class="button" value="EDITAR"/></center></td>		
				</tr>
				</form>
				<?php	
							}
					}		
				
				}
			}
			?>
</table>
     <table class="tab" align="center" border="1" width="100%">
	<tr>
	    <th><center>Cerrar la Busqueda</center></th>
	</tr>
	<tr>
	    <td><center><form action="articulos.php" method="post"><input type="submit" name="cb" value="cerrar" class="button"/></form></center></td>
	</tr>
     </table>
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