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
        </style>
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
                                <li><a href="/Arcadia/index.php/profesor/perfilProfesorC">Perfil<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true" style="float: right;" ></a></li>
                                <?php
                                  echo "<li><a href='/Arcadia/index.php/reino/obtenerReinoProfesorC?k_reino=".$_GET['k_reino']."'>Reino<span class='glyphicon glyphicon-triangle-bottom' aria-hidden='true' style='float: right;' ></a></li>";

                                ?>
                                <li><a href="/Arcadia/index.php/welcome/index">Salir<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true" style="float: right;" ></a></li>
                            </ul>
                        </div> <!-- end of templatemo_menu -->

                    </div> <!-- end of sidebar -->

                    <div id="templatemo_content">

                        <div class="content_box">
                            <?php
                                    echo "<h1>Lista Estudiantes</h1>";
                                    echo "<table class='table table-striped'>";
                                    echo "<thead><tr><th>Nombres</th><th>Apellidos</th><th>Ver Misiones</th></tr></thead>";
                                    echo "<tbody>";
                                    if (isset($listaEstudiantes)) {
                                        for($i=0; $i<count($listaEstudiantes);$i++){
                                          echo "<tr>";
                                          echo "<td>".$listaEstudiantes[$i]->getNombre()."</td>";
                                          echo "<td>".$listaEstudiantes[$i]->getApellido()."</td>";
                                          echo "<td>
                                                    <form method ='post' name = 'form' class='form-horizontal' enctype='multipart/form-data'>
                                                        <input type='submit' value='Ver Misiones' id='btnSubmit' class='btn btn-success' onclick = \"this.form.action = 'http://localhost/Arcadia/index.php/Actividad/listaMisionesEstudiante?k_estudiante=".$listaEstudiantes[$i]->getNickname()."&k_reino=".$_GET['k_reino']."' \">
                                                    </form>
                                                </td>";
                                          echo "<tr>";
                                      }
                                    }
                                    echo "</tbody>";
                                    echo "</table>";

                            ?>

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
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <div class="modal-content">

                <form method ='post' >


                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title">Editar Actividad</h3>
                        </div>

                        <div id="body_modal" class="modal-body">
                            <input type="hidden" value="" name="actividadIdModal" id="actividadIdModal">
                            <div id="modalform" class="form-group">
                                <div class="form-group">
                                    <label for='nombreModal'>Nombre:</label>
                                    <input type='text' id='nombreModal' value="" name="nombreModal" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label for='Estado'>Estado:</label>
                                    <select id="Estado" name="Estado" class="form-control" selected="selected">
                                        <option value="Activa" >Activa</option>
                                        <option value="Inactiva">Inactiva</option>
                                        <option value="Cerrada">Cerrada</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="modal_footer" class="modal-footer">
                            <input value="Cancelar" data-dismiss="modal" class="btn btn-danger">
                            <?php
                                echo "<input type='submit' value='Enviar Datos' id='btnSubmit' class='btn btn-success' onclick =\"this.form.action = '/Arcadia/index.php/Actividad/actualizarActividad?k_reino=".$_GET['k_reino']."'\" >";
                            ?>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </body>
</html>
