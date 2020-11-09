<?php
require_once 'clases/Controlador.php';
if (isset($_POST['usuario']) && isset($_POST['clave'])) {
    $cs = new Controlador();
    $result = $cs->createUsuario($_POST['usuario'], $_POST['nombre'], 
                          $_POST['apellido'], $_POST['clave']);
    if( $result[0] === true ) {
        $redirigir = 'home.php?mensaje='.$result[1];
    }
    else {
        $redirigir = 'create.php?mensaje='.$result[1];
    }
    header('Location: ' . $redirigir);
}
?>
<!DOCTYPE html> 
<html>
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Escuela N°156 "General Fulano de Tal"</title>
      <!-- Local Stylesheet -->
      <link rel="stylesheet" href="styles.css">
      <!-- Compiled and minified controladorS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
        <main>
            <!-- navbar -->
            <nav>
                <div class="nav-wrapper blue darken-3">
                <a class="brand-logo center">Alta de usuario</a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="home.php" class="waves-effect waves-light btn blue">Regresar</a></li>
                    <li><a href="logout.php" class="waves-effect waves-light btn blue">Cerrar sesión</a></li>
                </ul>
                </div>
            </nav>
            
            <!-- validacion -->
            <?php
                if (isset($_GET['mensaje'])) {
                    echo '<div id="mensaje">
                        <p class="section center-align red lighten-2">'.$_GET['mensaje'].'</p></div>';
                }
            ?>
            
            <!-- alta de usuario -->
            <div class="section container">
                <div class="row">
                    <form class="col s12" action="create.php" method="post">
                        <div class="row card-panel">
                            <input class="validate" required name="usuario" placeholder="Usuario">
                            <input class="validate" required name="clave" type="password" placeholder="Contraseña">
                            <input class="validate" required name="nombre" placeholder="Nombre">
                            <input class="validate" required name="apellido" placeholder="Apellido">
                            <input class="btn blue col s12 buttons" type="submit" value="Dar de alta">
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <!-- footer -->
        <footer class="page-footer blue darken-3">
            <div class="container">
                <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">Escuela N°156 "General Fulano de Tal"</h5>
                    <p class="grey-text text-lighten-4">702-000-2525</p>
                    <p class="grey-text text-lighten-4">escuelafulanodetal@gmail.com</p>
                </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">
                    © 2020 Copyright
                    <a class="grey-text text-lighten-4 right" href="https://www.linkedin.com/in/gabriel-alonso-1994a318b/">Gabriel Alonso</a>
                </div>
            </div>
        </footer>
    </body>
</html>
