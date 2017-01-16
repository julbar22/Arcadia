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
                                            echo "<h3> Tu rendimiento en el ".$porcentajes[$i]." % de misiones es de ".$acumulados[$i]."</h1>";
                                            echo "<div><a href='/Arcadia/index.php/Actividad/formularioCrearActividad?k_reino=".$_GET['k_reino']."&k_region=".$regiones[$i]['k_region']."' ></a></div>";
                                            echo "<table class='table table-striped'>";
                                            echo "<thead><tr><th>Nombre</th><th>Nota</th><th>Porcentaje</th></tr></thead>";

                                            echo "<tbody>";
                                            for($j=0;$j<count($regiones[$i]['actividades']);$j++){
                                                                                        //  print_r($regiones[$i]['actividades'][$j]);
                                                echo "<tr>";
                                                echo "<td>".$regiones[$i]['actividades'][$j]['n_nombre']."</td>";
                                                echo "<td>".$regiones[$i]['actividades'][$j]['n_nota']."</td>";
                                                echo "<td>".$regiones[$i]['actividades'][$j]['v_porcentaje']." %</td>";
                                                echo "<tr>";
                                            }
                                          //  echo "<td>Promedio Notas : </td>";
                                        //    echo "<tr><td>Nota Final : </td><tr>";
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
