<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Web Design - Free CSS Templates</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />

        <link href="/Arcadia/assets/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/Arcadia/assets/js/jquery-1.11.3.min.js"></script>
        <script src="/Arcadia/assets/js/bootstrap.js" type="text/javascript" charset="utf-8"></script>
        <script src="/Arcadia/assets/js/jcanvas.min.js" type="text/javascript" charset="utf-8"></script>


        <script type="text/javascript" charset="utf-8" async defer>

            $(document).ready(function () {
                var $myCanvas = $('#myCanvas');

               $myCanvas.addLayer({
                    type: 'image',
                    source: '/Arcadia/assets/imagenes/mapaArcadia.jpg',
                    x: 0, y: 0,
                    fromCenter: false,
                    width: 960,
                    height: 600


                }).addLayer({
                    layer:true,
                    type: 'image',
                    source: '/Arcadia/assets/imagenes/arcadialogo.png',
                    x: 50, y: 100,
                    fromCenter: false,
                    width: 150,
                    height: 70,
                    click: function(layer) {
                      alert("este es el logo");
                    }
                }).drawLayers();

            });


        </script>
    </head>
    <body style="background: #edecec;">

        <div class="container-fluid" style="background-image: url('/Arcadia/assets/imagenes/banner4.jpg');height: 450px;">
            <div class="container" >
              <div class="col-md-12" style="text-align: center;">
                <a href="#"><img src="/Arcadia/assets/imagenes/arcadialogo.png" alt="LOGO" /></a> 
              </div>
                
                <div class="col-md-12" style="padding-left:0px;">
                  <nav class="navbar navbar-inverse">
                    <div class="container-fluid" style="padding-left:0px;">
                        <div class="collapse navbar-collapse" style="padding-left:0px;" id="bs-example-navbar-collapse-9">
                            <ul class="nav navbar-nav"> 
                                <li class="active"><a href="#">Mapa</a></li>
                                <?php
                                  echo "<li><a href='/Arcadia/index.php/reino/obtenerReinoProfesorC?k_reino=".$_GET['k_reino']."'>Reino</a></li>";
                                ?>
                                
                                <li><a href="/Arcadia/index.php/profesor/inicioProfesor">Inicio</a></li> 
                                <li><a href="/Arcadia/index.php/profesor/perfilProfesorC">Perfil</a></li> </ul>
                        </div>
                      </div>
                    </nav>      

                    <canvas style="width: 100%" id="myCanvas" width="960" height="600" style="border:1px solid #000000; margin:0 auto;"></canvas>                             
                </div>           
            </div>        
        </div>                                        
       <!--Modal de actividades -->
         <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <div class="modal-content">
                    <form action="#" method ="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title">Actividades de Region</h3>
                        </div>

                        <div id="body_modal" class="modal-body">                  
                            <input type="hidden" value="" name="reinoIdModal" id="reinoIdModal">	                        
                            <div class="form-group">
                                <label for='codigo'>Codigo:</label>
                                <input type='text' id='codigo' name="codigo" class="form-control"   required>
                            </div>	                                   	                                    		          
                        </div>
                        <div id="modal_footer" class="modal-footer">
                            <input value="Cancelar" data-dismiss="modal" class="btn btn-danger">   
                            <input type="submit" value="Enviar Datos" id="btnSubmit" class="btn btn-success">             
                        </div>
                    </form> 
                </div>

            </div>
        </div>

    </body>
</html>