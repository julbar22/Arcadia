<!DOCTYPE HTML>
<!--
	Autonomy by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>ARCADIA ESTUDIANTES</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
	    <link rel="stylesheet" href="/Arcadia/assets/css/bootstrap.css" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>	
		<script src="/Arcadia/assets/js/bootstrap.js" type="text/javascript" charset="utf-8"></script>
		
		
			<link rel="stylesheet" href="/Arcadia/assets/css/skel-noscript.css" />
			<link rel="stylesheet" href="/Arcadia/assets/css/style.css" />
			<link rel="stylesheet" href="/Arcadia/assets/css/style-desktop.css" />
			<link rel="stylesheet" type="text/css" href="/Arcadia/assets/css/specific_Css/style.css">


	</head>
	<body>

	
		<div id="header">
			<div class="container">				
				<div id="logo">
					<a href="#"><img src="/Arcadia/assets/imagenes/arcadialogo2.png" alt=""></a>
				</div>

				<!-- Nav -->
				<nav id="nav">
					<ul>
						<li><a href="/Arcadia/index.php/profesor/inicioProfesor">Inicio</a></li>						
						<li  class="active"><a href="#">Perfil</a></li>
						<li><a href="/Arcadia/index.php/welcome/index">Salir</a></li>
					</ul>
				</nav>

			</div>
		</div>

		<div id="banner">&nbsp;</div>

		<div id="featured">
			<div class="container">	
			<h1 class="titulo_pagina">NOMBRE DE USUARIO</h1>
				<div class="row">
					<div class="col-md-5">
						<img src="/Arcadia/assets/imagenes/perfil1.jpg" alt="imagenPerfil" class="img-responsive">
					</div>
					<div class="col-md-7">
							<div class="panel panel-default">
  								<div class="panel-heading">
   							 		<h3 class="panel-title" style="font-size: 20px;font-weight: 600;text-align: center;">Información de Perfil</h3>
  								</div>
  								<div class="panel-body">
  									<img src="/Arcadia/assets/imagenes/worldofarcadialogog.png" alt="worldofarcadialogo" class="img-responsive"
  									  style="margin: auto; padding-bottom: 20px;">
    								<div class="input-group">
  										<span class="input-group-addon" id="basic-addon1">Nombre</span>
									    <input type="text" class="form-control" aria-describedby="basic-addon1" disabled="true">
									</div>
									<br>
									<div class="input-group">
  										<span class="input-group-addon" id="basic-addon1">Apellido</span>
									    <input type="text" class="form-control" aria-describedby="basic-addon1" disabled="true">
									</div>
									<br>
									<div class="input-group">
  										<span class="input-group-addon" id="basic-addon1">Correo</span>
									    <input type="text" class="form-control" aria-describedby="basic-addon1">
									</div>
									<br>
									<div class="input-group">
  										<span class="input-group-addon" id="basic-addon1">Telefono </span>
									    <input type="text" class="form-control" aria-describedby="basic-addon1">
									</div>
									<br>
									<div class="input-group">
  										<span size="50" class="input-group-addon" id="basic-addon1">Colegio       :</span>
									    <input type="text" class="form-control" aria-describedby="basic-addon1">
									</div>
									<br>
									<div class="input-group">
  										<span class="input-group-addon" id="basic-addon1">Grado Actual</span>
									    <input type="text" class="form-control" aria-describedby="basic-addon1">
									</div>
  								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
		<div id="marketing">
		<h2 id="Creditos">Mis Reinos</h2>	
		   <br>	
			<div class="container">
			    
				<?php
					if (isset($reinos)) {						
						$j=0;
                        for($i=0; $i<count($reinos)/4;$i++){
                        	echo "<div class='row'>";
                             for($h=0;$h<4;$h++){
                             	if($j<count($reinos)){
                             		$a=$reinos[$j]['k_reino'];                             		
	                                echo "<div class='3u'>";
	                                echo "<form method='post' action='/Arcadia/index.php/reino/obtenerReinoProfesorC' >";
									echo "<section>";
									echo "<input name='k_reino' id='k_reino' type='hidden' value=".$reinos[$j]['k_reino']."> ";
									echo "<a class='image full'><img src=".$reinos[$j]['o_imagen']." alt='' ></a>";
									echo "<header>";
									echo "<h2>".$reinos[$j]['n_nombre']."</h2>";
									echo "</header>";
									echo "<p>Fecha de creacion: ".$reinos[$j]['f_creacion']."</p>";	
									echo "<input type='submit' value='Ir al reino' id='btnReino' class='btn btn-primary'>";	
									echo "</section>";
									echo "</form>";	
								    echo "</div>";								    
								    $j++;
                             	}
                                
                             }
                             echo "</div>";

                        }

						}	
				?>
				
			</div>
		</div>


	</body>
</html>