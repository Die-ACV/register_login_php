<?php 
session_start();

require "database.php";

$user = null; // Inicializa la variable $user

if (isset($_SESSION["user_id"])) {
    $records = $conn->prepare("SELECT id, email FROM user WHERE id = :id");
    $records->bindParam(":id", $_SESSION["user_id"]);
    $records->execute();
    $user = $records->fetch(PDO::FETCH_ASSOC); // Usa $user para almacenar los datos
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styleindex.css">
    <title>Bienvenido a esta App</title>
</head>
<body class="index">

<!-- Header -->
<header class="contenedor">
    <a href="index.php" class="header">
        <img src="img/logo.png" alt="logo de calzado store" class="logo">
    </a>
</header>

<?php if ($user): // ?>
    <br>Bienvenido, <?php echo htmlspecialchars($user["email"]); ?> <!-- Muestra el email del usuario -->
    <br>Tu estas registrado
    <a href="logout.php">Logout</a>
<?php else: ?>
    <h1>Hola, ya tienes cuenta ?</h1>
    <br>
    <a href="login.php">Inicia sesión</a> o
    <a href="registro.php">Regístrate</a>
<?php endif; ?>

</body>
</html>