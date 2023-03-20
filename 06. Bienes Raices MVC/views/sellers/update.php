<!-- main -->
<main class="container section content-center">
  <h1>Actualizar Vendedor/a</h1>
  <?php if ($existErrors) : ?>
    <div class="alert error">
      Existen errores en algunos campos
    </div>
  <?php endif; ?>
  <form class="form" method="POST">
    <?php include __DIR__ . '/form.php'; ?>
    <div class="form-buttons">
      <a href="/admin" class="button-back">Volver</a>
      <input type="submit" value="Actualizar Vendedor/a" class="full-block button-green">
    </div>
  </form>
</main>