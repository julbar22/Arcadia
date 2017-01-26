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
          function mostrarInput(){
            $( '#btnNovedad' ).show();
            $( '#novedad' ).show();
          }
        </script>

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
                    height: 500,

                });

                $('#myCanvas').click(function(e){
                     window.location.href = "/Arcadia/index.php/reino/mapaActividadesProfesorC?k_reino="+$('#idReino').val();

            })

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
                                <li><a onclick="desplegar('Inicio');">Inicio<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true" style="float: right;" ></a></li>
                                    <ul class="menuhijos" id="menuInicio">
                                        <li><a href="/Arcadia/index.php/profesor/inicioProfesor"><span class="glyphicon glyphicon-pawn" aria-hidden="true"></span> Inicio</a></li>
                                        <li><a href="/Arcadia/index.php/profesor/perfilProfesorC"><span class="glyphicon glyphicon-pawn" aria-hidden="true"></span> Perfil</a></li>
                                    </ul>
                                <li><a onclick="desplegar('Notas');"> Notas<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true" style="float: right;" ></span></a>

                                </li>
                                <ul class="menuhijos" id="menuNotas">
                                    <?php
                                        if (isset($perfilR)){
                                            echo "<li><a href='/Arcadia/index.php/reino/notasTotales?k_reino=".$perfilR[0]['k_reino']. "' ><span class='glyphicon glyphicon-pawn' aria-hidden='true'></span> Notas</a></li>";
                                        }
                                    ?>
                                    <li><a href="#"><span class="glyphicon glyphicon-pawn" aria-hidden="true"></span> Estadistica</a></li>
                                </ul>
                                <li><a  onclick="desplegar('Actividades');"> Misiones<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true" style="float: right;" ></a></li>
                                <ul class="menuhijos" id="menuActividades">
                                    <?php
                                    if (isset($perfilR)) {
                                        echo "<li><a href='/Arcadia/index.php/reino/actividadesRegion?k_reino=".$perfilR[0]['k_reino']. "' ><span class='glyphicon glyphicon-pawn' aria-hidden='true'></span> Misiones Por Region</a></li>";
                                        echo "<li><a href='/Arcadia/index.php/reino/listaEstudiantesReino?k_reino=".$perfilR[0]['k_reino']. "' ><span class='glyphicon glyphicon-pawn' aria-hidden='true'></span> Misiones Por Estudiante</a></li>";
                                        echo "<li><a href='/Arcadia/index.php/pregunta/listadoPreguntasC?k_reino=".$perfilR[0]['k_reino']. "' ><span class='glyphicon glyphicon-pawn' aria-hidden='true'></span> Listado de Preguntas</a></li>";
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
                              echo"<form method='post'>";
                                echo "<div class='form-group'>";
                                  echo "<textarea class='form-control' name='novedad' id='novedad' cols='50' rows='6' style='display:none;'>Ingresa la novedad. Máximo 300 caracteres.</textarea>";
                                  echo "<br />";
                                  echo "<input type='submit' value='Enviar' style='display:none;' nombre='btnNovedad' id='btnNovedad' class='btn btn-success' onclick = \"this.form.action = 'http://localhost/Arcadia/index.php/Reino/crearNovedad?k_reino=".$_GET['k_reino']."' \">";
                                echo "</div>";
                              echo "</form>";
                              echo "<input type='submit' value='Añadir' onclick = 'mostrarInput()' id='btnSubmit' class='btn btn-info'>";
                              echo "<div class='sb_bottom'></div>";                              
                              echo "</div>";
                          echo "</div>";
                        }
                        ?>

                    <div class="cleaner"></div>
                    </div> <!-- end of sidebar -->

                    <div id="templatemo_content">

                        <div class="content_box">
                          <?php
                         if (isset($perfilR)) {
                              echo "<h1 class='titulo_pagina'><center> <img src='/Arcadia/assets/imagenes/arcadiaIcon14.png' alt='LOGO' /> Bienvenido al Reino " . $perfilR[0]['n_nombre'] . " <img src='/Arcadia/assets/imagenes/arcadiaIcon14.png' alt='LOGO' /></center></h1></br>";
                              echo "<h3><img src='/Arcadia/assets/imagenes/arcadiaIcon4.png' alt='LOGO' /> Mapa : Clic en el mapa para mas opciones</h3></br>";
                          }
                          ?>
                          <canvas id="myCanvas" width="600" height="500" style="border:1px solid #000000;"></canvas>
                        </div>

                        <div class="content_box last_box">

                          <h2><img src='/Arcadia/assets/imagenes/arcadiaIcon4.png' alt='LOGO' />Galeria</h2>
                              <?php
                                if(isset($galeria)){
                                   echo "<div id='gallery'>";
                                   if($galeria['videos'] != null){
                                        for($i = 0; $i < count($galeria['videos']) AND $i < 1; $i++){
                                          echo "<iframe src='".$galeria['videos'][$i]."' width='560' height='315' frameborder='0' allowfullscreen></iframe></br></br>";
                                        }
                                    }
                                    if($galeria['imagenes'] != null){
                                        for($i = 0; $i < count($galeria['imagenes']) AND $i < 3; $i++){
                                          echo "<a href='".$galeria['imagenes'][$i]."' ><img height=123 width=154 src='".$galeria['imagenes'][$i]."'></a>";
                                        }
                                        echo "<div class='cleaner h20'></div>";
                                    }
                                    if($galeria['documentos'] != null){
                                        for($i = 0; $i < count($galeria['documentos']) AND $i < 3; $i++){
                                            echo "<a href='".$galeria['documentos'][$i]."' ><img height=123 width=154 src='/Arcadia/assets/imagenes/images/gallery/docIcon.png'></a>";
                                        }
                                        echo "<div class='cleaner h20'></div>";
                                    }
                                    echo "</div>";
                                    echo "<a href='/Arcadia/index.php/reino/cargarGaleriaProfesor?k_reino=".$perfilR[0]['k_reino']."'><strong>Mirar Galeria</strong></a></div>";
                                }
                              ?>
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
