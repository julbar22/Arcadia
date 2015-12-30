<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>Document</title>
</head>
<body style="background-image: url(imagenes/Logo_UD.png); background-repeat:no-repeat">

<div class="container" style="margin-top:15%">
 
<form class="form-horizontal" style="width:30%;margin-left:50%" action="http://localhost/CodeIgniter/index.php/ingreso/recibirdatos">
	
 
 
  
 
  <h1>LOGIN</h1>
  
  

  <div class="form-group" >
    <label for="inputCodigo" class="col-sm-1 control-label">Codigo</label>
    <div class="col-sm-12">
      <input type="text" class="form-control" id="inputCodigo" placeholder="Codigo">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPass" class="col-sm-1 control-label">Password</label>
    <div class="col-sm-12">
      <input type="password" class="form-control" id="inputPass" placeholder="Password">
    </div>
  </div>
 
  <div class="form-group">
    <div class="col-sm-3">
      <button type="submit" class="btn btn-success">Entrar</button>

    </div>
    <div class="col-sm-2">
      <button type="submit" class="btn btn-info">Registrarse</button>

    </div>
    
  </div>
  
</form>
	
    
	<script src="js/jquery-1.11.3.min.js" ></script> 
     <script src="js/bootstrap.js"></script> 
</body>
</html>

