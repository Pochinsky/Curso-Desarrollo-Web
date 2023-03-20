<?php
if (!isset($_SESSION)) session_start();
$auth = $_SESSION['login'] ?? false;
if (!isset($home)) $home = false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bienes Raíces</title>
  <link rel="stylesheet" href="/build/css/app.css" />
  <link rel="icon" href="/build/img/logo.svg" type="image/svg+xml" />
</head>

<body>
  <!-- header -->
  <header class="header <?php echo $home ? 'home' : ''; ?>">
    <div class="container content-header">
      <div class="bar">
        <a class="logo" href="/">
          <img src="/build/img/logo.svg" alt="Logo de Bienes Raices" loading="lazy" />
        </a>
        <div class="mobile-menu">
          <img src="/build/img/barras.svg" alt="Icono menu" loading="lazy" />
        </div>
        <div class="right">
          <img src="/build/img/dark-mode.svg" alt="Icono dark mode" class="button-darkmode" />
          <nav class="navigation">
            <a href="/aboutus.php">Nosotros</a>
            <a href="/advertisements.php">Anuncios</a>
            <a href="/blog.php">Blog</a>
            <a href="/contact.php">Contacto</a>
            <?php if ($auth) : ?>
              <a href="/close-session.php">Cerrar Sesión</a>
            <?php endif; ?>
          </nav>
        </div>
      </div>
      <?php if ($home) { ?>
        <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
      <?php } ?>
    </div>
  </header>
  <?php echo $content; ?>
  <!-- footer -->
  <footer class="footer section">
    <div class="container container-footer">
      <nav class="navigation">
        <a href="/aboutus.php">Nosotros</a>
        <a href="/advertisements.php">Anuncios</a>
        <a href="/blog.php">Blog</a>
        <a href="/contact.php">Contacto</a>
      </nav>
    </div>
    <p class="copyright">Creado por Tomás Guttman.</p>
    <p class="copyright">
      Basado en curso de Udemy: Desarrollo Web Completo con HTML5, CSS3, JS
      AJAX PHP y MySQL.
    </p>
    <p class="copyright">
      &copy; Todos los derechos reservados. Juan de la Torre Freelance.
    </p>
  </footer>
  <script src="/build/js/bundle.min.js"></script>
</body>

</html>