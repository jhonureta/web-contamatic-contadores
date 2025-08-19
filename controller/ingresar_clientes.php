<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Conexión a la base de datos
    $conn = new mysqli('localhost', 'root', '', 'contamatic_admin_electronico');
    if ($conn->connect_error) die("Error de conexión: " . $conn->connect_error);

    // Recibir datos del formulario
    $correo = trim($_POST['correo']);
    $usuario = trim($_POST['usuario']);
    $contrasena = $_POST['contrasena'];
    $experiencia = trim($_POST['experiencia']);
    $captcha = $_POST['g-recaptcha-response'];

    // Verificar reCAPTCHA
    $secret = '6LfVGqYrAAAAAB9re1n0kpHCAlWIgqXxHJIQeJYP';
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
    $responseData = json_decode($response);
    if (!$responseData->success) {
        die("Error: Verifica el reCAPTCHA.");
    }

    // Validaciones básicas
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) die("Correo inválido.");
    if (strlen($usuario) < 3 || strlen($usuario) > 50) die("Usuario debe tener entre 3 y 50 caracteres.");
    if (strlen($contrasena) < 6) die("La contraseña debe tener al menos 6 caracteres.");

    // Hashear contraseña
    $hashPassword = password_hash($contrasena, PASSWORD_BCRYPT);

    // Insertar solo los campos necesarios
    $stmt = $conn->prepare("
        INSERT INTO usuarios (EMA_USUEMP, NOM_USUEMP, PASS_USUEMP, EXP_USUEMP)
        VALUES (?, ?, ?, ?)
    ");
    $stmt->bind_param("ssss", $correo, $usuario, $hashPassword, $experiencia);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Usuario registrado correctamente.</div>";
    } else {
        if ($conn->errno === 1062) {
            echo "<div class='alert alert-danger'>Correo o usuario ya registrado.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
        }
    }

    $stmt->close();
    $conn->close();
}
?>
