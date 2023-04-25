<?php
    $hostname = "localhost";
    $usuario = "root";
    $password = "";
    $nombreBD = "labo9_crud_tqe";


    //Crear conexión
    $conn = mysqli_connect($hostname, $usuario, $password, $nombreBD);    


    //CRUD
    if (isset($_POST['submit'])) {
        //Para insertar datos C=CREATE
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $query = "INSERT INTO tbl_estudiante (nombre, apellido, email) VALUES('$nombre','$apellido','$email')";
        $res  = $conn->query($query);
        header("Refresh:0");
    }else if (isset($_GET['id_estudiante'])) {
        //Para seleccionar dato por un ID
        $query = "SELECT * FROM tbl_estudiante WHERE id ='" . $_GET['id_estudiante'] . "'";
        $res  = $conn->query($query);
        $row = $res->fetch_assoc();
        $nombre = $row['nombre'];
        $apellido = $row['apellido'];
        $email = $row['email'];
        $id_estudiante = $row['id'];


    }else if (isset($_POST['Update'])) {
        //Para actualizar dato U=UPDATE
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $id_estudiante = $_POST['id_estudiante'];
        $query = "UPDATE tbl_estudiante SET nombre='$nombre', apellido='$apellido', email='$email' WHERE id = $id_estudiante";
        $res  = $conn->query($query);
        header("Refresh:0; url=index.php");
       
    }else if (isset($_POST['Delete'])) {
        //Para eliminar un dato D=DELETE
        $id_estudiante = $_POST['id_estudiante'];
        $query = "DELETE FROM  tbl_estudiante  WHERE id = $id_estudiante";
        $res  = $conn->query($query);
    }
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorio 9</title>
    <link rel="stylesheet" href="bootstrap.min.css">  
</head>
<body>
    <div class="jumbotron text-center" style="margin-bottom:0">
        <h1>Laboratorio 9</h1>
        <h2>Sistema de detalles del Estudiantes</h2>
    </div>    


    <div class="container-fluid" style="margin-top: 30px;">
        <div class="row">
            <div class="col-sm-4">
                <form class="form" action="index.php" method="POST">
                    <input type="hidden" name="id_estudiante" value="<?php echo (isset($id_estudiante))?$id_estudiante:''; ?>">


                    <div class="form-group">
                        <label>Nombre: </label>
                        <input class="form-control" type="text" name="nombre" value="<?php echo (isset($nombre))?$nombre:''; ?>">
                    </div>
                    <div class="form-group">
                        <label>Apellido: </label>                        
                        <input class="form-control" type="text" name="apellido" value="<?php echo (isset($apellido))?$apellido:''; ?>">
                    </div>
                    <div class="form-group">
                        <label>Email: </label>                        
                        <input class="form-control" type="text" name="email" value="<?php echo (isset($email))?$email:''; ?>">
                    </div>                                        
                   
                    <input class="btn btn-primary" type="submit" name="submit" value="Insertar">
                    <input class="btn btn-warning" type="submit" name="Update" value="Actualizar">
                    <input class="btn btn-danger" type="submit" name="Delete" value="Eliminar">
                </form>
            </div>
            <div class="col-sm-8">
            <?php
                //Consulta SQL para realizar el listado de la tabla R=READ
                $query = "SELECT * FROM tbl_estudiante";
                $res  = $conn->query($query);        
            ?>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID Estudiante</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Fechar Registro</th>
                        <th>Actualizar/Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $res->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td>" . $row['apellido'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['fecha_registro'] . "</td>";
                        echo "<td><a href='index.php?id_estudiante=" . $row['id'] . "'>Seleccionar</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>


    <footer>
        <div class="jumbotron text-left" style="margin-bottom:0">
            <p>By EVER 2023</p>
        </div>
    </footer>
</body>
</html>
