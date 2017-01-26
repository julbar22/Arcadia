<!DOCTYPE HTML>
<!--
        Autonomy by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
    <head>
        <title>Arcadia Estudiantes</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="/Arcadia/assets/css/bootstrap.css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="/Arcadia/assets/js/bootstrap.js" type="text/javascript" charset="utf-8"></script>
        <script>
            function cambiarAtributo(){
                var correoField = document.getElementById("CorreoE");
                var telefonoField = document.getElementById("TelefonoE");
                var colegioField = document.getElementById("ColegioE");
                var gradoField = document.getElementById("GradoE");
                var avatarField = document.getElementById("avatarEstudiante");
                var tituloField = document.getElementById("tituloE");
                correoField.removeAttribute('disabled');
                telefonoField.removeAttribute('disabled');
                colegioField.removeAttribute('disabled');
                gradoField.removeAttribute('disabled');
                avatarField.removeAttribute('disabled');
                tituloField.removeAttribute('disabled');
                document.getElementById("actualizarDatos").style.display = "block";
                document.getElementById("actualizarDatos").style.float = "right";
              }
              function actualizarDatos(){
              }
              function cambiarDatos(avatares){
                var valorOption = $('#avatarEstudiante option:selected').attr('value');
                for(var i = 0; i < avatares.length; i++){
                  if(valorOption == avatares[i].id){
                    document.images['avatar'].src=avatares[i].avatar;
                      }
                  }
              }
        </script>


        <link rel="stylesheet" href="/Arcadia/assets/css/skel-noscript.css" />
        <link rel="stylesheet" href="/Arcadia/assets/css/style.css" />
        <link rel="stylesheet" href="/Arcadia/assets/css/style-desktop.css" />
        <link rel="stylesheet" type="text/css" href="/Arcadia/assets/css/specific_Css/style.css">



    </head>
    <body>


        <div id="header">
            <div class="container">
                <div id="logo">
                    <a href="#"><img src="/Arcadia/assets/imagenes/arcadialogo2.png" alt=""></a>
                </div>

                <!-- Nav -->
                <nav id="nav">
                    <ul>
                        <li><a href="/Arcadia/index.php/estudiante/inicioEstudiante">Inicio</a></li>
                        <li  class="active"><a href="#">Perfil</a></li>
                        <li><a href="/Arcadia/index.php/welcome/index">Salir</a></li>
                    </ul>
                </nav>

            </div>
        </div>

        <div id="banner">&nbsp;</div>

        <div id="featured">

        <form method="post" name="formActualizar">

            <div class="container">
                <?php
                if (isset($perfil)) {
                    for($i=0;$i<count($honores);$i++){
                      if($honores[$i]['estado']=="Activo"){
                          $titulo = $honores[$i]['titulo'];
                      }
                    }
                    echo "<h1 class='titulo_pagina'><img src='".$icono['mediano']."' alt='LOGO'> ".$perfil['k_nickname']." '".$titulo."' <img src='".$icono['mediano']."' alt='LOGO'>"."</h1>";
                }
                ?>

                <div class="row">
                    <div class="col-md-5">
                        <?php
                        if (isset($perfil)) {
                            echo "<img name='avatar' src='" . $perfil['o_imagen'] . "'' alt='imagenPerfil' class='img-responsive'>";
                        }
                        ?>


                    </div>
                    <div class="col-md-7">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title" style="font-size: 20px;font-weight: 600;text-align: center;">Información de Perfil</h3>
                                <button type="button" class="btn btn-primary" onclick="cambiarAtributo()">Actualizar Datos</button>
                            </div>
                            <div class="panel-body">
                                <img src="/Arcadia/assets/imagenes/worldofarcadialogog.png" alt="worldofarcadialogo" class="img-responsive"
                                     style="margin: auto; padding-bottom: 20px;">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Nombre</span>
                                    <?php
                                    if (isset($perfil)) {
                                        echo "<input id='Nombre' name='Nombre' type='text' disabled='true' class='form-control' aria-describedby='basic-addon1' value='" . $perfil['n_nombre'] . "'>";
                                    }
                                    ?>
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Apellido</span>
                                    <?php
                                    if (isset($perfil)) {
                                        echo "<input id='Apellido' name='Apellido' type='text' disabled='true' class='form-control' aria-describedby='basic-addon1' value='" . $perfil['n_apellido'] . "'>";
                                    }
                                    ?>
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Clase</span>
                                    <?php
                                    if (isset($perfil)) {
                                        echo "<input id='Clase' name='Clase' type='text' disabled='true' class='form-control' aria-describedby='basic-addon1' value='" . $perfil['k_clase'] . "'>";
                                    }
                                    ?>
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Correo</span>
                                    <?php
                                    if (isset($perfil)) {
                                        echo "<input id='CorreoE' name='CorreoE' type='text' class='form-control' disabled='true' aria-describedby='basic-addon1' value='" . $perfil['o_correo'] . "'>";
                                    }
                                    ?>
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Telefono </span>
                                    <?php
                                    if (isset($perfil)) {
                                        echo "<input id='TelefonoE' name='TelefonoE' type='text' class='form-control' disabled='true' aria-describedby='basic-addon1' value='" . $perfil['o_num_tel'] . "'>";
                                    }
                                    ?>
                                </div>
                                <br>
                                <div class="input-group">
                                    <span size="50" class="input-group-addon" id="basic-addon1">Colegio       :</span>
                                    <?php
                                    if (isset($perfil)) {
                                        echo "<input id='ColegioE' name='ColegioE' type='text' class='form-control' disabled='true' aria-describedby='basic-addon1' value='" . $perfil['n_colegio'] . "'>";
                                    }
                                    ?>
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Grado Actual</span>
                                    <?php
                                    if (isset($perfil)) {
                                        echo "<input id='GradoE' name='GradoE' type='text' class='form-control' disabled='true' aria-describedby='basic-addon1' value='" . $perfil['o_grado_actual'] . "'>";
                                    }
                                    ?>
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Titulo</span>
                                    <?php
                                    if (isset($honores)) {
                                        echo "<select id='tituloE' disabled='true' name='TituloE' class='form-control' >";
                                        for($i=0;$i<count($honores);$i++){
                                          if($honores[$i]['estado']=="Activo"){
                                            echo "<option id='".$honores[$i]['titulo']."' value='".$honores[$i]['titulo']."'>".$honores[$i]['titulo']."</option>";
                                          }
                                        }
                                        for($i=0;$i<count($honores);$i++){
                                          if($honores[$i]['estado']=="Inactivo"){
                                            echo "<option id='".$honores[$i]['titulo']."' value='".$honores[$i]['titulo']."'>".$honores[$i]['titulo']."</option>";
                                          }
                                        }
                                        echo "</select>";
                                    }
                                    ?>
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Avatar</span>
                                    <?php
                                    if (isset($avatares)) {
                                        echo "<select id='avatarEstudiante' disabled='true' name='avatarEstudiante' class='form-control' onchange='cambiarDatos(".json_encode($avatares).")' >";
                                        for($i=0;$i<count($avatares);$i++){
                                          if($avatares[$i]['estado']=="Activo"){
                                            echo "<option id='".$avatares[$i]['id']."' value='".$avatares[$i]['id']."'>".$avatares[$i]['nombre']."</option>";
                                          }
                                        }
                                        for($i=0;$i<count($avatares);$i++){
                                          if($avatares[$i]['estado']=="Inactivo"){
                                            echo "<option id='".$avatares[$i]['id']."' value='".$avatares[$i]['id']."'>".$avatares[$i]['nombre']."</option>";
                                          }
                                        }
                                        echo "</select>";
                                    }
                                    ?>
                                </div>
                                     <?php
                                    if (isset($perfil)) {
                                            echo "<input id='NicknameE' name='NicknameE' type='hidden' value='" . $perfil['k_nickname'] . "'>";
                                        }
                                        ?>
                                    <br>
                                    <input id="actualizarDatos" type="submit" class="btn btn-success" style="display:none;"  onclick = "this.form.action = 'http://localhost/Arcadia/index.php/Estudiante/actualizarDatosEstudiante'" value="Guardar Cambios"></input>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </form>
        </div>
        <div id="marketing">
            <h2 id="Creditos">Mis Reinos</h2>
            <div class="container">

                <?php
                if (isset($reinos)) {
                    $j = 0;
                    for ($i = 0; $i < count($reinos) / 4; $i++) {
                        echo "<div class='row'>";
                        for ($h = 0; $h < 4; $h++) {
                            if ($j < count($reinos)) {
                                $a = $reinos[$j]['k_reino'];
                                echo "<div class='3u'>";
                                echo "<form method='get' action='/Arcadia/index.php/reino/obtenerReinoEstudianteC' >";
                                echo "<section>";
                                echo "<input name='k_reino' id='k_reino' type='hidden' value=" . $reinos[$j]['k_reino'] . "> ";
                                echo "<a class='image full'><img src=" . $reinos[$j]['o_imagen'] . " alt='' ></a>";
                                echo "<header>";
                                echo "<h2> Profesor: " . $reinos[$j]['n_profesor'] . "</h2>";
                                echo "</header>";
                                echo "<p>Fecha de creacion: " . $reinos[$j]['f_creacion'] . "</p>";
                                echo "<input type='submit' value='Ir al reino' id='btnReino' class='btn btn-primary'>";
                                echo "</section>";
                                echo "</form>";
                                echo "</div>";
                                $j++;
                            }
                        }
                        echo "</div>";
                    }
                }
                ?>

            </div>
        </div>


    </body>
</html>
