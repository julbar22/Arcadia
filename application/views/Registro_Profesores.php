<!DOCTYPE html>
<html> 
	<head>
		<title>Registro Estudiantes
		</title>
	    <link rel="stylesheet" type="text/css" href="http://localhost/Arcadia/css/specific_Css/styleRE.css" />
		<link rel="stylesheet" type="text/css" href="http://localhost/Arcadia/css/bootstrap.css">
		<script src="http://localhost/Arcadia/js/jsfuntions/server.js" type="text/javascript" charset="utf-8" async defer></script>		
		<script type="text/javascript" charset="utf-8" async defer>
		function loquesea(json){
		
         var result = [];
		 var keys = Object.keys(json);
		 keys.forEach(function(key){
		 result.push(json[key]);
		});
		 alert(result);
		   document.getElementById('Icono').value=result[0];
		   document.getElementById('avatar').src=result[0];
	       document.getElementById('documento').value=result[1];
	       document.getElementById('UsuarioE').value=result[2];
	       document.getElementById('nombreE').value=result[3];
	       document.getElementById('ApellidoE').value=result[4];
	       document.getElementById('InsEduE').value=result[5];
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
	  <img src="http://localhost/Arcadia/Imagenes/arcadialogo.png" class="img-responsive col-md-offset-4 " alt="Responsive image">	
		
	</header>	
    <div class="col-md-3">
    	
    </div>
	<div class="col-md-4 col-md-offset-1 form-registro">
	
		<form method="post" action="http://localhost/Arcadia/index.php/Profesor/registrarProfesor" name="form1">
		<div class="form-group">
			<IMG id="avatar" name="avatar" src="http://localhost/Arcadia/Imagenes/granjero1.jpg"> <br>
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
			
			<input type="text"class="form-control" id="documento" name="documento" size="30" placeholder="DIGITE SU DOCUMENTO" required >


		</div>
		<div class="form-group">	
			
			<input type="text"class="form-control" id="UsuarioE" name="UsuarioE" size="30" placeholder="DIGITE SU NICKNAME" required>


		</div>
		<div class="form-group">	
			
			<input type="text" id="nombreE" name="nombreE" size="30" placeholder="DIGITE SU NOMBRE" class="form-control" required >
		</div>
		<div class="form-group">	
			
			<input type="text" id="ApellidoE" name="ApellidoE" size="30" placeholder="DIGITE SU APELLIDO" class="form-control" required>
		</div>
		<div class="form-group">	
			<input type="text" id="InsEduE" name="InsEduE" size="30" placeholder="DIGITE SU INSTITUCION" class="form-control" required>
		</div>
		
		<div class="form-group">	
			
			<input type="tel" id="TelE" name="TelE" size="30" maxlength="10" placeholder="DIGITE SU TELEFONO"  class="form-control" required>
		</div>
		<div class="form-group">	
	
			<input type="email" id="correoE" name="correoE" size="30" maxlength="10" placeholder="EJEMPLO@DOMINIO.COM"  class="form-control" required>
		</div>
		<div class="form-group">	
			
			<select id="SexoE" name="SexoE" class="form-control">
				<option value="1">Masculino</option>
				<option value="2">Femenino</option>
			</select>
		</div>
		<div class="form-group">	
			
			<input type="date" id="f_nacimiento"  class="form-control"name="f_nacimiento">
		</div>
		<div class="form-group">			
			
			<input type="password" id="ContrE" name="ContrE" size="30" class="form-control" required placeholder="DIGITE SU CONTRASE&Ntilde;A">
		</div>
		<div class="form-group">	
			
			<input type="password" id="ConfContE" name="ConfContE" size="30"  class="form-control" placeholder="DIGITE SU CONTRASE&Ntilde;A" required>
		</div>	
      
      
     <input type="submit"  id="B1" name="B1" class="btn btn-success" value="Registrarse">
		
	</form>

	</div>
	
	
	
	
	</body>		
</html> 
<?php
	         if (isset($profesor)) {				
				echo "<script>loquesea(".json_encode($profesor).");</script>";		
               // echo "<script>profesor();</script>";	
				
			}
	         ?>