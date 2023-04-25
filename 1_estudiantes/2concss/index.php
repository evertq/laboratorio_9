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
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div style="width:100%; text-align:center">
        <h1>Laboratorio 9</h1>
        <h2>Sistema de detalles del Estudiantes</h2>
    </div>
    <form class="form" action="index.php" method="POST">
        <input type="hidden" name="id_estudiante" value="<?php echo (isset($id_estudiante))?$id_estudiante:''; ?>">


        <div class="w3-cell-row w3-center w3-padding">
            Nombre: <input style="margin:10px;display: inline-block;" type="text" name="nombre" value="<?php echo (isset($nombre))?$nombre:''; ?>">
            Apellido: <input style="margin:10px;display: inline-block;" type="text" name="apellido" value="<?php echo (isset($apellido))?$apellido:''; ?>">
            Email: <input style="margin:10px;display: inline-block;" type="text" name="email" value="<?php echo (isset($email))?$email:''; ?>">
        </div>


        <div class="w3-cell-row w3-center w3-padding">
            <input class="w3-btn w3-blue w3-border w3-margin" type="submit" name="submit" value="Insertar">
            <input class="w3-btn w3-orange w3-border w3-margin" type="submit" name="Update" value="Actualizar">
            <input class="w3-btn w3-red w3-border w3-margin" type="submit" name="Delete" value="Eliminar">            
        </div>
    </form>
    <br>
    <?php
        //Consulta SQL para realizar el listado de la tabla R=READ
        $query = "SELECT * FROM tbl_estudiante";
        $res  = $conn->query($query);        
    ?>
    <table class="w3-table-all w3-small">
        <tr>
            <th>ID Estudiante</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Fechar Registro</th>
            <th>Actualizar/Eliminar</th>
        </tr>
        <?php
        while ($row = $res->fetch_assoc()) {
            echo "<tr class='w3-hover-blue' style='cursor:pointer;'>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nombre'] . "</td>";
            echo "<td>" . $row['apellido'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['fecha_registro'] . "</td>";
            echo "<td><a href='index.php?id_estudiante=" . $row['id'] . "'>Seleccionar</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
