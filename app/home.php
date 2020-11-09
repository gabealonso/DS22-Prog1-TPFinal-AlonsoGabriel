<?php
require_once 'clases/Usuario.php';
require_once 'clases/Controlador.php';

/** inicio de sesion */
session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $nomApe = $usuario->getNombreApellido();
    /** traigo el ID del usuario para saber quién dio de alta o modifico el alumno */
    $id_admin = $usuario->getId();
}
else {
    header('Location: index.php');
}

/** pasaje de datos para alta de alumno al repositorio, id_mod = 0 porque no fue modificado */
if (isset($_REQUEST['btn-alta']) && isset($_POST['legajo']) && isset($_POST['email']) && isset($_POST['cursos_id'])) {
  $controlador = new Controlador();
  $result = $controlador->createAlumno($_POST['legajo'], $_POST['nombre'], $_POST['apellido'], 
                              $_POST['email'], 0, $_POST['cursos_id'], $id_admin);
  if( $result[0] === true ){
    $redirigir = 'home.php?mensaje='.$result[1];
  }
  else {
    $redirigir = 'home.php?mensaje='.$result[1];
  }
  header('Location: ' . $redirigir);
}

/** seteamos por defecto los valores del formulario editar */
$id_alumno = "";
$legajo = "";
$nombre = "";
$apellido = "";
$email = "";
$modificado = "";
$nombre_curso = "";
$nombre_carrera = "";

/** capturo id de alumno para traer datos al formulario editar */
if(isset($_GET['id_alumno'])){
  $controlador = new Controlador();
  $resultadoAlumno = $controlador->getAlumno($_GET['id_alumno']);
  while($row=mysqli_fetch_array($resultadoAlumno))
  {
    echo $id_alumno = $row[0];
    echo $legajo = $row[1];
    echo $nombre = $row[2];
    echo $apellido = $row[3];
    echo $email = $row[4];
    echo $modificado = $row[5];
    echo $nombre_curso = $row[6];
    echo $nombre_carrera = $row[7];
  }
}

/** pasaje de parametros para editar */
if (isset($_REQUEST['btn-actualizar']) && isset($_POST['legajo_modify']) && isset($_POST['email_modify']) && isset($_POST['cursos_id_modify'])) {
  $controlador = new Controlador();
  $result = $controlador->editAlumno($_POST['id_alumno_modify'], $_POST['legajo_modify'], $_POST['nombre_modify'], $_POST['apellido_modify'], 
                                    $_POST['email_modify'], $id_admin, $_POST['cursos_id_modify']);
}

/** pasaje de parametros para eliminar */
if(isset($_REQUEST['btn-eliminar'])){
  $controlador = new Controlador();
  $result = $controlador->deleteAlumno($_POST['id_alumno_modify']);
}

/** traigo la tabla alumnos para mostrar en la home - buscador */

