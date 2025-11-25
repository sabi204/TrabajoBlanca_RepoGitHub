<?php
// Archivo: guardar.php

// Datos de conexión
$host = "localhost"; // o 127.0.0.1
$user = "root";      // tu usuario MySQL
$pass = "";          // tu contraseña MySQL
$db   = "escuelaDB";

// Crear conexión
$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}

// Detectamos qué formulario fue enviado según los campos
if (isset($_POST['nombreEscuela'])) {
    // Guardar datos escolares
    $sql = "INSERT INTO escolares (nombreEscuela, direccion, carrera, promedio, cct, estado)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiss",
        $_POST['nombreEscuela'],
        $_POST['direccion'],
        $_POST['carrera'],
        $_POST['promedio'],
        $_POST['cct'],
        $_POST['estado']
    );
    $stmt->execute();
    $mensaje = "✅ Datos escolares guardados correctamente";

} elseif (isset($_POST['calle'])) {
    // Guardar datos de domicilio
    $sql = "INSERT INTO domicilios (calle, numero, colonia, ciudad, estado, cp)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss",
        $_POST['calle'],
        $_POST['numero'],
        $_POST['colonia'],
        $_POST['ciudad'],
        $_POST['estado'],
        $_POST['cp']
    );
    $stmt->execute();
    $mensaje = "✅ Datos de domicilio guardados correctamente";

} elseif (isset($_POST['padre'])) {
    // Guardar datos familiares
    $sql = "INSERT INTO familiares (padre, madre, hermanos, direccion, telefono)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiss",
        $_POST['padre'],
        $_POST['madre'],
        $_POST['hermanos'],
        $_POST['direccion'],
        $_POST['telefono']
    );
    $stmt->execute();
    $mensaje = "✅ Datos familiares guardados correctamente";

} elseif (isset($_POST['nombre']) && isset($_POST['apellido'])) {
    // Guardar datos personales
    $sql = "INSERT INTO personales (nombre, apellido, email, telefono, genero)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss",
        $_POST['nombre'],
        $_POST['apellido'],
        $_POST['email'],
        $_POST['telefono'],
        $_POST['genero']
    );
    $stmt->execute();
    $mensaje = "✅ Datos personales guardados correctamente";

} else {
    $mensaje = "⚠️ No se recibieron datos válidos.";
}

// Cerrar conexión
$conn->close();
?>
