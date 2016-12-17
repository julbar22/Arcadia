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
            var  $myCanvas;

              function showModalPregunta(){
                   var idReino= <?php if(isset($reinoId)){
                                          echo $reinoId;
                                      }else{
                                         echo $_GET['k_reino'];
                                      }
                    ?>;                  
                   document.getElementById("reinoIdModal").value = idReino;
                    $('#myModal').modal('show');
                }    

            function verDetalle(pregunta){ 
                $("#myModalVer #pregunta").val(pregunta['o_pregunta']);        

                if(pregunta['n_tipo_pregunta']=="abierta"){
                   $("#myModalVer #opcion_multiple").hide();
                   $("#myModalVer #respuesta_abierta").show();
                    $("#myModalVer #r1").val(pregunta['respuestas'][0]["o_opcion"]); 
                }else{
                    $("#myModalVer #opcion_multiple").show();
                    $("#myModalVer #respuesta_abierta").hide();
                     for(let i =0; i<pregunta['respuestas'].length; i++){                                 
                             $('#myModalVer #option'+(i+1)).val(pregunta['respuestas'][i]['o_opcion']); 
                              if(pregunta['respuestas'][i]['o_respuesta']=="t"){
                                $(" #myModalVer #Radio"+(i+1)).attr('checked', true);
                              }                                                   
                    }
                }
                
                $('#myModalVer').modal('show');
            }

            function eliminarPregunta(pregunta){
                alert("entro");
                 window.location.href='/Arcadia/index.php/pregunta/eliminarPregunta?k_reino=0&k_pregunta=0';
            }
            

            

         $(document).ready(function(){

             $( '#inlineRadio1' ).change(function() {
              
                $("#opcion_multiple").hide();
                $("#respuesta_abierta").show();
            });

             $( '#inlineRadio2' ).change(function() {
             
               $("#opcion_multiple").show();
                $("#respuesta_abierta").hide();
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
                                <li><a href="/Arcadia/index.php/profesor/perfilProfesorC">Perfil<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true" style="float: right;" ></a></li>                               
                                <?php
                                    if(isset($reinoId)){
                                          echo "<li><a href='/Arcadia/index.php/reino/obtenerReinoProfesorC?k_reino=".$reinoId."'>Reino<span class='glyphicon glyphicon-triangle-bottom' aria-hidden='true' style='float: right;' ></a></li>";
                                    }else{
                                         echo "<li><a href='/Arcadia/index.php/reino/obtenerReinoProfesorC?k_reino=".$_GET['k_reino']."'>Reino<span class='glyphicon glyphicon-triangle-bottom' aria-hidden='true' style='float: right;' ></a></li>";
                                    }
                                 
                                                                 
                                ?>
                                <li><a href="/Arcadia/index.php/welcome/index">Salir<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true" style="float: right;" ></a></li>
                            </ul>
                        </div> <!-- end of templatemo_menu -->                        
                       
                    </div> <!-- end of sidebar -->

                    <div id="templatemo_content">

                        <div class="content_box">                       

                                <h1>Listado de Preguntas</h1>
                                <div><input onclick="showModalPregunta()" style="width: 100%;" class="btn btn-default" type="button" value="+" ></div>	
                                <div>
                                     <?php
                                        if (isset($preguntas)){                     
                                          
                                            echo "<table class='table table-striped'>";
                                            echo "<thead><tr><th>#</th><th>Pregunta</th><th>Tipo</th><th>Ver</th><th>Eliminar</th></tr></thead>";                                           
                                            echo "<tbody>";
                                         for($i=0; $i<count($preguntas);$i++){                                                                     
                                                echo "<tr>";                                            
                                                echo "<td>".($i+1)."</td>";
                                                echo "<td>".$preguntas[$i]['o_pregunta']."</td>";
                                                echo "<td>".$preguntas[$i]['n_tipo_pregunta']."</td>";
                                                $aux=$i;
                                                echo "<td><button class='btn btn-default' onclick='verDetalle(". json_encode($preguntas[$aux]) .")'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></button></td>";
                                                echo "<td><button class='btn btn-default' onclick='eliminarPregunta(". json_encode($preguntas[$aux]) .")'><span class='glyphicon glyphicon-remove-sign ' aria-hidden='true'></span></button></td>";
                                                
                                                echo "<tr>";      
                                                                                   
                                        }
                                             echo "</tbody>";
                                             echo "</table>";
                                        }
                                    ?>   
                                </div>
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
                Listado de Preguntas
                
            </div>
        </div>
               <!--Modal de actividades -->
         <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <div class="modal-content">
                    <form action="/Arcadia/index.php/pregunta/crearPregunta" method ="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title">Crea tu pregunta</h3>
                        </div>

                        <div id="body_modal" class="modal-body">   
                                          
                            <input type="hidden" value="" name="reinoIdModal" id="reinoIdModal">                            	                        
                            <div>
                             <div id="opciones">
                                <label class="radio-inline">
                                    <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="abierta" checked> Pregunta Abierta
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="cerrada"> Opcion Multiple
                                </label>  
                                </div>  <br>
                                <div>
                                    <label for="pregunta" class="col-sm-2 control-label">Pregunta</label>                   
                                    <textarea id="pregunta" name="pregunta"  class="form-control"></textarea>
                                </div>    
                                <div id="respuesta_abierta">
                                <label for="r1" class="col-sm-2 control-label">Respuesta</label>
                                <textarea id="r1" name="r1" class="form-control"></textarea>
                                </div>
                                <div id="opcion_multiple" style="display:none;">
                                <div class="checkbox">
                                <label>
                                    <input type="radio" name="RadioOptions" id="Radio1" value="option1">
                                    Opcion 1:
                                </label>
                                <textarea id="option1" name="option1" class="form-control"></textarea>
                                </div>
                                <div class="checkbox">
                                <label>
                                    <input type="radio" name="RadioOptions" id="Radio2" value="option2">
                                    Opcion 2:
                                </label>
                                <textarea id="option2" name="option2" class="form-control"></textarea>
                                </div>
                                <div class="checkbox">
                                <label>
                                    <input type="radio" name="RadioOptions" id="Radio3" value="option3">
                                    Opcion 3:
                                </label>
                                <textarea id="option3" name="option3" class="form-control"></textarea>
                                </div>
                                <div class="checkbox">
                                <label>
                                    <input type="radio" name="RadioOptions" id="Radio4" value="option4">
                                    Opcion 4:
                                </label>
                                <textarea id="option4" name="option4" class="form-control"></textarea>
                                </div>
                                </div>
                                                              
                            
                            </div>
                            
                        </div>
                            

                        <div id="modal_footer" class="modal-footer">
                            <input value="Cancelar" data-dismiss="modal" class="btn btn-danger">   
                            <input type="submit" value="Enviar Datos" id="btnSubmit" class="btn btn-success">             
                        </div>
                    </form> 
                </div>

            </div>
        </div>
         <!--Modal de actividades -->

           <!--Modal de preguntas -->
         <div id="myModalVer" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <div class="modal-content">
                    <form action="/Arcadia/index.php/pregunta/crearPregunta" method ="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title">Pregunta Seleccionada</h3>
                        </div>

                        <div id="body_modal" class="modal-body">   
                                          
                            <input type="hidden" value="" name="reinoIdModal" id="reinoIdModal">                            	                        
                            <div>
                               <br>
                                <div>
                                    <label for="pregunta" class="col-sm-2 control-label">Pregunta</label>                   
                                    <textarea id="pregunta" name="pregunta"  class="form-control"></textarea>
                                </div>    
                                <div id="respuesta_abierta">
                                <label for="r1" class="col-sm-2 control-label">Respuesta</label>
                                <textarea id="r1" name="r1" class="form-control"></textarea>
                                </div>
                                <div id="opcion_multiple" style="display:none;">
                                <div class="checkbox">
                                <label>
                                    <input type="radio" name="RadioOptions" id="Radio1" value="option1">
                                    Opcion 1:
                                </label>
                                <textarea id="option1" name="option1" class="form-control"></textarea>
                                </div>
                                <div class="checkbox">
                                <label>
                                    <input type="radio" name="RadioOptions" id="Radio2" value="option2">
                                    Opcion 2:
                                </label>
                                <textarea id="option2" name="option2" class="form-control"></textarea>
                                </div>
                                <div class="checkbox">
                                <label>
                                    <input type="radio" name="RadioOptions" id="Radio3" value="option3">
                                    Opcion 3:
                                </label>
                                <textarea id="option3" name="option3" class="form-control"></textarea>
                                </div>
                                <div class="checkbox">
                                <label>
                                    <input type="radio" name="RadioOptions" id="Radio4" value="option4">
                                    Opcion 4:
                                </label>
                                <textarea id="option4" name="option4" class="form-control"></textarea>
                                </div>
                                </div>
                                                              
                            
                            </div>
                            
                        </div>
                            

                        <div id="modal_footer" class="modal-footer">                                        
                        </div>
                    </form> 
                </div>

            </div>
        </div>
         <!--Modal de preguntas -->

    </body>
</html>
                                   	                                    		          
