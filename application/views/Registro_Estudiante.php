<!DOCTYPE html>
<html> 
	<head>
		<title>Registro Estudiantes
		</title>
		<link rel="stylesheet" type="text/css" href="./../../css/specific_Css/styleRE.css" />
			<link rel="stylesheet" type="text/css" href="./../../css/bootstrap.css">
		<script language="javascript">
			<!--
			function cambiarimagen(){		
		    
					
			var a=document.form1.Icono.value;		
			
			document.images['avatar'].src=a;
			
			
			
		}
			
			//-->
		</script>
	</head>
	<body>	

	
	
	

	<header >
	  <img src="./../../imagenes/arcadialogo.png" class="img-responsive col-md-offset-4 " alt="Responsive image">	
		
	</header>	
    <div class="col-md-3">
    	
    </div>
	<div class="col-md-4 col-md-offset-1 form-registro">
	
		<form method="post" action="./../../index.php/Estudiante/registrarEstudiante" name="form1">
		<div class="form-group">
			<IMG id="avatar" name="avatar" src="./../../Imagenes/granjero1.jpg"> <br>
			<select id="Icono" name="Icono" onchange="cambiarimagen()">
			<?php

	if (isset($avatares)) {
		foreach ($avatares as $k){
			echo "<option value=".$k['o_imagen'].">".$k['name']."</option>";
			
				
			}
			
		}
		
	

	?>
			
				
			</select>
		</div>
		<div class="form-group">	
			
			<input type="text"class="form-control" name="UsuarioE" size="30" placeholder="DIGITE SU NICKNAME" required>


		</div>
		<div class="form-group">	
			
			<input type="text" name="nombreE" size="30" placeholder="DIGITE SU NOMBRE" class="form-control" required >
		</div>
		<div class="form-group">	
			
			<input type="text" name="ApellidoE" size="30" placeholder="DIGITE SU APELLIDO" class="form-control" required>
		</div>
		<div class="form-group">	
			<input type="text" name="InsEduE" size="30" placeholder="DIGITE SU INSTITUCION" class="form-control" required>
		</div>
		<div class="form-group">	
			
			<input type="text" name="GradActE" size="30" placeholder="DIGITE SU GRADO ACTUAL" class="form-control" required>
		</div>
		<div class="form-group">	
			
			<input type="tel" name="TelE" size="30" maxlength="10" placeholder="DIGITE SU TELEFONO"  class="form-control" required>
		</div>
		<div class="form-group">	
	
			<input type="email" name="TelE" size="30" maxlength="10" placeholder="EJEMPLO@DOMINIO.COM"  class="form-control" required>
		</div>
		<div class="form-group">	
			
			<select name="SexoE" class="form-control">
				<option value="1">Masculino</option>
				<option value="2">Femenino</option>
			</select>
		</div>
		<div class="form-group">	
			
			<input type="date" id="f_nacimiento"  class="form-control"name="f_nacimiento">
		</div>
		<div class="form-group">			
			
			<input type="password" name="ContrE" size="30" class="form-control" required placeholder="DIGITE SU CONTRASE&Ntilde;A">
		</div>
		<div class="form-group">	
			
			<input type="password" name="ConfContE" size="30"  class="form-control" placeholder="DIGITE SU CONTRASE&Ntilde;A" required>
		</div>	
      
      
     <input type="submit"  id="B1" name="B1" class="btn btn-success" value="Registrarse">
		
	</form>

	</div>
	
	
	

	</body>		
</html> 