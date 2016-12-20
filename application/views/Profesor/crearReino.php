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
        <script>

            function modalWindows(imagenUrl, imagenId) {
                $('#myModal').modal('show');
                document.getElementById("imagenModal").value = imagenUrl;
                document.getElementById("imagenModalId").value = imagenId;

            }
        </script>

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
                        <li><a href="/Arcadia/index.php/profesor/perfilProfesorC">Perfil</a></li>
                        <li><a href="/Arcadia/index.php/welcome/index">Salir</a></li>
                    </ul>
                </nav>

            </div>
        </div>

        <div id="banner">&nbsp;</div>

        <div id="featured">
            <div class="container">

                <?php
                if (isset($reinos)) {
                    $j = 0;
                    for ($i = 0; $i < count($reinos) / 4; $i++) {
                        echo "<div class='row'>";
                        for ($h = 0; $h < 4; $h++) {
                            if ($j < count($reinos)) {
                                $a = $reinos[$j]['o_imagen'];
                                echo "<div class='3u'>";
                                echo "<section>";
                                echo "<a href='#' class='image full'><img src=" . $reinos[$j]['o_imagen'] . " alt='' onClick=\"modalWindows('" . $a . "'," . $reinos[$j]['k_imagen_reino'] . ")\"></a>";
                                echo "<header>";
                                echo "<h2>" . $reinos[$j]['n_nombre'] . "</h2>";
                                echo "</header>";
                                echo "<p>" . $reinos[$j]['n_historia'] . "</p>";
                                echo "</section>";
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
        <div id="marketing">
            <h2 id="Creditos">Reinos de Arcadia</h2>		
        </div>

        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <form action="/Arcadia/index.php/reino/crearReinoC" method ="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title">Crea tu Reino</h3>
                        </div>
                        <div id="body_modal" class="modal-body">

                            <input type="hidden" value="" id="idReino">                            
                            <div class="form-group">
                                <label for='nombre' >Nombre:</label>
                                <input type='text' id='nombre' name="nombre" class="form-control"  required>
                            </div>
                            <div class="form-group">
                                <label for='codigo'>Codigo:</label>
                                <input type='text' id='codigo' name="codigo" class="form-control"   required>
                            </div>
                            <div class="form-group">
                                <label for='historia'>Historia:</label>
                                <textarea id='historia' name="historia"  class="form-control" required></textarea> 
                            </div>
                            <div class="form-group">
                                <label for='mision'>Mision:</label>
                                <textarea id='mision' name="mision" class="form-control" required></textarea> 
                            </div>  
                            <div class="form-group">
                                <label for='vision'>Vision:</label>
                                <textarea id='vision' name="vision" class="form-control" required></textarea> 
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