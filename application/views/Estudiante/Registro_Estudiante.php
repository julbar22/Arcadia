<!DOCTYPE html>
<html>
    <head>
        <title>Registro Estudiantes
        </title>
        <link rel="stylesheet" href="/Arcadia/assets/css/style.css" />
        <link rel="stylesheet" href="/Arcadia/assets/css/style-desktop.css" />
        <link rel="stylesheet" type="text/css" href="/Arcadia/assets/css/specific_Css/style.css">
        <link rel="stylesheet" type="text/css" href="/Arcadia/assets/css/specific_Css/styleRE.css" />
        <link rel="stylesheet" type="text/css" href="/Arcadia/assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="/Arcadia/assets/css/estilosNotas.css">
        <link rel="stylesheet" href="/Arcadia/assets/css/header-login-signup.css">
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
        <script src="/Arcadia/assets/js/bootstrap.js" type="text/javascript" charset="utf-8"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="/Arcadia/assets/js/jsfuntions/server.js" type="text/javascript" charset="utf-8" async defer></script>
        <script type="text/javascript" charset="utf-8" async defer>
            function cambiarDatos(clases){
                var valorOption = $('#ClaseE option:selected').attr('value');
                for(var i = 0; i < clases.length; i++){
                    if(valorOption == clases[i].k_clase){
                        $('#poder').val("Poder : "+clases[i].n_descripcion);
                        $('#Icono').val(clases[i].avatar.k_avatar);

                        if(clases[i].n_genero == "m"){
                           $('#titulo').val("El "+clases[i].avatar.n_nombre);
                        }else{
                           $('#titulo').val("La "+clases[i].avatar.n_nombre);
                        }

                        document.images['avatar'].src=clases[i].avatar.o_imagen;

                        switch(clases[i].n_nombre) {
                          case "Guerrera":
                          case "Guerrero":
                              document.images['avatar1'].src="/Arcadia/assets/Imagenes/arcadiaIcon11.png";
                              break;
                          case "Mago":
                          case "Maga":
                              document.images['avatar1'].src="/Arcadia/assets/Imagenes/arcadiaIcon12.png";
                              break;
                          case "CambiaFormas":
                          case "CambiaPieles":
                              document.images['avatar1'].src="/Arcadia/assets/Imagenes/arcadiaIcon13.png";
                              break;
                          case "Slayer":
                          case "Ranger":
                              document.images['avatar1'].src="/Arcadia/assets/Imagenes/arcadiaIcon10.png";
                              break;
                          default:

                      }
                    }
                }
            }

            function cambiarSelect(clases){
                var valorOption = $('#SexoE option:selected').attr('id');
                var seleccion = 0;
                var j = 0;
                for(var i = 0; i < clases.length; i++){
                    if(clases[i].n_genero == valorOption){
                        $('#selClase'+j).val(clases[i].k_clase);
                        $('#selClase'+j).text(clases[i].n_nombre);
                        j++;
                    //    console.log(clases[i]);
                    }
                }
                cambiarDatos(clases);
            }

            function loquesea(json) {

                var result = [];
                var keys = Object.keys(json);
                keys.forEach(function (key) {
                    result.push(json[key]);
                });
                alert(result);
                document.getElementById('Iconovalue').value = result[0];
                document.getElementById('avatar').src = result[0];
                document.getElementById('UsuarioE').value = result[1];
                document.getElementById('nombreE').value = result[2];
                document.getElementById('ApellidoE').value = result[3];
                document.getElementById('InsEduE').value = result[4];
                document.getElementById('GradActE').value = result[5];
                document.getElementById('TelE').value = result[6];
                document.getElementById('correoE').value = result[7];
                document.getElementById('SexoE').value = result[8];
                document.getElementById('f_nacimiento').value = result[9];
                document.getElementById('ContrE').value = result[10];
                document.getElementById('ConfContE').value = result[11];


                //arreglo['documento'];

            }
        </script>
    </head>
    <body class="niceHeader" >
        <header class="header-login-signup">
            <img src="/Arcadia/assets/imagenes/arcadialogo.png" class="img-responsive col-md-offset-4 " alt="Responsive image">

        </header>
        <div class="col-md-3">

        </div>
        <div class="col-md-8 col-md-offset-2 form-registro">
            <form method="post" name="form1">

                <div class="col-md-5">
                    <div class="form-group">
                        <?php
                            if (isset($clases)) {
                                echo "<div class='form-group'>";
                                echo "<IMG id='avatar' name='avatar' src='".$clases[0]['avatar']['o_imagen']."' class='img-responsive'> <br>";
                                echo "<input type='text' id='poder' name='poder' value='Poder : ".$clases[0]['n_descripcion']."' class='form-control' disabled='true'>";
                                  switch ($clases[0]['n_nombre']) {
                                    case "Guerrera":
                                    case "Guerrero":
                                      echo "<p style='text-align:center'><IMG id='avatar1' align='middle' name='avatar1' src='/Arcadia/assets/Imagenes/arcadiaIcon11.png'></p>";
                                      break;
                                    case "Mago":
                                    case "Maga":
                                      echo "<p style='text-align:center'><IMG id='avatar1' align='middle' name='avatar1' src='/Arcadia/assets/Imagenes/arcadiaIco12.png' ></p>";
                                      break;
                                    case "CambiaFormas":
                                    case "CambiaPieles":
                                      echo "<p style='text-align:center'><IMG id='avatar1' align='middle' name='avatar1' src='/Arcadia/assets/Imagenes/arcadiaIcon13.png' ></p>";
                                      break;
                                    case "Slayer":
                                    case "Ranger":
                                      echo "<p style='text-align:center'><IMG id='avatar1' align='middle' name='avatar1' src='/Arcadia/assets/Imagenes/arcadiaIcon10.png'></p>";
                                      break;
                                    default:
                                      # code...
                                      break;
                                  }
                                echo "</div>";
                            }
                        ?>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                  <div class="panel-body">

                    <?php

              //        print_r($clases);
                     ?>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Nickname   </span>
                        <input type="text" class="form-control" aria-describedby='basic-addon1' id="UsuarioE" name="UsuarioE"  placeholder="DIGITE SU NICKNAME" required>
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1"> Nombres    </span>
                        <input type="text" aria-describedby='basic-addon1' id="nombreE" name="nombreE" placeholder="DIGITE SU NOMBRE" class="form-control" required >
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Apellidos   </span>
                        <input type="text" id="ApellidoE"  aria-describedby='basic-addon1'  name="ApellidoE"  placeholder="DIGITE SU APELLIDO" class="form-control" required>
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Insitucion   </span>
                        <input type="text" id="InsEduE" aria-describedby='basic-addon1' name="InsEduE"  placeholder="DIGITE SU INSTITUCION" class="form-control" required>
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Curso Act.  </span>
                        <input type="number" aria-describedby='basic-addon1' id="GradActE" name="GradActE" placeholder="DIGITE SU GRADO ACTUAL" class="form-control" required>
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Telefono   </span>
                        <input type="number" id="TelE" name="TelE"  placeholder="DIGITE SU TELEFONO"  class="form-control" required>
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Correo   </span>
                        <input type="email" id="correoE" name="correoE"  placeholder="EJEMPLO@DOMINIO.COM"  class="form-control" required>
                    </div>
                    <br>
                        <?php
                        if (isset($clases)) {
                          echo "<div class='input-group'>";
                          echo  "<span class='input-group-addon' id='basic-addon1'>Genero   </span>";
                          echo "<input id='Icono' name='Icono' class='form-control' value='".$clases[0]['avatar']['k_avatar']."' type='hidden'>";
                          echo "<input id='titulo' name='titulo' class='form-control' value='El ".$clases[0]['avatar']['n_nombre']."' type='hidden'>";
                              echo "<select id='SexoE'  name='SexoE' class='form-control' onchange='cambiarSelect(".json_encode($clases).")'>";
                                  echo "<option id='m' value='M'>Masculino</option>";
                                  echo "<option id='f' value='F'>Femeino</option>";
                          echo "</select></div><br>";

                          echo "<div class='input-group'>";
                          echo  "<span class='input-group-addon' id='basic-addon1'>Clase   </span>";
                            echo "<select id='ClaseE'  name='ClaseE' class='form-control' onchange='cambiarDatos(".json_encode($clases).")'>";
                            for($i = 0; $i < count($clases); $i++){
                                if($clases[$i]['n_genero'] == "m"){
                                   echo "<option id='selClase".$i."' name='selClase".$i."' value=" . $clases[$i]['k_clase'] . ">" . $clases[$i]['n_nombre'] . "</option>";
                                }
                            }
                            echo "</select></div><br>";
                        }
                        ?>

                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">F. Nacimiento   </span>
                        <input type="date" id="f_nacimiento"  class="form-control" name="f_nacimiento">
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Contraseña   </span>
                        <input type="password" id="ContrE"  name="ContrE"  class="form-control" required placeholder="DIGITE SU CONTRASE&Ntilde;A">
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Contraseña   </span>
                        <input type="password" id="ConfContE" name="ConfContE"   class="form-control" placeholder="VERIFIQUE SU CONTRASE&Ntilde;A" required>
                    </div>
                    <br>

                    <input type="submit" class="btn btn-success" onclick = "this.form.action = 'http://localhost/Arcadia/index.php/Estudiante/registrarEstudiante'" value="Registrarse" />
                    <a href="http://localhost/Arcadia/index.php/Welcome/index" ><input type="button" class="btn btn-info" value="Cancelar" /></a>

                  </div>

                </div>
                </div>

            </form>
        </div>




    </body>
</html>

<?php
if (isset($estudiante)) {
    echo "<script>loquesea(" . json_encode($estudiante) . ");</script>";
    // echo "<script>profesor();</script>";
}
?>
