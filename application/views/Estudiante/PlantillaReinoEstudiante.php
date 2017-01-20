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


        <script type="text/javascript" charset="utf-8" async defer>

            function desplegar(menu) {

                $('#menu' + menu).toggle();

            }

            $(document).ready(function () {
                var $myCanvas = $('#myCanvas');

                $myCanvas.drawImage({
                    source: '/Arcadia/assets/imagenes/mapaArcadia.jpg',
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


                        <div class="sidebar_box">
                            <div class="sb_title">Novedades</div>
                            <div class="sb_content">

                                <div class="sb_news_box">
                                    <a href="#">Maecenas adipiscing elem sum ipsum.</a>
                                    <span>25 September 2048</span>
                                </div>

                                <div class="sb_news_box">
                                    <a href="#">Aser ecenas adipiscing de lorem ipsum.</a>
                                    <span>18 September 2048</span>
                                </div>

                                <a href="#"><strong>View All</strong></a>
                            </div>

                            <div class="sb_bottom"></div>

                        </div>


                        <div class="cleaner"></div>
                    </div> <!-- end of sidebar -->

                    <div id="templatemo_content">

                        <div class="content_box">
                            <?php
                           if (isset($perfilR)) {
                                echo "<h2 class='titulo_pagina'>" . $perfilR[0]['n_nombre'] . "</h2>";
                            }
                            ?>
                            <canvas id="myCanvas" width="600" height="500" style="border:1px solid #000000;"></canvas>
                        </div>

                        <div class="content_box">

                            <div class="col_w290 float_l">

                                <h2 class="title_icon why_choose_us">Historia</h2>
                                <?php
                               if (isset($perfilR)) {
                                    echo "<p>" . $perfilR[0]['n_historia'] . "</p>";
                                }
                                ?>
                            </div>

                            <div class="col_w290 cw290_last float_r">

                                <h2 class="title_icon new_services">Misión</h2>
                                <?php
                               if (isset($perfilR)) {
                                    echo "<p>" . $perfilR[0]['n_mision'] . "</p>";
                                }
                                ?>
                                <h2 class="title_icon new_services">Visión</h2>
                                <?php
                               if (isset($perfilR)) {
                                    echo "<p>" . $perfilR[0]['n_vision'] . "</p>";
                                }
                                ?>
                            </div>

                            <div class="cleaner"></div>
                        </div>

                        <div class="content_box last_box">
                            <h2>Galeria</h2>

                            <div id="gallery">
                                <a href="/Arcadia/assets/imagenes/images/gallery/image_01_b.jpg" class="pirobox" title="Project 1"><img src="/Arcadia/assets/imagenes/images/gallery/image_01.jpg" alt="1" /></a>
                                <a href="images/gallery/image_02_b.jpg" class="pirobox" title="Project 2"><img src="/Arcadia/assets/imagenes/images/gallery/image_02.jpg" alt="2" /></a>
                                <a href="images/gallery/image_03_b.jpg" class="pirobox" title="Project 3"><img src="/Arcadia/assets/imagenes/images/gallery/image_03.jpg" alt="3" /></a>
                            </div> <!-- end of Gallery -->

                            <div class="cleaner h20"></div>
                            <a href="#"><strong>Mirar Galeria</strong></a></div>

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
