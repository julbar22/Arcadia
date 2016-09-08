<!DOCTYPE html>
<html> 
	<head>
		<title>Registro Estudiantes
		</title>
		<link rel="stylesheet" type="text/css" href="/Arcadia/assets/css/specific_Css/styleRE.css" />
			<link rel="stylesheet" type="text/css" href="/Arcadia/assets/css/bootstrap.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="/Arcadia/assets/js/jsfuntions/server.js" type="text/javascript" charset="utf-8" async defer></script>	
		<script type="text/javascript" charset="utf-8" async defer>
		function loquesea(json){
		
         var result = [];
		 var keys = Object.keys(json);
		 keys.forEach(function(key){
		 result.push(json[key]);
		});
		 alert(result);
		   document.getElementById('Iconovalue').value=result[0];
		   document.getElementById('avatar').src=result[0];
	       document.getElementById('UsuarioE').value=result[1];
	       document.getElementById('nombreE').value=result[2];
	       document.getElementById('ApellidoE').value=result[3];
	       document.getElementById('InsEduE').value=result[4];
	       document.getElementById('GradActE').value=result[5];
	       document.getElementById('TelE').value=result[6];
	       document.getElementById('correoE').value=result[7];
	       document.getElementById('SexoE').value=result[8];
	       document.getElementById('f_nacimiento').value=result[9];
	       document.getElementById('ContrE').value=result[10];
	       document.getElementById('ConfContE').value=result[11];
	       
	      
	       //arreglo['documento'];

}
		</script>
	</head>
	<body>	

	
	
	

	<header >
	  <img src="/Arcadia/assets/imagenes/arcadialogo.png" class="img-responsive col-md-offset-4 " alt="Responsive image">	
		
	</header>	
    <div class="col-md-3">
    	
    </div>
	<div class="col-md-8 col-md-offset-2 form-registro">
		<form method="post" name="form1">

		<div class="col-md-5">
			<div class="form-group">
				<IMG id="avatar" name="avatar" src="/Arcadia/assets/Imagenes/granjero1.jpg" class="img-responsive"> <br>
				<select class="form-control" id="Icono" name="Icono" onchange="cambiarimagen()">
				<?php

					if (isset($avatares)) {
						foreach ($avatares as $k){
							echo "<option value=".$k['o_imagen'].">".$k['n_nombre']."</option>";		
					
						}			
					}	
				?>
			<option  id="Iconovalue" value=""></option>
				
			</select>
		</div>
		</div>
		<div class="col-md-6">
		

			<div class="form-group">	
				
				<input type="text"class="form-control" id="UsuarioE" name="UsuarioE"  placeholder="DIGITE SU NICKNAME" required>


			</div>
			<div class="form-group">	
				
				<input type="text" id="nombreE" name="nombreE" placeholder="DIGITE SU NOMBRE" class="form-control" required >
			</div>
			<div class="form-group">	
				
				<input type="text" id="ApellidoE" name="ApellidoE"  placeholder="DIGITE SU APELLIDO" class="form-control" required>
			</div>
			<div class="form-group">	
				<input type="text" id="InsEduE" name="InsEduE"  placeholder="DIGITE SU INSTITUCION" class="form-control" required>
			</div>
			<div class="form-group">	
				
				<input type="number" id="GradActE" name="GradActE" placeholder="DIGITE SU GRADO ACTUAL" class="form-control" required>
			</div>
			<div class="form-group">	
				
				<input type="tel" id="TelE" name="TelE"  placeholder="DIGITE SU TELEFONO"  class="form-control" required>
			</div>
			<div class="form-group">	
		
				<input type="email" id="correoE" name="correoE"  placeholder="EJEMPLO@DOMINIO.COM"  class="form-control" required>
			</div>
			<div class="form-group">	
				
				<select id="SexoE"  name="SexoE" class="form-control">
					<option value="M">M</option>
					<option value="F">F</option>
				</select>
			</div>
			<div class="form-group">	
				
				<input type="date" id="f_nacimiento"  class="form-control" name="f_nacimiento">
			</div>
			<div class="form-group">			
				
				<input type="password" id="ContrE"  name="ContrE"  class="form-control" required placeholder="DIGITE SU CONTRASE&Ntilde;A">
			</div>
			<div class="form-group">	
				
				<input type="password" id="ConfContE" name="ConfContE"   class="form-control" placeholder="DIGITE SU CONTRASE&Ntilde;A" required>
			</div>	
	      
	      
			<input type="submit" class="btn btn-success" onclick = "this.form.action = 'http://localhost/Arcadia/index.php/Estudiante/registrarEstudiante'" value="Registrarse" />
			<a href="http://localhost/Arcadia/index.php/Welcome/index" ><input type="button" class="btn btn-info" value="Cancelar" /></a>
			
			
				
		</div>

		</form>	
	</div>
	
	
	

	</body>		
</html> 

<?php
	         if (isset($estudiante)) {				
				echo "<script>loquesea(".json_encode($estudiante).");</script>";		
               // echo "<script>profesor();</script>";	
				
			}
	         ?>