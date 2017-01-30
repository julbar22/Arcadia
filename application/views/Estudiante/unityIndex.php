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
                        <li><a href="/Arcadia/index.php/estudiante/inicioEstudiante">Inicio</a></li>						
                        <li><a href="/Arcadia/index.php/estudiante/perfilEstudianteC">Perfil</a></li>
                        <?php
                        echo "<li><a href='/Arcadia/index.php/reino/obtenerReinoEstudianteC?k_reino=".$_GET['k_reino']."'>Reino</a></li>"
                        ?>
                        <li><a href="/Arcadia/index.php/welcome/index">Salir</a></li>
                    </ul>
                </nav>

            </div>
        </div>      

        <div id="featured" style="padding-top: 5px; padding-bottom: 0px;" >           
                <!-- 16:9 aspect ratio -->
            <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="/Arcadia/Unity/index.html?k_actividad=5"></iframe>
            </div>

        </div>
        <div id="marketing">
            <h2 id="Creditos">Cuestionario</h2>	
            <div class="container">



            </div>	
        </div>


    </body>
</html>