<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Web Design - Free CSS Templates</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />

        <link href="/Arcadia/assets/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/Arcadia/assets/js/jquery-1.11.3.min.js"></script>
        <script src="/Arcadia/assets/js/bootstrap.js" type="text/javascript" charset="utf-8"></script>
        <script src="/Arcadia/assets/js/jcanvas.min.js" type="text/javascript" charset="utf-8"></script>


        <script type="text/javascript" charset="utf-8" async defer>

            $(document).ready(function () {
                var $myCanvas = $('#myCanvas');

               $myCanvas.addLayer({
                    type: 'image',
                    source: '/Arcadia/assets/imagenes/mapaArcadia.jpg',
                    x: 0, y: 0,
                    fromCenter: false,
                    width: 960,
                    height: 600


                }).addLayer({
                    layer:true,
                    type: 'image',
                    source: '/Arcadia/assets/imagenes/arcadialogo.png',
                    x: 50, y: 100,
                    fromCenter: false,
                    width: 150,
                    height: 70,
                    click: function(layer) {
                      alert("este es el logo");
                    }
                }).drawLayers();

            });


        </script>
    </head>
    <body style="background: #edecec;">

        <div class="container-fluid" style="background-image: url('/Arcadia/assets/imagenes/banner4.jpg');height: 450px;">
            <div class="container" >
                 <a href="#"><img src="/Arcadia/assets/imagenes/arcadialogo.png" alt="LOGO" /></a> 
            <ul class="nav nav-tabs nav-justified">
            <li role="presentation" class="active"><a href="#">Home</a></li>
            <li role="presentation"><a href="#">Profile</a></li>
            <li role="presentation"><a href="#">Messages</a></li>
            </ul>         
            <canvas style="width: 100%" id="myCanvas" width="960" height="600" style="border:1px solid #000000; margin:0 auto;"></canvas> 
            </div>
           
        

        </div>                                        
       

    </body>
</html>