<?php
    $hostname = "localhost";
    $usuario = "root";
    $password = "";
    $nombreBD = "labo9_crud_tqe";


    //Crear conexión
    $conn = mysqli_connect($hostname, $usuario, $password, $nombreBD);


    //CRUD
    if (isset($_POST['Insert'])) {
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
</head>
<body>
    <div>
        <h1>Laboratorio 9</h1>
        <h2>Sistema de detalles del Estudiantes</h2>
    </div>
    <form action="index.php" method="POST">
        <input type="hidden" name="id_estudiante" value="<?php echo (isset($id_estudiante))?$id_estudiante:''; ?>">


        Nombre: <input type="text" name="nombre" value="<?php echo (isset($nombre))?$nombre:''; ?>">
        Apellido: <input type="text" name="apellido" value="<?php echo (isset($apellido))?$apellido:''; ?>">
        Email: <input type="text" name="email" value="<?php echo (isset($email))?$email:''; ?>">
       
        <input type="submit" name="Insert" value="Insertar">
        <input type="submit" name="Update" value="Actualizar">
        <input type="submit" name="Delete" value="Eliminar">
    </form>
    <br>
    <?php
        //Consulta SQL para realizar el listado de la tabla R=READ
        $query = "SELECT * FROM tbl_estudiante";
        $res  = $conn->query($query);  
        // var_dump($res);


        // $row = $res->fetch_assoc();
        // var_dump($row);
        // $row = $res->fetch_assoc();
        // var_dump($row);
        // $row = $res->fetch_assoc();
        // var_dump($row);
    ?>
    <table border="1">
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
    </table>
</body>
</html>
