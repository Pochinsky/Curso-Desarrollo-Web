<?php

require '../../includes/app.php';

use App\Property;
use App\Seller;
use Intervention\Image\ImageManagerStatic as Image;

// check that session exists
isAuthenticated();

// get property id
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
if (!$id) header('Location: /admin');

// get property to update
$property = Property::find($id);

// get all sellers
$sellers = Seller::all();

// error values
$errors = Property::getErrors();
$existErrors = Property::getExistErrors();

// http POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // sync property
  $property->sync($_POST);
  // validate
  $errors = $property->validate();
  // image upload
  $nameImage = md5(uniqid(rand(), true)) . '.jpg';
  if ($_FILES['image']['tmp_name']) {
    $image = Image::make($_FILES['image']['tmp_name'])->fit(800, 600);
    $property->setImage($nameImage);
  }
  // update if not exist errors
  if (!$existErrors) {
    if ($property->image) {
      if (!is_dir(IMAGES_FOLDER)) mkdir(IMAGES_FOLDER);
      $image->save(IMAGES_FOLDER . $nameImage);
    }
    $property->save();
  }
}
includeTemplate('header');
?>
<!-- main -->
<main class="container section content-center">
  <h1>Actualizar Propiedad</h1>
  <?php
  if ($existErrors) :
  ?>
    <div class="alert error">
      Existen errores en algunos campos
    </div>
  <?php endif; ?>
  <form class="form" method="POST" enctype="multipart/form-data">
    <?php include '../../includes/templates/form_properties.php'; ?>
    <div class="form-buttons">
      <a href="/admin" class="button-back">Volver</a>
      <input type="submit" value="Actualizar Propiedad" class="full-block button-green">
    </div>
  </form>
</main>
<?php
includeTemplate('footer');
?>