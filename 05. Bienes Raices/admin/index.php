<?php
require '../includes/helpers.php';
$result = $_GET['result'] ?? null;
includeTemplate('header');
?>
<!-- main -->
<main class="container section">
  <h1>Administrador de Bienes Raíces</h1>
  <?php if (intval($result) === 1) : ?>
    <div class="alert success">Propiedad agregada correctamente</div>
  <?php endif; ?>
  <div class="center">
    <a href="/admin/properties/create.php" class="button-green">Agregar Propiedad</a>
  </div>
</main>
<?php includeTemplate('footer'); ?>