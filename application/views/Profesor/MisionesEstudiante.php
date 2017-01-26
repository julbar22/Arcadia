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
        <script>
            function cambiarAtributo(x, y){
              var i;
              for (i = 0; i < y; i++) {
                  var notaField = document.getElementById("Nota"+x+""+i);
                  var idField = document.getElementById("Id"+x+""+i);
                  if(notaField != null){
                    notaField.removeAttribute('disabled');
                    idField.removeAttribute('disabled');
                  }
              }
              var buttonField = document.getElementById("BNota"+x+""+y);
              buttonField.setAttribute("disabled","disabled");
              var buttonEnviar = document.getElementById("btnSubmit"+x);
              buttonEnviar.removeAttribute('disabled');
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
                            <?php
                                    if (isset($regiones)) {
                                        echo "<a href='/Arcadia/index.php/reino/listaEstudiantesReino?k_reino=".$_GET['k_reino']."'><input type='submit' value='Volver' id='btnSubmit' class='btn btn-info'></a>";
                                        echo "<h1 align='center' ><img src='/Arcadia/assets/imagenes/arcadiaIcon2r.png' alt='LOGO' /> Misiones <img src='/Arcadia/assets/imagenes/arcadiaIcon2.png' alt='LOGO' /></h1>";
                                        echo "<h2 align='center'><img src='/Arcadia/assets/imagenes/arcadiaIcon3.png' alt='LOGO' /> ".$Estudiante[0]->getNombre()." ".$Estudiante[0]->getApellido()." <img src='/Arcadia/assets/imagenes/arcadiaIcon3.png' alt='LOGO' /></h2></br></br>";

                                        for($i=0; $i<count($regiones);$i++){

                                            echo "<h2><img src='/Arcadia/assets/imagenes/arcadiaIcon4.png' alt='LOGO' /> Región: ".$regiones[$i]['n_nombre']."</h2>";
                                            echo "<form method='post' name='formActualizar'>";
                                            echo "<table class='table table-striped' >";
                                            echo "<thead><tr><th>Nombre</th><th>F. Vencimiento</th><th>Tipo</th><th>Respuesta</th><th>Nota</th></tr></thead>";
                                            echo "<tbody><form method='post' name='form'></form>";
                                            $j=0;
                                            $flag = 0;
                                            for($j=0;$j<count($regiones[$i]['actividades']);$j++){
                                                echo "<tr>";
                                                echo "<td>".$regiones[$i]['actividades'][$j]['n_nombre']."</td>";
                                                echo "<td>".$regiones[$i]['actividades'][$j]['f_vencimiento']."</td>";
                                                switch ($regiones[$i]['actividades'][$j]['k_tipo_actividad']) {
                                                  case 2 :
                                                    echo "<td>Cuestionario</td>";
                                                    break;
                                                  case 1 :
                                                    echo "<td>Archivo</td>";
                                                    break;
                                                  case 3 :
                                                    echo "<td>Actividad en Clase</td>";
                                                    break;
                                                  default:
                                                    echo "<td></td>";
                                                    break;
                                                }
                                                if($regiones[$i]['actividades'][$j]['i_estado'] == "Activa"){
                                                    echo "<td>Misión Activa</td><td></td>";
                                                } else {
                                                    switch ($respuestas[$i][$j]['anexo']) {
                                                      case "No Resuelta":
                                                        echo "<td>".$respuestas[$i][$j]['anexo']."</td>";
                                                        echo "<td>"."</td>";
                                                        break;
                                                      case "Actividad en Clase":
                                                          echo "<td></td>";
                                                          echo "<input id='Bota".$i.$j."' name='Bota".$i.$j."' type='hidden' size='1' style='text-align:center;' disabled='true' class='form-control' aria-describedby='basic-addon1' value='".$respuestas[$i][$j]['nota']."'>";
                                                          echo "<td><input id='Nota".$i.$j."' name='Nota".$i.$j."' step='0.01' type='number' min='0' max='10' size='1' style='text-align:center;' disabled='true' class='form-control' aria-describedby='basic-addon1' value='".$respuestas[$i][$j]['nota']."'>"."<input id='Id".$i.$j."' name='Id".$i.$j."' type='hidden' disabled='true' value='".$respuestas[$i][$j]['Id']."'>"."</td>";
                                                          break;
                                                      default:
                                                        $flag ++;
                                                        echo "<td><form method='post' action='http://localhost/Arcadia/index.php/Actividad/descargarDocumentoActividad?download_file=".$respuestas[$i][$j]['anexo']."' role='form' class='form-inline'><button type='submit' id='Descargar' name='Descargar' class='btn btn-primary'>Descargar</button></form></td>";
                                                        echo "<input id='Bota".$i.$j."' name='Bota".$i.$j."' type='hidden' size='1' style='text-align:center;' disabled='true' class='form-control' aria-describedby='basic-addon1' value='".$respuestas[$i][$j]['nota']."'>";
                                                        echo "<td><input id='Nota".$i.$j."' name='Nota".$i.$j."' step='0.01' type='number' min='0' max='10' size='1' style='text-align:center;' disabled='true' class='form-control' aria-describedby='basic-addon1' value='".$respuestas[$i][$j]['nota']."'>"."<input id='Id".$i.$j."' name='Id".$i.$j."' type='hidden' disabled='true' value='".$respuestas[$i][$j]['Id']."'>"."</td>";
                                                        break;
                                                    }
                                                }
                                                echo "</tr>";
                                            }
                                            echo "</tbody>";
                                            echo "</table>";
                                            if ($flag > 0){
                                              echo " <td><button value='Calificar' id='BNota".$i.$j."' type='button' class='btn btn-primary' onclick= 'cambiarAtributo(".$i.",".$j.")'>Calificar</button></td> ";
                                              echo "<input type='submit' disabled='disabled' value='Actualizar Notas' id='btnSubmit".$i."' class='btn btn-success' onclick = \"this.form.action = 'http://localhost/Arcadia/index.php/Actividad/actualizarNota?k_estudiante=".$_GET['k_estudiante']."&k_reino=".$_GET['k_reino']."' \"> ";
                                            }
                                            echo "</form></br></br>";
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
