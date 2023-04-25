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
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $abreviacion = $_POST['abreviacion'];
        $query = "INSERT INTO tbl_carreras (codigo, nombre, abreviacion) VALUES('$codigo','$nombre','$abreviacion')";
        $res  = $conn->query($query);
        header("Refresh:0");
    }else if (isset($_GET['id_carreras'])) {
        //Para seleccionar dato por un ID
        $query = "SELECT * FROM tbl_carreras WHERE id ='" . $_GET['id_carreras'] . "'";
        $res  = $conn->query($query);
        $row = $res->fetch_assoc();
        $codigo = $row['codigo'];
        $nombre = $row['nombre'];
        $abreviacion = $row['abreviacion'];
        $id_carreras = $row['id_carreras'];


    }else if (isset($_POST['Update'])) {
        //Para actualizar dato U=UPDATE
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $abreviacion = $_POST['abreviacion'];
        $id_carreras = $_POST['id_carreras'];
        $query = "UPDATE tbl_carreras SET codigo='$codigo', nombre='$nombre', abreviacion='$abreviacion' WHERE id = $id_carreras";
        $res  = $conn->query($query);
        header("Refresh:0; url=index.php");
       
    }else if (isset($_POST['Delete'])) {
        //Para eliminar un dato D=DELETE
        $id_carreras = $_POST['id_carreras'];
        $query = "DELETE FROM  tbl_carreras  WHERE id = $id_carreras";
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
        <h2>Sistema de detalles del Carreras</h2>
    </div>
    <form action="index.php" method="POST">
        <input type="hidden" name="id_carreras" value="<?php echo (isset($id_carreras))?$id_carreras:''; ?>">


        Codigo: <input type="text" name="codigo" value="<?php echo (isset($codigo))?$codigo:''; ?>">
        Nombre: <input type="text" name="nombre" value="<?php echo (isset($nombre))?$nombre:''; ?>">
        Abreviacion: <input type="text" name="abreviacion" value="<?php echo (isset($abreviacion))?$abreviacion:''; ?>">
       
        <input type="submit" name="Insert" value="Insertar">
        <input type="submit" name="Update" value="Actualizar">
        <input type="submit" name="Delete" value="Eliminar">
    </form>
    <br>
    <?php
        //Consulta SQL para realizar el listado de la tabla R=READ
        $query = "SELECT * FROM tbl_carreras";
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
            <th>ID Carreras</th>
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Abreviacion</th>
            <th>Fechar Registro</th>
            <th>Actualizar/Eliminar</th>
        </tr>
        <?php
        while ($row = $res->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['codigo'] . "</td>";
            echo "<td>" . $row['nombre'] . "</td>";
            echo "<td>" . $row['abreviacion'] . "</td>";
            echo "<td>" . $row['fecha_registro'] . "</td>";
            echo "<td><a href='index.php?id_carreras=" . $row['id'] . "'>Seleccionar</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
