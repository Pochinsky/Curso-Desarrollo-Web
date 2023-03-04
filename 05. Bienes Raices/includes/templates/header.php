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
          <?php includeTemplate('nav'); ?>
        </div>
      </div>
      <?php if ($home) { ?>
        <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
      <?php } ?>
    </div>
  </header>