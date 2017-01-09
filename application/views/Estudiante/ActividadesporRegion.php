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
                                <li><a href="/Arcadia/index.php/estudiante/inicioEstudiante">Inicio<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true" style="float: right;" ></a></li>
                                <li><a href="/Arcadia/index.php/estudiante/perfilEstudianteC">Perfil<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true" style="float: right;" ></a></li>
                                <?php
                                  echo "<li><a href='/Arcadia/index.php/reino/obtenerReinoEstudianteC?k_reino=".$_GET['k_reino']."'>Reino<span class='glyphicon glyphicon-triangle-bottom' aria-hidden='true' style='float: right;' ></a></li>";

                                ?>
                                <li><a href="/Arcadia/index.php/welcome/index">Salir<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true" style="float: right;" ></a></li>
                            </ul>
                        </div> <!-- end of templatemo_menu -->

                    </div> <!-- end of sidebar -->

                    <div id="templatemo_content">

                        <div class="content_box">
                            <?php
                                    if (isset($regiones)) {
                                        for($i=0; $i<count($regiones);$i++){

                                            echo "<h1>"."Región: ".$regiones[$i]['n_nombre']."</h1>";
                                            echo "<div><a href='/Arcadia/index.php/Actividad/formularioCrearActividad?k_reino=".$_GET['k_reino']."&k_region=".$regiones[$i]['k_region']."' ></a></div>";
                                            echo "<table class='table table-striped'>";
                                            echo "<thead><tr><th>Nombre</th><th>Intentos</th><th>Archivo</th><th>Resolver</th></tr></thead>";

                                            echo "<tbody>";
                                            for($j=0;$j<count($regiones[$i]['actividades']);$j++){
                                                                            //              print_r($regiones[$i]['actividades'][$j]['n_anexo']->getNombre());
                                                echo "<tr>";
                                                echo "<td>".$regiones[$i]['actividades'][$j]['n_nombre']."</td>";
                                                echo "<td>".$regiones[$i]['actividades'][$j]['n_intentos_realizados']."/".$regiones[$i]['actividades'][$j]['q_intentos']."</td>";
                                                if($regiones[$i]['actividades'][$j]['k_tipo_actividad']==1)
                                                {
                                                  echo "<td><form method='post' action='http://localhost/Arcadia/index.php/Actividad/descargarDocumentoActividad?download_file=".$regiones[$i]['actividades'][$j]['n_anexo']->getNombre()."' role='form' class='form-inline'><button type='submit' id='Descargar' name='Descargar' class='btn btn-primary'>Descargar</button></form></td>";

                                                      if($regiones[$i]['actividades'][$j]['n_intentos_realizados']<$regiones[$i]['actividades'][$j]['q_intentos'])
                                                      {
                                                          echo "<td>
                                                                    <form method ='post' name = 'formEnviarRespuesta' class='form-horizontal' enctype='multipart/form-data'>
                                                                        <div id='divFileActividad' class='form-group'>
                                                                            <input type='file' id='fileActividad' name='fileActividad' class='btn btn-default' required />
                                                                        </div>
                                                                        <input type='submit' value='Enviar Respuesta' id='btnSubmit' class='btn btn-success' onclick = \"this.form.action = 'http://localhost/Arcadia/index.php/Actividad/crearActividadResuelta?k_actividad=".$regiones[$i]['actividades'][$j]['k_actividad']."&n_intentos=".$regiones[$i]['actividades'][$j]['n_intentos_realizados']."/".$regiones[$i]['actividades'][$j]['q_intentos']."&k_reino=".$_GET['k_reino']."' \">
                                                                    </form>
                                                                </td>";
                                                      }
                                                      else {
                                                          echo "<td>Maximo de Intetos Permitidos</td>";
                                                      }
                                                }else
                                                {
                                                   echo "<td></td>";
                                                   echo "<td><button onclick='myFunction()' class='btn btn-primary'>Resolver</button></td>";
                                                }




                                                echo "<tr>";
                                            }
                                            echo "</tbody>";
                                            echo "</table>";
                                        }


                                    }

                            ?>

                        </div>

                    </div>

                    <div class="cleaner"></div>
                </div>

                <div id="templatemo_main_bottom">
                </div>

            </div> <!-- end of wrapper -->
        </div>

        <div id="templatemo_footer_wrapper"><div id="templatemo_footer">Actividades Por Region</div></div>
        <!-- templatemo 243 web design -->
        <!--
        Web Design Template
        http://www.templatemo.com/preview/templatemo_243_web_design
        -->

    </body>
</html>
