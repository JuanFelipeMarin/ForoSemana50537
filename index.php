<?php

 // Conexión a la base de datos
 $servername = "localhost";
 $username = "root";
 $password = "";
 $database = "dbforo7";

 $conn = new mysqli($servername, $username, $password, $database);
 $id_personal = "";
 $especialidad = "";
 $fecha_hora_entrada = "";
 $fecha_hora_salida = "";

// Verificar si se han enviado datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han recibido los datos esperados del formulario
    if (isset($_POST["id_personal"]) && isset($_POST["especialidad"]) && isset($_POST["fecha_hora_entrada"]) && isset($_POST["fecha_hora_salida"])) {
       

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Obtener los datos del formulario
        $id_personal = $_POST["id_personal"];
        $especialidad = $_POST["especialidad"];
        $fecha_hora_entrada = $_POST["fecha_hora_entrada"];
        $fecha_hora_salida = $_POST["fecha_hora_salida"];
        

        // Preparar la consulta SQL para insertar los datos
        $sql = "INSERT INTO registros (ID_PersonalMedico, especialidad, FechaHoraEntrada, FechaHoraSalida) VALUES ('$id_personal', '$especialidad', '$fecha_hora_entrada', '$fecha_hora_salida')";

        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
            $id_personal = "";
        $especialidad = "";
        $fecha_hora_entrada = "";
        $fecha_hora_salida = "";
		header("Location: index.php");
        } else {
            echo "Error al registrar: " . $conn->error;
        }

        // Cerrar la conexión
        $conn->close();
    } else {
        // Mostrar mensaje de error si faltan datos del formulario
       // echo "Faltan datos del formulario";
    }
} else {
    // Mostrar mensaje si no se ha enviado el formulario
    //echo "No se han recibido datos del formulario";
}

?>


<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

		<title>CRUD</title>
	</head>
<body>

<div class="container mt-4">
    <h2>Registrar Entrada y Salida</h2>
    <form action="index.php" method="POST">
        <div class="form-group">
            <label for="id_personal">ID del Personal Médico:</label>
            <input type="number" class="form-control" id="id_personal" name="id_personal" required>
        </div>
		<div class="form-group">
            <label for="especialidad">Especialidad:</label>
            <input type="text" class="form-control" id="especialidad" name="especialidad" required>
        </div>
        <div class="form-group">
            <label for="fecha_hora_entrada">Fecha y Hora de Entrada:</label>
            <input type="datetime-local" class="form-control" id="fecha_hora_entrada" name="fecha_hora_entrada" required>
        </div>
        <div class="form-group">
            <label for="fecha_hora_salida">Fecha y Hora de Salida:</label>
            <input type="datetime-local" class="form-control" id="fecha_hora_salida" name="fecha_hora_salida" required>
        </div>

      
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>
<div class="container mt-4">
        <h2>Registros</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Especialidad</th>
                        <th>Fecha y Hora de Entrada</th>
                        <th>Fecha y Hora de Salida</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Conexión a la base de datos
                    $conn = new mysqli($servername, $username, $password, $database);

                    // Verificar la conexión
                    if ($conn->connect_error) {
                        die("Error de conexión: " . $conn->connect_error);
                    }

                    // Consulta SQL para obtener los registros de la tabla
                    $sql = "SELECT * FROM registros";
                    $result = $conn->query($sql);

                    // Verificar si hay resultados
                    if ($result->num_rows > 0) {
                        // Mostrar los resultados en la tabla
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["ID_PersonalMedico"] . "</td>";
                            echo "<td>" . $row["especialidad"] . "</td>";
                            echo "<td>" . $row["FechaHoraEntrada"] . "</td>";
                            echo "<td>" . $row["FechaHoraSalida"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No se encontraron registros</td></tr>";
                    }

                    // Cerrar la conexión
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

	
	</body>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>