if(isset($_REQUEST['btn-buscar']) && isset($_POST['buscador'])){
  $controlador = new Controlador();
  $resultadoTabla = $controlador->buscarAlumno($_POST['buscador']);
}
else{
  $controlador = new Controlador();
  $resultadoTabla = $controlador->getTabla();
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
            <a class="brand-logo nombre">Hola, <?=$nomApe?></a>
            <a class="brand-logo center">Sistema de Alumnos</a>
            <ul class="right hide-on-med-and-down">
              <li><a href="create.php" class="waves-effect waves-light btn blue">Crear nuevo usuario</a></li>
              <li><a href="logout.php" class="waves-effect waves-light btn blue">Cerrar sesión</a></li>
            </ul>
          </div>
        </nav>

        <!-- validacion -->
        <?php
          if (isset($_GET['mensaje'])) {
            echo '<div id="mensaje">
                  <p class="section center-align green lighten-2">'.$_GET['mensaje'].'</p></div>';
          }
        ?>

        <!-- Alta de alumnos -->
        <div class="section">
          <div class="row">
            <form class="col s6" action="home.php" method="post">
                <div class="row card-panel blue lighten-5">
                <h5>Alta de alumno</h5>
                <input class="validate" required type="number" name="legajo" placeholder="Legajo">
                <input class="validate" required name="nombre" placeholder="Nombre">
                <input class="validate" required name="apellido" placeholder="Apellido">
                <input class="validate" required type="email" name="email" placeholder="Email">
                <div class="row dropdown">
                  <div class="col s6">
                    <select name="carrera" id="carrera_alta"  style="display: block;">
                      <option value="0">--Carrera--</option>
                      <option value="a">Analisis Funcional</option>
                      <option value="d">Desarrollo de Software</option>
                      <option value="i">Infraestructura de la Tecnologia</option>
                    </select>
                  </div>
                  <div class="col s6">
                    <select name="cursos_id" id="cursos_id" disabled style="display: block;">
                      <option>--Curso/Comision--</option>
                    </select>
                  </div>
                </div>
                <div class="row center">
                  <div class="col s12">
                    <button type="submit" name="btn-alta" class="btn buttons green col s12">Dar de alta</button>
                  </div>
                </div>
              </div>
            </form>

            <!-- Edicion de alumnos -->
            <form class="col s6" action="home.php" method="post">
                <div class="card-panel blue lighten-5">
                <h5>Editar alumno</h5>
                <input class="validate" required type="hidden" name="id_alumno_modify" value="<?php echo $id_alumno ?>">
                <input class="validate" required type="text" name="legajo_modify" value="<?php echo $legajo ?>" placeholder="Legajo">
                <input class="validate" required name="nombre_modify" value="<?php echo $nombre ?>" placeholder="Nombre">
                <input class="validate" required name="apellido_modify" value="<?php echo $apellido ?>" placeholder="Apellido">
                <input class="validate" required type="email" name="email_modify" value="<?php echo $email ?>" placeholder="Email">
                <div class="row dropdown">
                  <div class="col s6">
                    <select name="carrera" id="carrera_modify" style="display: block;">
                      <option value="0">--Carrera--</option>
                      <option value="a">Analisis Funcional</option>
                      <option value="d">Desarrollo de Software</option>
                      <option value="i">Infraestructura de la Tecnologia</option>
                    </select>
                  </div>
                  <div class="col s6">
                    <select name="cursos_id_modify" id="cursos_id_modify" disabled style="display: block;">
                      <option>--Curso/Comision--</option>
                    </select>
                  </div>
                </div>
                <div class="row center">
                  <div class="col s4">
                    <button type="submit" class="btn buttons green" name="btn-actualizar">Actualizar</button>
                  </div>
                  <div class="col s4">
                    <button type="submit" class="btn buttons red" name="btn-eliminar">Eliminar</button>
                  </div>
                  <div class="col s4">
                    <a href="home.php" class="btn buttons blue">Cancelar</a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        
        <!-- buscador -->
        <div class="section container">
          <form action="home.php" method="post">
            <div class="file-field input-field row">
              <input type="text" name="buscador" class="col s8" placeholder="Buscar por legajo">
              <button type="submit" class="btn col s1 blue" name="btn-buscar">Buscar</button>
            </div>
          </form>
        </div>
        
        <!-- tabla -->
        <div class="section">
          <table class="highlight responsive-table centered">
            <thead class="blue">
              <tr>
                <th>ID</th>
                <th>Legajo</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Modificado ult. vez por</th>
                <th>Curso</th>
                <th>Carrera</th>
                <th>Alta por</th>
                <th>Accion</th>
              </tr>
            </thead>
            <tbody class="blue lighten-5">
              <?php while ($rows = mysqli_fetch_assoc($resultadoTabla)){

              ?>
              <tr>
                <td><?php echo $rows['id_alumno'] ?></td>
                <td><?php echo $rows['legajo'] ?></td>
                <td><?php echo $rows['nombre'] ?></td>
                <td><?php echo $rows['apellido'] ?></td>
                <td><?php echo $rows['email'] ?></td>
                <td><?php echo $rows['modificado'] ?></td>
                <td><?php echo $rows['nombre_curso'] ?></td>
                <td><?php echo $rows['nombre_carrera'] ?></td>
                <td><?php echo $rows['creado'] ?></td>
                <td>
                  <a href="home.php?id_alumno=<?php echo $rows['id_alumno'] ?>" class="btn blue" name="btn-editar-eliminar">Editar/Eliminar</href>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
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

      <!-- Compiled and minified JavaScript -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
      
      <!-- ajax scripts -->
      <script language="JavaScript">
      
      /* primer dropdown */
      var optionVehicles = document.querySelector('#carrera_alta');
      window.onload = optionVehicles.addEventListener('change', queryCursos);
      function queryCursos(){
          var curso = document.querySelector('#carrera_alta').value;
          document.querySelector('#cursos_id').disabled = true;
          document.querySelector('#cursos_id').innerHTML = '<option>--Esperando respuesta--</option>';

          var request = new XMLHttpRequest();
          request.onreadystatechange = function () {
              if(this.readyState == 4 && this.status == 200){
                  var modelsList = JSON.parse(this.responseText);
                  var selectModels = document.querySelector('#cursos_id');

                  while(selectModels.firstChild){
                      selectModels.removeChild(selectModels.firstChild);
                  }

                  var newOption;
                  for(i=0; i<modelsList.length; i++){
                      newOption = document.createElement('option');
                      newOption.value = modelsList[i].code;
                      newOption.innerHTML = modelsList[i].curso;
                      selectModels.appendChild(newOption);
                  }
                  document.querySelector('#cursos_id').disabled = false;
              }
          }
          request.open("GET", "cursosJSON.php?o="+curso, true);
          request.send();
      }

      /** segundo dropdown */

      var optionVehicles = document.querySelector('#carrera_modify');
      window.onload = optionVehicles.addEventListener('change', queryCursosModify);
      function queryCursosModify(){
          var curso = document.querySelector('#carrera_modify').value;
          document.querySelector('#cursos_id_modify').disabled = true;
          document.querySelector('#cursos_id_modify').innerHTML = '<option>--Esperando respuesta--</option>';

          var request = new XMLHttpRequest();
          request.onreadystatechange = function () {
              if(this.readyState == 4 && this.status == 200){
                  var modelsList = JSON.parse(this.responseText);
                  var selectModels = document.querySelector('#cursos_id_modify');

                  while(selectModels.firstChild){
                      selectModels.removeChild(selectModels.firstChild);
                  }

                  var newOption;
                  for(i=0; i<modelsList.length; i++){
                      newOption = document.createElement('option');
                      newOption.value = modelsList[i].code;
                      newOption.innerHTML = modelsList[i].curso;
                      selectModels.appendChild(newOption);
                  }
                  document.querySelector('#cursos_id_modify').disabled = false;
              }
          }
          request.open("GET", "cursosJSON.php?o="+curso, true);
          request.send();
      }
      </script>
    </body>
</html>

