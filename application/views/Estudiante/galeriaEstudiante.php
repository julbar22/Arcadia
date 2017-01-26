<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Web Design - Free CSS Templates</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />

        <link href="/Arcadia/assets/css/templatemo_style.css" rel="stylesheet" type="text/css" />
        <link href="/Arcadia/assets/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/Arcadia/assets/js/jquery-1.11.3.min.js"></script>
        <script src="/Arcadia/assets/js/bootstrap.js" type="text/javascript" charset="utf-8"></script>
        <script src="/Arcadia/assets/js/jcanvas.min.js" type="text/javascript" charset="utf-8"></script>
        <link rel="stylesheet" href="/Arcadia/assets/css/header-login-signup.css">

        <script type="text/javascript" charset="utf-8" async defer>

            function desplegar(menu) {

                $('#menu' + menu).toggle();

            }

            $(document).ready(function () {
                var $myCanvas = $('#myCanvas');

                $myCanvas.drawImage({
                    source: '/Arcadia/assets/imagenes/mapaArcadia2.jpg',
                    x: 0, y: 0,
                    fromCenter: false,
                    width: 600,
                    height: 500
                });
            });


        </script>
    </head>
    <body>


        <div id="templatemo_body_wrapper">
            <div id="templatemo_wrapper">

                <div id="tempaltemo_header">
                    <div id="header_content">
                        <div id="site_title">

                        </div>
                    </div>
                </div> <!-- end of header -->
                <div id="templatemo_main_top-2"></div>
                <div id="templatemo_main_top">
                    <a href="#"><img src="/Arcadia/assets/imagenes/arcadialogo.png" alt="LOGO" /></a>
                </div>
                <div id="templatemo_main" >
                    <span id="main_top"></span><span id="main_bottom"></span>

                    <div id="templatemo_sidebar">

                        <div id="templatemo_menu">
                            <h3><center>Menu</center></h3>
                            <ul>
                                <li><a href="/Arcadia/index.php/estudiante/inicioEstudiante">Inicio<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true" style="float: right;" ></a></li>
                                <li><a onclick="desplegar('Notas');">Mis Notas<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true" style="float: right;" ></span></a>

                                </li>
                                <ul class="menuhijos" id="menuNotas">
                                  <?php
                                  if (isset($perfilR)) {
                                      echo "<li><a href='/Arcadia/index.php/reino/notasRegionEst?k_reino=".$perfilR[0]['k_reino']. "' ><span class='glyphicon glyphicon-pawn' aria-hidden='true'></span> Mostrar</a></a></li>";
                                  }
                                  ?>
                                    <li><a href="#"><span class="glyphicon glyphicon-pawn" aria-hidden="true"></span> Estadistica</a></li>
                                </ul>
                                <li><a  onclick="desplegar('Actividades');">Mis Misiones<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true" style="float: right;" ></a></li>
                                <ul class="menuhijos" id="menuActividades">
                                    <?php
                                    if (isset($perfilR)) {
                                        echo "<li><a href='/Arcadia/index.php/reino/actividadesRegionEst?k_reino=".$perfilR[0]['k_reino']. "' ><span class='glyphicon glyphicon-pawn' aria-hidden='true'></span> Misiones por Región</a></a></li>";
                                    }
                                    ?>
                                </ul>
                                <li><a href="/Arcadia/index.php/welcome/index">Salir<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true" style="float: right;" ></a></li>
                            </ul>
                        </div> <!-- end of templatemo_menu -->

                        <?php
                        if(isset($novedades)){
                          echo "<div class='sidebar_box'>";
                              echo "<div class='sb_title'>Novedades</div>";
                              echo "<div class='sb_content'>";
                              for($i=0; $i<count($novedades);$i++){
                                echo "<div class='sb_news_box'>";
                                  echo  "<a>".$novedades[$i]['novedad']."</a>";
                                  echo  "<span>".$novedades[$i]['fecha']."</span>";
                                echo "</div>";
                              }
                              echo "</div>";
                          echo "</div>";
                        }
                        ?>

                        <div class="cleaner"></div>
                    </div> <!-- end of sidebar -->

                    <div id="templatemo_content">
                        <div class="content_box last_box">
                        <?php
                        echo "<a align='center' href='/Arcadia/index.php/reino/obtenerReinoEstudianteC?k_reino=".$_GET['k_reino']."'><input align='center' type='submit' value='Volver' id='btnSubmit' class='btn btn-info'></a>";
                        echo "<h1 class='titulo_pagina'><center> <img src='/Arcadia/assets/imagenes/arcadiaIcon14.png' alt='LOGO' /> Galeria <img src='/Arcadia/assets/imagenes/arcadiaIcon14.png' alt='LOGO' /></center></h1></br>";
                        if(isset($galeria)){
                          echo "<center><div id='gallery'>";
                            echo "<h2><img src='/Arcadia/assets/imagenes/arcadiaIcon4.png' alt='LOGO' /> Videos <img src='/Arcadia/assets/imagenes/arcadiaIcon4.png' alt='LOGO' /></h2>";
                           if($galeria['videos'] != null){
                               for($i = 0; $i < count($galeria['videos']); $i++){
                                 echo "<iframe src='".$galeria['videos'][$i]."' width='560' height='315' frameborder='0' allowfullscreen></iframe></br></br>";
                               }
                           }
                            if($galeria['imagenes'] != null){
                              echo "<h2><img src='/Arcadia/assets/imagenes/arcadiaIcon4.png' alt='LOGO' /> Imagenes <img src='/Arcadia/assets/imagenes/arcadiaIcon4.png' alt='LOGO' /></h2>";
                              echo "<div class='cleaner h20'></div>";
                              for($i = 1; $i <= count($galeria['imagenes']); $i++){
                                echo "<a href='".$galeria['imagenes'][$i-1]."' ><img height=123 width=154 src='".$galeria['imagenes'][$i-1]."'></a>";
                                if($i%3 == 0){
                                  echo "<div class='cleaner h20'></div>";
                                }
                              }
                            }
                            if($galeria['documentos'] != null){
                              echo "<div class='cleaner h20'></div>";
                              echo "<h2><img src='/Arcadia/assets/imagenes/arcadiaIcon4.png' alt='LOGO' / > Documentos <img src='/Arcadia/assets/imagenes/arcadiaIcon4.png' alt='LOGO' /></h2>";
                              echo "<div class='cleaner h20'></div>";
                              for($i = 1; $i <= count($galeria['documentos']); $i++){
                                echo "<a href='".$galeria['documentos'][$i-1]."' ><img height=123 width=154 src='/Arcadia/assets/imagenes/images/gallery/docIcon.png'></a>";
                                if($i%3 == 0){
                                  echo "<div class='cleaner h20'></div>";
                                }
                            }
                            echo "<div class='cleaner h20'></div>";
                          }
                          echo "</div>";
                          echo "</div>";
                          echo "</center>";
                        }
                        ?>
                    </div>

                    <div class="cleaner"></div>
                </div>

                <div id="templatemo_main_bottom">
                </div>

            </div> <!-- end of wrapper -->
        </div>

        <div id="templatemo_footer_wrapper">
            <div id="templatemo_footer">
                Reinos

            </div>
        </div>
        <!-- templatemo 243 web design -->
        <!--
        Web Design Template
        http://www.templatemo.com/preview/templatemo_243_web_design
        -->

    </body>
</html>
