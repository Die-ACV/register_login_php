<?php

session_start();

require "database.php";

$message = "";

if (!empty($_POST["email"]) && !empty($_POST["password"])) {
    // Preparar y ejecutar la consulta
    $records = $conn->prepare("SELECT id, email, password FROM user WHERE email=:email");
    $records->bindParam(":email", $_POST["email"]);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    if ($results && password_verify($_POST["password"], $results["password"])) {
        // Iniciar sesión
        $_SESSION["user_id"] = $results["id"];
        header("Location: index.php"); // Redirigir a logout.php
        exit();
    } else {
        $message = "Estas credenciales son incorrectas";
    }
}

?>

<!DOCTYPE html>
<html class="login" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body class="login">
    <main>
        <div class="form-container">

            <?php if (!empty($message)) : ?>
                <p><?= htmlspecialchars($message); ?></p>
            <?php endif; ?>
            <header>
                <h1>Iniciar sesión</h1>
            </header>
            <p>Ingresá tus credenciales para acceder al área.</p>
            <form method="post" action="login.php">
                <label for="email" class="sr-only">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" id="password" placeholder="Contraseña" required>
                <button type="submit">Iniciar sesión</button>
                <p class="error escondido">Error al iniciar sesión</p>
            </form>
            <p>¿Todavía no tenés una cuenta? - <a href="registro.php">Registrate</a></p>
        </div>
    </main>
</body>

</html>