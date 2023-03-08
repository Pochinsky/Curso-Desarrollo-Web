<?php
require __DIR__ . '/includes/app.php';
includeTemplate('header');
?>
<!-- main -->
<main class="container section">
  <h2>Casas y Departamentos en Venta</h2>
  <?php include 'includes/templates/advertisements.php'; ?>
</main>
<?php includeTemplate('footer'); ?>