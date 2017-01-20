<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Web Design - Free CSS Templates</title>
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <link rel="stylesheet" type="text/css" href="/Arcadia/assets/css/estilosNotas.css">
      <link rel="stylesheet" href="/Arcadia/assets/css/header-login-signup.css">
      </head>
    <body>
        <header class="header-login-signup">
        	<div class="header-limiter">
          <img src="/Arcadia/assets/imagenes/arcadialogo2.png" alt="LOGO" />
        		<nav>
        			<a href="/Arcadia/index.php/profesor/inicioProfesor">Inicio</a>
              <?php
                echo "<a href='/Arcadia/index.php/reino/obtenerReinoProfesorC?k_reino=".$_GET['k_reino']."'>Volver</a>";
              ?>
        		</nav>
        		<ul>
              <?php
              echo "<li><a>Hola ".$_SESSION['codigo']."</a></li>";
              ?>
              <li><a href="/Arcadia/index.php/welcome/index">Salir</a></li>
        		</ul>
        	</div>
        </header>
        <section>
        </br>
          <?php
            if (isset($regiones)) {
             //print_r($regiones);
             for($i=0; $i<count($regiones);$i++){
               echo "<h1><img src='/Arcadia/assets/imagenes/arcadiaIcon1.png' alt='LOGO' /> Región: ".$regiones[$i]->getNombre()." "."<img src='/Arcadia/assets/imagenes/arcadiaIcon1r.png' alt='LOGO' /></h1>";
                echo "<div class='tbl-header'>";
                    echo "<table cellpadding='0' cellspacing='0' border='0' class='table table-header-rotated'>";
                      echo "<thead>";
                        echo "<tr>";
                          echo "<th width='80'>Apellidos</th><th width='80'>Nombres</th>";
                          for($j=0; $j<count($regiones[$i]->getActividades());$j++){
                            if(count($regiones[$i]->getActividades()) > 8){
                              echo "<th class='vertical'><div class='vertical'><span>".$regiones[$i]->getActividades()[$j]->getNombre()."</span></div></th>";
                            }
                            else{
                              echo "<th><div><span>".$regiones[$i]->getActividades()[$j]->getNombre()."</span></div></th>";
                            }
                            }
                            echo "<th>Total</th>";
                          echo "</tr>";
                        echo "</thead>";
                      echo "</table>";
                    echo "</div>";

                    echo "<div class='tbl-content'>";
                      echo "<table cellpadding='0' cellspacing='0' border='0'>";
                        echo "<tbody>";
                          for($k=0; $k<count($estudiantes);$k++){
                            echo "<tr>";
                              echo "<td width='80'>".$estudiantes[$k]->getApellido()."</td>";
                              echo "<td width='80'>".$estudiantes[$k]->getNombre()."</td>";
                              for($j=0; $j<count($regiones[$i]->getActividades());$j++){
                                echo "<td>".$notas[$i][$k][$j]."</td>";
                              }
                              echo "<td>".$totales[$i][$k]."</td>";
                              echo "</tr>";
                            }
                            echo "<tr>";
                              echo "<td width='80'></td>";
                              echo "<td width='80'>Promedio Actividad</td>";
                                for($j=0; $j<count($regiones[$i]->getActividades());$j++){
                                  echo "<td>".$promAct[$i][$j]."</td>";
                                }
                              echo "<td></td>";  
                            echo "</tr>";
                  echo "</tbody>";
                echo "</table>";
              echo "</div>";
            }
                    //print_r($estudiantes);
          }
          ?>
        </section>
    </body>
</html>
