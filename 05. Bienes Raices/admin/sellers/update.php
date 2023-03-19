<?php

require '../../includes/app.php';

use App\Seller;

// check that session exists
isAuthenticated();

// check id
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
if (!$id) header('Location:/ admin');

// seller object
$seller = Seller::find($id);

// error values
$errors = Seller::getErrors();
$existErrors = Seller::getExistErrors();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $args = $_POST;
  // sync object with inputs
  $seller->sync($args);
  // validate
  $errors = $seller->validate();
  $existErrors = Seller::getExistErrors();
  if (!$existErrors) $seller->save();
}

// header
includeTemplate('header');
?>
<!-- main -->
<main class="container section content-center">
  <h1>Actualizar Vendedor/a</h1>
  <?php
  if ($existErrors) :
  ?>
    <div class="alert error">
      Existen errores en algunos campos
    </div>
  <?php endif; ?>
  <form class="form" method="POST">
    <?php include '../../includes/templates/form_sellers.php'; ?>
    <div class="form-buttons">
      <a href="/admin" class="button-back">Volver</a>
      <input type="submit" value="Actualizar Vendedor/a" class="full-block button-green">
    </div>
  </form>
</main>
<?php
includeTemplate('footer');
?>