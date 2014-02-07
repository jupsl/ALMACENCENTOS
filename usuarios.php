<html>

<head>
<title>Administracion de Usuarios</title>
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
      <?php
        include_once("BIN/controler.php");
        $db= new dbManager();
		  $db->configuracion("usuarios.php");
		  //area de cnfiguracion
		  if(ISSET($_POST["idused"])){
		  if($_POST["nombree"]!=""&&$_POST["nick"]!=""){
		    $valida=true;
		    $message="";
		    if(!$db->valida($_POST["nombree"],false)){
		    $valida=false;
		    $message="Nombre Incorrecto";
		    }
		    if(!$db->valida($_POST["paterno"],false)){
		    $valida=false;
		    $message="Nombre Incorrecto";
		    }
		    if(!$db->valida($_POST["materno"],false)){
		    $valida=false;
		    $message="Nombre Incorrecto";
		    }
		    if(!$db->valida($_POST["nick"],false)){
		    $valida=false;
		    $message="Nick Incorrecto";
		    }else if($db->yaEstaNick2($_POST["nick"],$_POST["idused"])){
		    $valida=false;
		    $message="El Nick ya esta siendo ocupado";
		    
		    }
		    if(!$db->valida($_POST["contraseña"],false)){
		    $valida=false;
		    $message="contraseña Incorrecto";
		    }
		    if(!$db->valida($_POST["nivel"],false)){
		    $valida=false;
		    $message="nivel Incorrecto";
		    }
		    if(!$db->valida($_POST["dpto"],true)){
		    $valida=false;
		    $message="departamento Incorrecto";
		    }
		    if($valida==true){
		    $_POST["nombree"]=strtoupper($_POST["nombree"]);
		    $_POST["paterno"]=strtoupper($_POST["paterno"]);
		    $_POST["materno"]=strtoupper($_POST["materno"]);
		    //echo("hola");
		    $db->editaUsuario($_POST["idused"],$_POST["nombree"],$_POST["paterno"],$_POST["materno"],$_POST["nick"],$_POST["contraseña"],$_POST["nivel"],$_POST["dpto"]);
		    ?><h2>Usuario Editado Correctamente</h2><?php
		    
		    }else{
		    ?><h2><?php echo($message); ?></h2> <?php
		    }
		    }else{
		    ?><h2>Faltan algunos Datos</h2><?php
		    }
		  
		  }
		  if(ISSET($_POST["bajaus"])){
		  	$valida=true;
		  	$message="";
		  	if(!$db->valida($_POST["bajaus"],false)){
		  	$valida=false;
		  	$message="id invalido";
		  	}
		  	
		  	if($valida==true){
		  	$db->bajaUsuario($_POST["bajaus"]);
		  	?><h2>Usuario Eliminado con Exito</h2> <?php
		  	}else{
		  	?><h2><?php echo($message); ?></h2><?php
		  	
		  	}
		  
		  }
		  if(ISSET($_POST["nombre"]) ){
		    if($_POST["nombre"]!=""&&$_POST["nick"]!=""&&$_POST["contraseña"]!=""){
		    $valida=true;
		    $message="";
		    if(!$db->valida($_POST["nombre"],false)){
		    $valida=false;
		    $message="Nombre Incorrecto";
		    }
		    if(!$db->valida($_POST["paterno"],false)){
		    $valida=false;
		    $message="Nombre Incorrecto";
		    }
		    if(!$db->valida($_POST["materno"],false)){
		    $valida=false;
		    $message="Nombre Incorrecto";
		    }
		    if(!$db->valida($_POST["nick"],false)){
		    $valida=false;
		    $message="Nick Incorrecto";
		    }else if($db->yaEstaNick($_POST["nick"])){
		    $valida=false;
		    $message="El Nick ya esta siendo ocupado";
		    
		    }
		    if(!$db->valida($_POST["contraseña"],false)){
		    $valida=false;
		    $message="contraseña Incorrecto";
		    }
		    if(!$db->valida($_POST["nivel"],false)){
		    $valida=false;
		    $message="nivel Incorrecto";
		    }
		    if(!$db->valida($_POST["dpto"],true)){
		    $valida=false;
		    $message="departamento Incorrecto";
		    }
		    if($valida==true){
		    $_POST["nombre"]=strtoupper($_POST["nombre"]);
		    $_POST["paterno"]=strtoupper($_POST["paterno"]);
		    $_POST["materno"]=strtoupper($_POST["materno"]);
		    //echo("hola");
		    $db->agregaUsuario($_POST["nombre"],$_POST["paterno"],$_POST["materno"],$_POST["nick"],$_POST["contraseña"],$_POST["nivel"],$_POST["dpto"]);
		    ?><h2>Usuario Agregado Correctamente</h2><?php
		    
		    }else{
		    ?><h2><?php echo($message); ?></h2> <?php
		    }
		    }else{
		    ?><h2>Faltan algunos Datos</h2><?php
		    }
		  
		  }
		  //Area de vista
		  $dptos=$db->getDepartamentos();
		  $iddpto=explode(",",$dptos[0]);
		  $ndpto=explode(",",$dptos[1]);
      ?>
      <div id="content">
        <h1>Administracion de Usuarios</h1>
        <table class="tab" align="center" border="1" >
        <tr>
				<th colspan="9">Agregar Usuario</th>        
        </tr>
        <tr>
				<th>Nombre</th>
				<th>Paterno</th>
				<th>Materno</th>
				<th>Nick</th>
				<th>Contraseña</th>
				<th>Nivel</th>
				<th>Departamento</th>
				<th COLSPAN="2">Agregar</th>        
        </tr>
        <form action="usuarios.php" method="post">
      	<tr>
				<td><input type="text" name="nombre" class="prec"  /></td>  
				<td><input type="text" name="paterno" class="prec"  /></td> 
				<td><input type="text" name="materno" class="prec"  /></td> 
				<td><input type="text" name="nick" class="prec"  /></td> 
				<td><input type="password" name="contraseña" class="prec"  /></td> 
				<td>
				<select name="nivel" class="prec" >
					<option value="1A">1A</option>	
					<option value="1B">1B</option>
					<option value="2A">2A</option>
					<option value="2B">2B</option>						
				</select>				
				</td> 
				<td>
					<select name="dpto" class="prec" >
					<?php
					if($iddpto[0]!=""){
					for($i=0;$i<count($iddpto);$i++){
							?>
							<option value="<?php echo($iddpto[$i]); ?>"><?php echo($ndpto[$i]); ?></option>
							
							<?php
					
					}
					
					}
					?>					
					
					</select>				
				</td> 
				<td COLSPAN="2" ><center><input type="submit" class="button" value="AGREGAR"/></center></td>     	
      	
      	</tr>
      	</form>
        <?php
        $us=$db->getUsuarios();
        $ids=explode(",",$us[0]);
        $nombre=explode(",",$us[1]);
        $paterno=explode(",",$us[2]);
        $materno=explode(",",$us[3]);
		  $nick=explode(",",$us[4]);
		  $nivel=explode(",",$us[5]);
		  $iddpto1=explode(",",$us[6]);
		  $dpto=explode(",",$us[7]);
		  
		  
        ?>
        
        <tr>
				<th colspan="9">Usuarios Existentes</th>        
        </tr>
        <tr>
				<th>Nombre</th>
				<th>Paterno</th>
				<th>Materno</th>
				<th>Nick</th>
				<th>Contraseña</th>
				<th>Nivel</th>
				<th>Departamento</th>
				<th>Editar</th>
				<th>Baja</th>
        </tr>
        <?php
        if($ids[0]!=""){
        
        if(ISSET($_POST["idus"])){
        	for($i=0;$i<count($ids);$i++){
        	if($_POST["idus"]!=$ids[$i]){
        	?>
        	<tr>
				<td><?php echo($nombre[$i]);  ?></td>   
				<td><?php echo($paterno[$i]);  ?></td> 
				<td><?php echo($materno[$i]);  ?></td> 
				<td><?php echo($nick[$i]);  ?></td> 
				<td>*****</td> 
				<td><?php echo($nivel[$i]); ?>
									
				</td> 
				<td><?php echo($dpto[$i]); ?></td> 
				<td><form action="usuarios.php" method="post"><input type="hidden" name="idus" value="<?php echo($ids[$i]); ?>"/><input type="submit" value="EDITAR" class="button"/></form></td>  
				<td><form action="usuarios.php" method="post"><input type="hidden" name="bajaus" value="<?php echo($ids[$i]); ?>"/><input type="submit" value="BAJA" class="button"/></form></td>     	
        	</tr>
        	<?php
        	}else{
        	?>
        	<tr>
        	<form action="usuarios.php" method="post">
				<td><input type="text" name="nombree" class="prec" value="<?php echo($nombre[$i]);  ?>"</td>   
				<td><input type="text" name="paterno" class="prec" value="<?php echo($paterno[$i]);  ?>"</td> 
				<td><input type="text" name="materno"  class="prec" value="<?php echo($materno[$i]);  ?>"</td> 
				<td><input type="text" name="nick" class="prec"  value="<?php echo($nick[$i]);  ?>"</td> 
				<td><input type="password" name="contraseña" class="prec" /></td> 
				<td>
				<select name="nivel" class="prec" >
					<option value="1A" <?php if($nivel[$i]=="1A"){ echo("selected");} ?> >1A</option>	
					<option value="1B" <?php if($nivel[$i]=="1B"){ echo("selected");} ?>>1B</option>
					<option value="2A" <?php if($nivel[$i]=="2A"){ echo("selected");} ?>>2A</option>
					<option value="2B" <?php if($nivel[$i]=="2B"){ echo("selected");} ?>>2B</option>						
				</select>					
				
				</td> 
				<td>
				<select name="dpto" class="prec" >
					<?php
					if($iddpto[0]!=""){
					for($j=0;$j<count($iddpto);$j++){
							?>
							<option value="<?php echo($iddpto[$j]); ?>" <?php if($iddpto1[$i]==$iddpto[$j] ){echo("selected");} ?>     ><?php echo($ndpto[$j]); ?></option>
							
							<?php
					
					}
					
					}
					?>					
					
					</select>								
				
				
				</td> 
				<td><input type="hidden" name="idused" value="<?php echo($ids[$i]); ?>"/><input type="submit" value="GUARDAR" class="button"/></form></td>  
				<td><form action="usuarios.php" method="post"><input type="submit" value="CANCELAR" class="button"/></form></td>     	
        	</tr>
        	<?php
        	
        	}
        	}
			        
        
        }else{
        	for($i=0;$i<count($ids);$i++){
        	?>
        	<tr>
				<td><?php echo($nombre[$i]);  ?></td>   
				<td><?php echo($paterno[$i]);  ?></td> 
				<td><?php echo($materno[$i]);  ?></td> 
				<td><?php echo($nick[$i]);  ?></td> 
				<td>*****</td> 
				<td><?php echo($nivel[$i]); ?>
									
				</td> 
				<td><?php echo($dpto[$i]); ?></td> 
				<td><form action="usuarios.php" method="post"><input type="hidden" name="idus" value="<?php echo($ids[$i]); ?>"/><input type="submit" value="EDITAR" class="button"/></form></td>  
				<td><form action="usuarios.php" method="post"><input type="hidden" name="bajaus" value="<?php echo($ids[$i]); ?>"/><input type="submit" value="BAJA" class="button"/></form></td>     	
        	</tr>
        	<?php
        	
        	}
        	}
        }
        ?>
        </table>
			<h2>Descripcion de Usuarios</h2>        
			<table class="tab" align="center" border="0">
			<tr><td>
        <ul>
			  <li>Nivel 1A (Administrador)
					<ul>
						<li>Articulos</li>
						<li>Proveedores</li>
						<li>Autorizaciones</li>
						<li>Autorizaciones Aprobadas</li>
						<li>Peticiones</li>
						<li>Recepciones</li>
						<li>Entregas</li>
						<li>Reportes</li>
						<li>Usuarios</li>
				</ul>			  
			  
			  </li>
        </ul>
        </td>
        <td>
        <ul>
			  <li>Nivel 1B (Encargados de Almacen)
					<ul>
						<li>Recepciones</li>
						<li>Entregas</li>
						<li>Autorizaciones Aprobadas</li>
						<li>Reportes</li>
				</ul>			  
			  
			  </li>
        </ul>
        
        </td>
        </tr>
        <tr>
			<td>
				<ul>
			  <li>Nivel 2A (Quién Aprueba las Compras)
					<ul>
						<li>Autorizaciones</li>
				</ul>			  
			  
			  </li>
        </ul>
			
			</td>
			<td>
				<ul>
			  <li>Nivel 2B (Usuarios del Almacen)
					<ul>
						<li>Peticiones</li>
				</ul>			  
			  
			  </li>
        </ul>			
			</td> 
        </tr>
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