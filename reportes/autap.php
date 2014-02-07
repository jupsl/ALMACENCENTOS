<html>

<head><title>Reportes</title>
<link href='IMAGES/LOGO.png' rel='shortcut icon' type='image/png'>

	<LINK REL="stylesheet" HREF="../CSS/stylem.css" TYPE="text/css">
	<meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="../css/style.css" />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="../js/modernizr-1.5.min.js"></script>

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
     
    </header>
    <div id="site_content">
      
      
        <h1>Autorizaciones Aprobadas</h1>
        <?php
       require_once('../BIN/controler.php');
       if(ISSET($_GET["ids"])){
    
       
					$db= new dbManager();
	    if($db->valida($_GET["ids"],false)){
					$db->configuracion("autap.php");
                                        $req= $db->getRequicisionesIds($_GET["ids"]);
					$db->realizaRequicisiones($_GET["ids"]);
					$idrq=explode(",",$req[0]);
					$nombre=explode(",",$req[1]);
	            
					$cantidad=explode(",",$req[2]);
					$costo=explode(",",$req[3]);
					$fecha=explode(",",$req[4]);
					$proveedor=explode(",",$req[5]);
					$aprueba=explode(",",$req[6]);
					?>
					<center>
					<table class="tab" align="center" border="1" >
					<tr>
					    <th colspan="7"><center>Requicisiones de Compra Aprobadas</center></th>
					</tr>
					<tr>
					    <th>Nombre</th>
					    <th>Cantidad</th>
					    <th>Costo Total</th>
					    <th>Fecha</th>
					    <th>Proveedor</th>
					    <th>Aprobada por..</th>
					    <th>Firma de Autorizacion</th>
					</tr>
					<?php
					if($idrq[0]!="")
					 for($i=0;$i<count($idrq);$i++){
					    ?>
						<tr>
						    <td><?php echo($nombre[$i]); ?></td>
						    <td><?php echo($cantidad[$i]); ?></td>
						    <td><?php echo("$".$costo[$i]); ?></td>
						    <td><?php echo($fecha[$i]); ?></td>
						    <td><?php echo($proveedor[$i]); ?></td>
						     <td><?php echo($aprueba[$i]); ?></td>
						     <td>_________________________________</td>
						</tr>
					    <?php
					 }
					?>
					<tr>
					    <th colspan="7">
						<center>
						    <a href="#" onclick="window.print();"><input type="button" class="button" value="Imprimir" /></a>
						</center>
						
					    </th>
					</tr>
					</table>
					</center>
					<?php
	    }
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