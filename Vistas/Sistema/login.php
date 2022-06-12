<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="icon" href="Recursos/img/logo.jpg" type="image/png">
  <title>Niños Cantores de Lara</title>

  <link rel="stylesheet" href="Recursos/css/sistema.css">
</head>
<body>

  <h1>Iniciar sesión</h1>
  <span>o <a href="">Registrar</a></span>

  <form action="Controladores/Sistema/login.php" method="POST">
    <input name="nombre" type="text" placeholder="Correo electrónico">
    <input name="clave" type="password" placeholder="Contraseña">
    <input type="submit" value="Ingresar">
  </form>
</body>
</html>
