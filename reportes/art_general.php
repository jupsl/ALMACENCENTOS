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
      
      
        <h1>Reporte General de Articulos</h1>
        <?php
       require_once('../BIN/controler.php');
       
					$db= new dbManager();
					$db->configuracion("art_general.php");
                                        $art=$db->getProductos();
                                        $nombre=explode(",",$art[1]);
                                        $descripcion=explode(",",$art[2]);
                                        $prov1=explode(",",$art[3]);
					$precio1=explode(",",$art[4]);
					$prov2=explode(",",$art[5]);
					$precio2=explode(",",$art[6]);
					$prov3=explode(",",$art[7]);
					$precio3=explode(",",$art[8]);
					$code=explode(",",$art[9]);
                                        ?>
					<center>
                                        <table class="tab" align="center" border="1" width="100%" style="background:#BDBDBD;">
                                            <tr>
                                                <th colspan="10"><center>Reporte De Articulos</center></th>
                                            </tr>
                                            <tr>
						<th><center>Codigo</center></th>
                                                <th><center>Nombre</center></th>
                                                <th><center>Descripcion</center></th>
                                                <th><center>Proveedor1</center></th>
						<th><center>Precio Prov1</center></th>
						<th><center>Proveedor2</center></th>
						<th><center>Precio Prov2</center></th>
						<th><center>Proveedor3</center></th>
						<th><center>Precio Prov3</center></th>
						
                                            </tr>
                                            <?php
                                            if($nombre[0]!=""){
                                                for($i=0;$i<count($nombre);$i++){
                                                    ?>
                                                    <tr >
							
							<td><center><img
							    src="../barcode_img.php?num=<?php echo($code[$i]) ?>&type=code128&imgtype=png"
							    alt="PNG: <?php echo($num) ?>" title="PNG: <?php echo($num) ?>"></center></td>
                                                        <td><center><?php echo($nombre[$i]); ?></center></td>
                                                        <td><center><?php echo($descripcion[$i]); ?></center></td>
                                                        <td><center><?php echo($prov1[$i]); ?></center></td>
							<td><center><?php echo($precio1[$i]); ?></center></td>
							 <td><center><?php echo($prov2[$i]); ?></center></td>
							<td><center><?php echo($precio2[$i]); ?></center></td>
							 <td><center><?php echo($prov3[$i]); ?></center></td>
							<td><center><?php echo($precio3[$i]); ?></center></td>
                                                        
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <tr>
					    <th colspan="10">
						<center>
						    <a href="#" onclick="window.print();"><input type="button" class="button" value="Imprimir" /></a>
						</center>
						
					    </th>
					</tr>
                                        </table>
					</center>
	
	
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