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
        <style>
            .form-control {padding:0px;}
            .labelLeft {padding-left:0px;
                        padding-right:0px;}
        </style>
        <script type="text/javascript" charset="utf-8" async defer>
            function tipoActividad(tipo){
                if(parseInt(tipo)==1){
                    $( '#numeroPreguntas' ).hide();
                    $('#preguntas').hide();
                    $('#divFileActividad').show();
                }else{
                    $( '#numeroPreguntas' ).show();
                    $('#divFileActividad').hide();
                    $('#preguntas').show();
                }

            }
         $(document).ready(function(){

             $( '#tipoActividad' ).change(function() {
                tipoActividad( $('#tipoActividad').val());
            });

             $( '#cantidadDePreguntas' ).change(function() {
             alert( $('#cantidadDePreguntas').val());
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
                    <div id="templatemo_sidebar">

                        <div id="templatemo_menu">
                            <ul>
                                <li><a href="/Arcadia/index.php/profesor/inicioProfesor">Inicio<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true" style="float: right;" ></a></li>
                                <li><a onclick="desplegar('Notas');">Notas<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true" style="float: right;" ></span></a>

                                </li>
                                <ul class="menuhijos" id="menuNotas">
                                    <li><a href="">Mostrar</a></li>
                                    <li><a href="#">Actualizar</a></li>
                                    <li><a href="#">Estadistica</a></li>
                                </ul>
                                <li><a  onclick="desplegar('Actividades');">Actividades<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true" style="float: right;" ></a></li>
                                <ul class="menuhijos" id="menuActividades">
                                    <li><a href="">Actividades Por Region</a></li>
                                    <li><a href="#">Actividades Por Estudiante</a></li>
                                    <li><a href="#">Actividades para Revisar</a></li>
                                </ul>
                                <li><a href="/Arcadia/index.php/welcome/index">Salir<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true" style="float: right;" ></a></li>
                            </ul>
                        </div> <!-- end of templatemo_menu -->

                    </div> <!-- end of sidebar -->

                    <div id="templatemo_content">

                        <div class="content_box">

                    <form method ="post" name = "formCrearActividad" class="form-horizontal" enctype="multipart/form-data">
                            <h3 class="modal-title">Crea tu Actividad</h3>

                            <input type="hidden" value="" id="imagenModal">
                            <input type="hidden" value="" name="imagenModalId" id="imagenModalId">

                            <div class="form-group">
                                <label for='nombre' >Nombre:</label>
                                <input type='text' id='nombre' name="nombre" class="form-control"  required>
                            </div>
                            <div class="form-group">
                                <label for='descripcion'>Descripcion:</label>
                                <input type='text' id='descripcion' name="descripcion" class="form-control"   required>
                            </div>
                            <div class="form-group">
                                <label for='intentos'>#Intentos:</label>
                                <input type="number" id='intentos' name="intentos"  class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for='porcentaje'>Porcentaje:</label>
                                <input type="number" id='porcentaje' name="porcentaje" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for='fechaVencimiento'>Fecha de Vencimiento:</label>
                                <input type="date" id='fechaVencimiento' name="fechaVencimiento" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for='tipoActividad'>Tipo Actividad:</label>
                                <select id="tipoActividad" name="tipoActividad" class="form-control" selected="selected">
                                    <option value="1" >Archivo</option>
                                    <option value="2">Cuestionario</option>
                                </select>
                            </div>
                            <div id="divFileActividad" class="form-group">
                                <label for='fileActividad'>Archivo Adjunto:</label>
                                <input type="file" id='fileActividad' name="fileActividad" required />
                            </div>
                             <div id="numeroPreguntas" class="form-group" style="display:none;" >
                                 <label for='tipoActividad'>Cantidad de Preguntas:</label>
                                <select id="cantidadDePreguntas"  name="cantidadDePreguntas" class="form-control" selected="selected">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">4</option>
                                        <option value="4">5</option>
                                        <option value="5">8</option>
                                        <option value="10">10</option>
                                </select>
                            </div>

                            <div id="preguntas" style="display:none;">
                                <div class="form-group">
                                    <label for='pregunta1' class="col-sm-2 labelLeft">Pregunta #1:</label>
                                    <div class="col-sm-10 labelLeft">
                                    <select id="cantidadDeOpciones"  name="cantidadDePreguntas" class="form-control" selected="selected">
                                        <option value="1">2</option>
                                        <option value="2">3</option>
                                        <option value="3">4</option>
                                        <option value="4">5</option>
                                        <option value="5">6</option>
                                   </select><br>
                                   </div>
                                   <!--pregunta cerrada -->
                                </div>
                            </div>
                       <!-- hasta aqui va el div de preguntas -->
                            <?php
                                echo "<input type='submit' value='Enviar Datos' id='btnSubmit' class='btn btn-success' onclick = \"this.form.action = 'http://localhost/Arcadia/index.php/Actividad/crearActividad?k_reino=".$_GET['k_reino']."&k_region".$_GET['k_region']."' \">";
                            ?>

                    </form>


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
                Actividades Por Region

            </div>
        </div>
        <!-- templatemo 243 web design -->
        <!--
        Web Design Template
        http://www.templatemo.com/preview/templatemo_243_web_design
        -->

    </body>
</html>
