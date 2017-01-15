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
        <script type="text/javascript" charset="utf-8" async defer>
         var global;
            function checkboxEstado(idCheckbox){
                if(!$('#check'+idCheckbox.k_actividad).prop('checked')){
                    $('.checkActividad').removeAttr("disabled");
                    $('#buttonEditarActividad').attr("disabled",true);
                }else{
                 $('.checkActividad').attr("disabled",true);
                 $('#check'+idCheckbox.k_actividad).removeAttr("disabled");
                 $('#buttonEditarActividad').removeAttr("disabled");
                }
                global=idCheckbox;
            }
            function modalEditar(){
                    $('#actividadIdModal').val(global.k_actividad);
                    $('#nombreModal').val(global.n_nombre);
                    $('#myModal').modal('show');

            }
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
                            <div><input  id='buttonEditarActividad' style='width: 100%;' onclick='modalEditar()' class='btn btn-default' type='button' value='Editar' disabled></div>
                            <?php
                                    if (isset($regiones)) {
                                        for($i=0; $i<count($regiones);$i++){

                                            echo "<h1>".$regiones[$i]['n_nombre']."</h1>";
                                            echo "<div><a href='/Arcadia/index.php/Actividad/formularioCrearActividad?k_reino=".$_GET['k_reino']."&k_region=".$regiones[$i]['k_region']."' ><input  style='width: 100%;' class='btn btn-default' type='button' value='Añadir Actividad en ".$regiones[$i]['n_nombre']."' ></a></div>";
                                            echo "<table class='table table-striped'>";
                                            echo "<thead><tr><th>#</th><th>Nombre</th><th>Intentos</th><th>Porcentaje</th><th>Estado</th><th>Calificar</th></tr></thead>";

                                            echo "<tbody>";
                                            for($j=0;$j<count($regiones[$i]['actividades']);$j++){
                                                echo "<tr>";
                                                echo "<td><input type='checkbox' class='checkActividad' id='check".$regiones[$i]['actividades'][$j]['k_actividad']."' onclick='checkboxEstado(".json_encode($regiones[$i]['actividades'][$j]).")'></td>" ;
                                                echo "<td>".$regiones[$i]['actividades'][$j]['n_nombre']."</td>";
                                                echo "<td>".$regiones[$i]['actividades'][$j]['q_intentos']."</td>";
                                                echo "<td>".$regiones[$i]['actividades'][$j]['v_porcentaje']."</td>";
                                                echo "<td>".$regiones[$i]['actividades'][$j]['i_estado']."</td>";
                                                if($regiones[$i]['actividades'][$j]['i_estado'] == "Cerrada"){
                                                    echo "<td>
                                                              <form method ='post' name = 'form' class='form-horizontal' enctype='multipart/form-data'>
                                                                  <input type='submit' value='Respuestas' id='btnSubmit' class='btn btn-success' onclick = \"this.form.action = 'http://localhost/Arcadia/index.php/Actividad/listaEstudianteEnMision?k_actividad=".$regiones[$i]['actividades'][$j]['k_actividad']."&k_reino=".$_GET['k_reino']."' \">
                                                              </form>
                                                          </td>";
                                                } else {
                                                    echo "<td>"."</td>";
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
