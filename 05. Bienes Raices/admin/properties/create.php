<?php

require '../../includes/app.php';

use App\Property;
use Intervention\Image\ImageManagerStatic as Image;

// check that session exists
isAuthenticated();

// database
$db = connectDatabase();

// get sellers
$query1 = 'SELECT * FROM seller';
$result1 = mysqli_query($db, $query1);

// default values
$title = '';
$price = '';
$description = '';
$room = '';
$bathroom = '';
$parking = '';
$sellerId = '';
$errors = Property::getErrors();
$existErrors = Property::getExistErrors();

// http POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $property = new Property($_POST);
  // image handling
  $nameImage = md5(uniqid(rand(), true)) . '.jpg';
  if ($_FILES['image']['tmp_name']) {
    $image = Image::make($_FILES['image']['tmp_name'])->fit(800, 600);
    $property->setImage($nameImage);
  }
  // validate
  $errors = $property->validate();
  $existErrors = Property::getExistErrors();
  if (!$existErrors) {
    if (!is_dir(IMAGES_FOLDER)) mkdir(IMAGES_FOLDER);
    $image->save(IMAGES_FOLDER . $nameImage);
    $result = $property->save();
    if ($result)
      header("Location: /admin?result=1");
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
    <!-- general info --->
    <fieldset>
      <legend>Información General</legend>
      <label for="title">Título</label>
      <input type="text" name="title" id="title" value="<?php echo $title; ?>" placeholder="Ej: Casa en el bosque con quincho">
      <?php if (!empty($errors['title'])) : ?>
        <div class="message error"><?php echo $errors['title']; ?></div>
      <?php endif; ?>
      <label for="price">Precio</label>
      <input type="number" name="price" id="price" value="<?php echo $price; ?>" placeholder="Ej: 250000000">
      <?php if (!empty($errors['price'])) : ?>
        <div class="message error"><?php echo $errors['price']; ?></div>
      <?php endif; ?>
      <label for="image">Imagen</label>
      <input type="file" name="image" id="image" accept="image/*">
      <?php if (!empty($errors['image'])) : ?>
        <div class="message error"><?php echo $errors['image']; ?></div>
      <?php endif; ?>
      <label for="description">Descripción</label>
      <textarea name="description" id="description"><?php echo $description; ?></textarea>
      <?php if (!empty($errors['description'])) : ?>
        <div class="message error"><?php echo $errors['description']; ?></div>
      <?php endif; ?>
    </fieldset>
    <!-- property info -->
    <fieldset>
      <legend>Información de la Propiedad</legend>
      <label for="room">Habitaciones</label>
      <input type="number" name="room" id="room" placeholder="Ej: 3" min="1" max="9" value="<?php echo $room; ?>">
      <?php if (!empty($errors['room'])) : ?>
        <div class="message error"><?php echo $errors['room']; ?></div>
      <?php endif; ?>
      <label for="bathroom">Baños</label>
      <input type="number" name="bathroom" id="bathroom" placeholder="Ej: 3" min="1" max="9" value="<?php echo $bathroom; ?>">
      <?php if (!empty($errors['bathroom'])) : ?>
        <div class="message error"><?php echo $errors['bathroom']; ?></div>
      <?php endif; ?>
      <label for="parking">Estacionamientos</label>
      <input type="number" name="parking" id="parking" placeholder="Ej: 3" min="1" max="9" value="<?php echo $parking; ?>">
      <?php if (!empty($errors['parking'])) : ?>
        <div class="message error"><?php echo $errors['parking']; ?></div>
      <?php endif; ?>
    </fieldset>
    <!-- seller info -->
    <fieldset>
      <legend>Vendedor</legend>
      <select name="sellerId" id="sellerId">
        <option value="" disabled selected>-- Seleccione --</option>
        <?php while ($row = mysqli_fetch_assoc($result1)) : ?>
          <option <?php echo $sellerId === $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id']; ?>"><?php echo $row['name'] . ' ' . $row['lastname']; ?></option>
        <?php endwhile; ?>
      </select>
      <?php if (!empty($errors['sellerId'])) : ?>
        <div class="message error"><?php echo $errors['sellerId']; ?></div>
      <?php endif; ?>
    </fieldset>
    <div class="form-buttons">
      <a href="/admin" class="button-back">Volver</a>
      <input type="submit" value="Agregar Propiedad" class="full-block button-green">
    </div>
  </form>
</main>
<?php
mysqli_close($db);
includeTemplate('footer');
?>