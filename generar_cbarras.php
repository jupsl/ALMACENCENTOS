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
      
      
        <h1>Generar etiquetas de Codigo de Barras</h1>
        <?php
       require_once('../BIN/controler.php');
       
					$db= new dbManager();
					$db->configuracion("generar_cbarras.php");
                                        $almacen=$db->getAlmacen();
                                        $nombre=explode(",",$almacen[0]);
                                        $disponible=explode(",",$almacen[1]);
                                        $prov1=explode(",",$almacen[2]);
                                        $prov2=explode(",",$almacen[3]);
                                        $prov3=explode(",",$almacen[4]);
					$cods=explode(",",$almacen[5]);
                                        ?>
                                        <table class="tab" align="center" border="1" width="100%" style="background:#BDBDBD;">
                                            <tr>
                                                <th colspan="6">Reporte De Productos existentes en el almacen</th>
                                            </tr>
                                            <tr>
						<th>Codigo</th>
                                                <th>Nombre del Producto</th>
                                                <th>Cantidad Disponible</th>
                                                <th>Proveedor 1</th>
                                                <th>Proveedor 2</th>
                                                <th>Proveedor 3</th>
                                            </tr>
                                            <?php
                                            if($nombre[0]!=""){
                                                for($i=0;$i<count($nombre);$i++){
                                                    ?>
                                                    <tr >
							<td <?php if($disponible[$i]=="0") { echo("style='background-color:red;'"); } ?> ><center><img
							    src="../barcode_img.php?num=<?php echo($cods[$i]); ?>&type=code128&imgtype=png"
							    alt="PNG: <?php echo($cods[$i]);?>" title="PNG: <?php echo($cods[$i]); ?>"/></center></td>
                                                        <td <?php if($disponible[$i]=="0") { echo("style='background-color:red;'"); } ?> ><?php echo($nombre[$i]); ?></td>
                                                        <td <?php if($disponible[$i]=="0") { echo("style='background-color:red;'"); } ?> ><?php echo($disponible[$i]); ?></td>
                                                        <td <?php if($disponible[$i]=="0") { echo("style='background-color:red;'"); } ?> ><?php echo($prov1[$i]); ?></td>
                                                        <td <?php if($disponible[$i]=="0") { echo("style='background-color:red;'"); } ?> ><?php echo($prov2[$i]); ?></td>
                                                        <td <?php if($disponible[$i]=="0") { echo("style='background-color:red;'"); } ?> ><?php echo($prov3[$i]); ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <tr>
					    <th colspan="6">
						<center>
						    <a href="#" onclick="window.print();"><input type="button" class="button" value="Imprimir" /></a>
						</center>
						
					    </th>
					</tr>
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