<?php

require '../../includes/app.php';

use App\Seller;

// check that session exists
isAuthenticated();

// seller object
$seller = new Seller();

// error values
$errors = Seller::getErrors();
$existErrors = Seller::getExistErrors();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $seller = new Seller($_POST);
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
  <h1>Registrar Vendedor/a</h1>
  <?php
  if ($existErrors) :
  ?>
    <div class="alert error">
      Existen errores en algunos campos
    </div>
  <?php endif; ?>
  <form class="form" method="POST" action="/admin/sellers/create.php">
    <?php include '../../includes/templates/form_sellers.php'; ?>
    <div class="form-buttons">
      <a href="/admin" class="button-back">Volver</a>
      <input type="submit" value="Registrar Vendedor/a" class="full-block button-green">
    </div>
  </form>
</main>
<?php
includeTemplate('footer');
?>