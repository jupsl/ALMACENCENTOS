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
      
      
        <h1>Reporte Requicisiones de Compras</h1>
        <?php
       require_once('../BIN/controler.php');
       
					$db= new dbManager();
					$db->configuracion("general.php");
                                        $req=$db->getReqComprasR();
                                        $fechaa=explode(",",$req[0]);
                                        $fechap=explode(",",$req[1]);
                                        $art=explode(",",$req[2]);
                                        $cant=explode(",",$req[3]);
					$costo=explode(",",$req[4]);
					$ul=explode(",",$req[5]);
					$liberada=explode(",",$req[6]);
					$uc=explode(",",$req[7]);
                                        ?>
                                        <table class="tab" align="center" border="1" width="100%" style="background:#BDBDBD;">
                                            <tr>
                                                <th colspan="8">Reporte General De Salidas en el Almacen</th>
                                            </tr>
                                            <tr>
                                                <th>Fecha En la Que se Aprobo</th>
                                                <th>Fecha en la que se Creo la Requicision</th>
                                                <th>Articulo</th>
                                                <th>Cantidad</th>
						<th>Costo</th>
						<th>Usuario que Libero</th>
						<th>Liberada</th>
						<th>Usuario que Creo la Peticion</th>
                                                
                                            </tr>
                                            <?php
                                            if($art[0]!=""){
                                                for($i=0;$i<count($art);$i++){
                                                    ?>
                                                    <tr >
                                                        <td><?php echo($fechaa[$i]); ?></td>
                                                        <td> <?php echo($fechap[$i]); ?></td>
                                                        <td><?php echo($art[$i]); ?></td>
                                                        <td><?php echo($cant[$i]); ?></td>
							<td><?php echo("$".$costo[$i]); ?></td>
							<td><?php echo($ul[$i]); ?></td>
							<td><?php echo($liberada[$i]); ?></td>
							<td><?php echo($uc[$i]); ?></td>
                                                        
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <tr>
					    <th colspan="8">
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