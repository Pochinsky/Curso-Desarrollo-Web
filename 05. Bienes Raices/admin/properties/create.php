<?php

require '../../includes/app.php';

use App\Property;
use App\Seller;
use Intervention\Image\ImageManagerStatic as Image;

// check that session exists
isAuthenticated();

// get sellers
$sellers = Seller::all();

// property object
$property = new Property;

// error values
$errors = Property::getErrors();
$existErrors = Property::getExistErrors();

// http POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $property = new Property($_POST);
  // image upload
  $nameImage = md5(uniqid(rand(), true)) . '.jpg';
  if ($_FILES['image']['tmp_name']) {
    $image = Image::make($_FILES['image']['tmp_name'])->fit(800, 600);
    $property->setImage($nameImage);
  }
  // validate
  $errors = $property->validate();
  $existErrors = Property::getExistErrors();
  // create if not exit errors
  if (!$existErrors) {
    if (!is_dir(IMAGES_FOLDER)) mkdir(IMAGES_FOLDER);
    $image->save(IMAGES_FOLDER . $nameImage);
    $result = $property->save();
  }
}

// header
includeTemplate('header');
?>
<!-- main -->
<main class="container section content-center">
  <h1>Agregar Nueva Propiedad</h1>
  <?php
  if ($existErrors) :
  ?>
    <div class="alert error">
      Existen errores en algunos campos
    </div>
  <?php endif; ?>
  <form class="form" method="POST" action="/admin/properties/create.php" enctype="multipart/form-data">
    <?php include '../../includes/templates/form_properties.php'; ?>
    <div class="form-buttons">
      <a href="/admin" class="button-back">Volver</a>
      <input type="submit" value="Agregar Propiedad" class="full-block button-green">
    </div>
  </form>
</main>
<?php
includeTemplate('footer');
?>