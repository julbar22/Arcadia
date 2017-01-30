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
         var global;
         var reinoG;
            function checkboxEstado(idCheckbox, region, reino){
                reinoG = reino;
                if(!$('#check'+idCheckbox.k_actividad).prop('checked')){
                    $('.checkActividad').removeAttr("disabled");
                    $('#buttonEditarActividad'+region).attr("disabled",true);
                }else{
                 $('.checkActividad').attr("disabled",true);
                 $('#check'+idCheckbox.k_actividad).removeAttr("disabled");
                 $('#buttonEditarActividad'+region).removeAttr("disabled");
                }
                global=idCheckbox;
            }

            function modalEditar(){
              if(global.i_estado != "Activa"){
                $('#textoModal').val("Actividad "+global.i_estado);
                $('#ModalActividadFallida').modal('show');
              }else{
                if(global.n_intentos_realizados >= global.q_intentos){
                  $('#textoModal').val("Máximo de intentos permitidos");
                  $('#ModalActividadFallida').modal('show');
                }else{                    
                  switch(global.k_tipo_actividad) {
                    
                    case "2":
                      $('#nombreActividadT0').val("Nombre : "+global.n_nombre);
                      $('#tipoActividadT0').val("Tipo : Cuestionario");
                      $("#btnSubmitCuestionario").attr("onclick","this.form.action ='/Arcadia/index.php/actividad/crearCuestionarioResuelto?k_actividad="+global.k_actividad+"&n_intentos="+global.n_intentos_realizados+"/"+global.q_intentos+"&k_reino="+reinoG+"'");
                      $('#ModalFormulario').modal('show');           
                      
                      break;
                    case "1":
                      $('#nombreActividadT1').val("Nombre : "+global.n_nombre);
                      $('#tipoActividadT1').val("Tipo : Archivo");
                      $("#btnSubmitFile").attr("onclick","this.form.action = 'http://localhost/Arcadia/index.php/Actividad/crearActividadResuelta?k_actividad="+global.k_actividad+"&n_intentos="+global.n_intentos_realizados+"/"+global.q_intentos+"&k_reino="+reinoG+"'");
                      $('#ModalArchivo').modal('show');
                      break;
                    default:
                  }
                }
              }
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
                      <?php
                      echo "<a align='center' href='/Arcadia/index.php/reino/obtenerReinoEstudianteC?k_reino=".$_GET['k_reino']."'><input align='center' type='submit' value='Volver' id='btnSubmit' class='btn btn-info'></a>";
                      echo "<h1 align='center' ><img src='/Arcadia/assets/imagenes/arcadiaIcon2r.png' alt='LOGO' /> Lista de Misiones <img src='/Arcadia/assets/imagenes/arcadiaIcon2.png' alt='LOGO' /></h1></br>";
                      ?>
                        <div class="content_box">
                            <?php
                                    if (isset($regiones)) {
                                        for($i=0; $i<count($regiones);$i++){

                                            echo "<h2><img src='/Arcadia/assets/imagenes/arcadiaIcon4.png' alt='LOGO' /> Región: ".$regiones[$i]['n_nombre']."</h2>";
                                            echo "<div><a href='/Arcadia/index.php/Actividad/formularioCrearActividad?k_reino=".$_GET['k_reino']."&k_region=".$regiones[$i]['k_region']."' ></a></div>";
                                            echo "<table class='table table-striped'>";
                                            echo "<thead><tr><th></th><th>Nombre</th><th>Intentos</th><th>F. Vencimiento</th><th>Estado</th><th>Anexo</th></tr></thead>";

                                            echo "<tbody>";
                                            for($j=0;$j<count($regiones[$i]['actividades']);$j++){
                                                echo "<tr>";
                                                echo "<td><input type='checkbox' class='checkActividad' id='check".$regiones[$i]['actividades'][$j]['k_actividad']."' onclick='checkboxEstado(".json_encode($regiones[$i]['actividades'][$j]).",".$i.",". $_GET['k_reino'].")'></td>" ;
                                                echo "<td>".$regiones[$i]['actividades'][$j]['n_nombre']."</td>";
                                                echo "<td>".$regiones[$i]['actividades'][$j]['n_intentos_realizados']."/".$regiones[$i]['actividades'][$j]['q_intentos']."</td>";
                                                if($regiones[$i]['actividades'][$j]['k_tipo_actividad'] == 3){
                                                  echo "<td>Actividad en Clase</td>";
                                                }  else {
                                                  echo "<td>".$regiones[$i]['actividades'][$j]['f_vencimiento']."</td>";          
                                                }
                                                echo "<td>".$regiones[$i]['actividades'][$j]['i_estado']."</td>";
                                                if($regiones[$i]['actividades'][$j]['k_tipo_actividad']==1){
                                                  echo "<td><form method='post' action='http://localhost/Arcadia/index.php/Actividad/descargarDocumentoActividad?download_file=".$regiones[$i]['actividades'][$j]['n_anexo']->getNombre()."' role='form' class='form-inline'><button type='submit' id='Descargar' name='Descargar' class='btn btn-primary'>Descargar</button></form></td>";
                                                }
                                                else{
                                                  echo "<td></td>";
                                                }
                                                  echo "<tr>";
                                            }
                                            echo "</tbody>";
                                            echo "</table>";
                                            echo "<input  id='buttonEditarActividad".$i."'  onclick='modalEditar()' class='btn btn-success' type='button' value='Resolver' disabled>";
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

        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
            <div class="modal-content">
                <form method ='post' >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title">Resolver Actividad</h3>
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

        <div id="ModalActividadFallida" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method ='post' >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title" align="center">Resolver Actividad</h3>
                        </div>
                        <div id="body_modal" class="modal-body">
                            <input type="hidden" value="" name="actividadIdModal" id="actividadIdModal">
                            <p style="text-align:center"><img align="middle" src='/Arcadia/assets/imagenes/youShallNoPassIcon.png' alt='LOGO'></p>
                            <h2 align='center'><input size="30" disabled='true' style="text-align:center" id="textoModal" name="textoModal" value="MAX" enabled></h2>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="ModalFormulario" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method ='post' >
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title" align="center">Resolver Actividad</h3>
                        </div>
                        <div id="body_modal" class="modal-body">
                            <input type="hidden" value="" name="actividadIdModal" id="actividadIdModal">
                            <p style="text-align:center"><img align="middle" src='/Arcadia/assets/imagenes/cuestionarioIcon.png' alt='LOGO'></p>
                            <h3 align='center'><input size="30" disabled='true' style="text-align:center" id="nombreActividadT0" name="nombreActividadT0" value="" enabled></h3>
                            <h3 align='center'><input size="30" disabled='true' style="text-align:center" id="tipoActividadT0" name="tipoActividadT0" value="" enabled></h3>
                            <p style="text-align:center"><input type='submit' value='Resolver' name='btnSubmitCuestionario' id='btnSubmitCuestionario' class='btn btn-success' onclick=""></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="ModalArchivo" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title" align="center">Resolver Actividad</h3>
                    </div>
                    <div id="body_modal" class="modal-body">
                        <input type="hidden" value="" name="actividadIdModal" id="actividadIdModal">
                        <p style="text-align:center"><img align="middle" src='/Arcadia/assets/imagenes/cuestionarioIcon.png' alt='LOGO'></p>
                        <h3 align='center'><input size="30" disabled='true' style="text-align:center" id="nombreActividadT1" name="nombreActividadT1" value="" enabled></h3>
                        <h3 align='center'><input size="30" disabled='true' style="text-align:center" id="tipoActividadT1" name="tipoActividadT1" value="" enabled></h3>
                        <form method ='post' text-align="center" name = 'formEnviarRespuesta' class='form-horizontal' enctype='multipart/form-data'>
                          <div  id='divFileActividad' class='form-group' align='center'>
                              <input type='file' id='fileActividad' name='fileActividad' class='btn btn-default' required /></br>
                              <input type='submit' value='Enviar Respuesta' name='btnSubmitFile' id='btnSubmitFile' class='btn btn-success' onclick="">
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
