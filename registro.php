<?php 
require "database.php";

$message = "";

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["email"]) && !empty($_POST["password"])) {
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    
    $sql = "INSERT INTO user (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    
    // Enlazar los parámetros correctamente
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        $message = "Creado satisfactoriamente";
    } else {
        $message = "Ha ocurrido un error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>
  <link rel="stylesheet" href="assets/style.css">
  <script src="register.js" defer></script>
</head>
<body>
  <main>
    <div class="form-container">
      <!-- Mostrar mensaje si existe -->
      <?php if (!empty($message)) : ?>
        <p><?= htmlspecialchars($message); ?></p>
      <?php endif; ?>

      <h1>Crear cuenta</h1>
      <p>Creá tu cuenta para entrar al área.</p>
      <!-- Agregar método POST y acción para enviar al script PHP -->
      <form id="register-form" method="POST" action="">
        <label for="user" class="sr-only">User</label>
        <input type="text" name="user" id="user" placeholder="Nombre de usuario">
        <label for="email" class="sr-only">Email</label>
        <input type="email" name="email" id="email" placeholder="Correo electrónico">
        <label for="password" class="sr-only">Password</label>
        <input type="password" name="password" id="password" placeholder="Contraseña">
        <button type="submit">Registrar</button>
        <p class="error escondido">Error al registrarse</p>
      </form>
      <p>¿Ya estás registrado? - <a href="login.php">Iniciar sesión</a></p>
    </div>
  </main>
</body>
</html>