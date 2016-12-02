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
                                <li><a href="/Arcadia/index.php/profesor/inicioProfesor">Inicio<span class="glyphicon glyphicon-play" aria-hidden="true" style="float: right;" ></a></li>
                                 <li><a href="/Arcadia/index.php/profesor/perfilProfesorC">Perfil<span class="glyphicon glyphicon-play" aria-hidden="true" style="float: right;" ></a></li>                        
                                 <li><a href="/Arcadia/index.php/profesor/inicioProfesor">Reino<span class="glyphicon glyphicon-play" aria-hidden="true" style="float: right;" ></a></li>                             
                                <li><a href="/Arcadia/index.php/welcome/index">Salir<span class="glyphicon glyphicon-play" aria-hidden="true" style="float: right;" ></a></li>
                            </ul>
                        </div> <!-- end of templatemo_menu -->                        
                       
                    </div> <!-- end of sidebar -->

                    <div id="templatemo_content">

                        <div class="content_box">                       

                                <h1>Listado de Preguntas</h1>
                                <div><input onclick="showModalPregunta()" style="width: 100%;" class="btn btn-default" type="button" value="+" ></div>	
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
                    <form action="#" method ="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title">Crea tu pregunta</h3>
                        </div>

                        <div id="body_modal" class="modal-body">                  
                            <input type="hidden" value="" name="reinoIdModal" id="reinoIdModal">                            	                        
                            <div>
                                <label class="radio-inline">
                                    <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Pregunta Abierta
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Opcion Multiple
                                </label>    
                                <div>
                                    <label for="inputEmail3" class="col-sm-2 control-label">Pregunta</label>                   
                                    <textarea class="form-control"></textarea>
                                </div>    
                                <div>
                                <label for="inputEmail3" class="col-sm-2 control-label">Respuesta</label>
                                <textarea class="form-control"></textarea>
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

    </body>
</html>
                                   	                                    		          
