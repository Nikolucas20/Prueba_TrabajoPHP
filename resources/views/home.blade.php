<?php
    $servidor="localhost";
    $usuario="root";
    $clave="";
    $baseDeDatos="loginpruebas";

    $enlace = mysqli_connect($servidor,$usuario,$clave,$baseDeDatos);
    if(!$enlace){
        echo"Error al conectar";
    }
?>

<!doctype html>
<html lang="en">

<head>
  <title>Inicio</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/styles.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
</head>

<body>
  <header>
  
  </header>
  <main>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
    </div>
  </div>
</nav>
    <p>Bienvenido {{auth()->user()->name ?? auth()->user()->username}}</p>
    <div class="contenedor-lista">
        
        
    <table class="table table-sm table-bordered table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Titulo</th>
                            <th>Descripcion</th>
                            <th>Fecha Vencimiento</th>
                            <th>Completado</th>
                        </thead>
                        <?php
                        use App\Models\paginador;
                            $sql="SELECT * FROM tareas";
                            $result = mysqli_query($enlace,$sql);

                            while($mostrar = mysqli_fetch_array($result)){
                        ?>
                        <tbody id="content">
                            <td><?php echo $mostrar['id']?></td>
                            <td><?php echo $mostrar['titulo']?></td>
                            <td><?php echo $mostrar['descripcion']?></td>
                            <td><?php echo $mostrar['fecha_vencimiento']?></td>
                            <td><?php echo $mostrar['completado']?></td>
                        </tbody>
                        <?php
                            }
                        ?>
                    </table>
    </div>

    <br></br>

    <div class="form-component">
    <form class="form-tareas" action="{{ url('/home') }}" method="post">
        @csrf
        <h2>Formulario para la creacion de tareas</h2>

    <div class="form-outline mb-4">
    <?php
    // Conexión a la base de datos (asegúrate de ajustar estos valores)
    $servidor = "localhost";
    $usuario = "root";
    $contrasena = "";
    $basededatos = "loginpruebas";

    $conexion = mysqli_connect($servidor, $usuario, $contrasena, $basededatos);

    // Verificar la conexión
    if (!$conexion) {
        die("La conexión a la base de datos falló: " . mysqli_connect_error());
    }

    // Consulta para obtener el valor de la ID
    $consulta = "SELECT MAX(id) AS ultima_id FROM tareas";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
    $fila = mysqli_fetch_assoc($resultado);
    $ultima_id = $fila["ultima_id"]+1;
    mysqli_free_result($resultado);

        // Cerrar la conexión
        mysqli_close($conexion);

        // Mostrar el formulario con la ID
        echo '    <input type="text" id="form6Example3" name="id_tarea" class="form-control" value="' . $ultima_id . '" readonly/>';
    } else {
        echo "Error en la consulta: " . mysqli_error($conexion);
    }
    ?>
    <label>ID de la Tarea</label>
    </div>

    <div class="form-outline mb-4">
    <input type="text" id="form6Example3" name="id_usuario" class="form-control" value="{{auth()->user()->id}}" readonly/>
    <label>ID del Usuario</label>
    </div>

    <div class="form-outline mb-4">
    <input type="text" id="form6Example3" name="nombre_usuario" class="form-control" value="{{auth()->user()->name}}" readonly/>
    <label>Nombre del Usuario</label>
    </div>

    <div class="form-outline mb-4">
    <input type="text" id="form6Example3" name="email_usuario" class="form-control" value="{{auth()->user()->email}}" readonly/>
    <label>Email del Usuario</label>
    </div>

    

        
    
  <div class="form-outline mb-4">
    <input type="text" id="form6Example3" name="titulo" class="form-control" required/>
    <label class="form-label" for="form6Example3">Titulo</label>
  </div>

  <!-- Text input -->
  <div class="form-outline mb-4">
    <textarea class="form-control" name="descripcion" id="form6Example7" rows="4" required></textarea>
    <label class="form-label" for="form6Example7">Descripcion</label>
  </div>

  <!-- Email input -->
  <div class="form-outline mb-4">
    <input type="date" name="fecha" id="form6Example5" class="form-control" required/>
    <label class="form-label" for="form6Example5">Fecha de Vencimiento</label>
  </div>

         <!-- Submit button -->
        <button type="submit" name="registrar" class="btn btn-primary btn-block mb-4">Registrar</button>
    </form>
    </div>
  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>



