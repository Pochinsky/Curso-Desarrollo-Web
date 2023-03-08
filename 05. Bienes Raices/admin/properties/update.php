<?php
// get property id
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
if (!$id) header('Location: /admin');
// database
require '../../includes/config/database.php';
$db = connectDatabase();
// get property data
$query = "SELECT * FROM property WHERE id=$id";
$result = mysqli_query($db, $query);
$property = mysqli_fetch_assoc($result);
// get sellers
$query1 = 'SELECT * FROM seller';
$result1 = mysqli_query($db, $query1);
// error messages
$errors = [
  'title' => '',
  'price' => '',
  'image' => '',
  'description' => '',
  'rooms' => '',
  'bathrooms' => '',
  'parkings' => '',
  'seller' => ''
];
// default values
$title = $property['title'];
$price = $property['price'];
$image = $_FILES['image'];
$description = $property['description'];
$rooms = $property['room'];
$bathrooms = $property['bathroom'];
$parkings = $property['parking'];
$created = date('Y/m/d');
$seller = $property['seller_id'];
$existErrors = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // extract values
  $title = mysqli_real_escape_string($db, $_POST['title']);
  $price = mysqli_real_escape_string($db, $_POST['price']);
  $description = mysqli_real_escape_string($db, $_POST['description']);
  $rooms = mysqli_real_escape_string($db, $_POST['rooms']);
  $bathrooms = mysqli_real_escape_string($db, $_POST['bathrooms']);
  $parkings = mysqli_real_escape_string($db, $_POST['parkings']);
  $seller = mysqli_real_escape_string($db, $_POST['seller']);
  // define error messages
  if (!$title) $errors['title'] = 'El título es obligatorio';
  if (!$price) $errors['price'] = 'El precio es obligatorio';
  if (strlen($description) < 50)
    $errors['description'] = 'La descripción es obligatoria y debe tener, al menos, 50 caracteres';
  if (!$rooms) $errors['rooms'] = 'La cantidad de habitaciones es obligatoria';
  if (!$bathrooms) $errors['bathrooms'] = 'La cantidad de baños es obligatoria';
  if (!$parkings) $errors['parkings'] = 'La cantidad de estacionamientos es obligatoria';
  if (!$seller) $errors['seller'] = 'El/la vendedor/a es obligatorio/a';
  $megabytesLimit = 1000000;
  if ($image['size'] > $megabytesLimit)
    $errors['image'] = 'La imagen es muy pesada (Máximo 1 MB)';
  // insert data
  foreach ($errors as $error) {
    if (!empty($error)) $existErrors = true;
  }
  if (!$existErrors) {
    $folder = '../../images/';
    if (!is_dir($folder)) mkdir($folder);
    // if exist files then save them
    $nameImage = $property['image'];
    if ($image['name']) {
      unlink($folder . $nameImage);
      $nameImage = md5(uniqid(rand(), true)) . '.jpg';
      move_uploaded_file($image['tmp_name'], $folder . $nameImage);
    }
    // insert data
    $query2 = "UPDATE property SET
      title = '$title',
      price = $price,
      image = '$nameImage',
      description = '$description',
      room = $rooms,
      bathroom = $bathrooms,
      parking = $parkings,
      seller_id = $seller WHERE id = $id";
    $result2 = mysqli_query($db, $query2);
    if ($result2)
      header("Location: /admin?result=2");
  }
}
// templates
require '../../includes/helpers.php';
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
      <label for="rooms">Habitaciones</label>
      <input type="number" name="rooms" id="rooms" placeholder="Ej: 3" min="1" max="9" value="<?php echo $rooms; ?>">
      <?php if (!empty($errors['rooms'])) : ?>
        <div class="message error"><?php echo $errors['rooms']; ?></div>
      <?php endif; ?>
      <label for="bathrooms">Baños</label>
      <input type="number" name="bathrooms" id="bathrooms" placeholder="Ej: 3" min="1" max="9" value="<?php echo $bathrooms; ?>">
      <?php if (!empty($errors['bathrooms'])) : ?>
        <div class="message error"><?php echo $errors['bathrooms']; ?></div>
      <?php endif; ?>
      <label for="parkings">Estacionamientos</label>
      <input type="number" name="parkings" id="parkings" placeholder="Ej: 3" min="1" max="9" value="<?php echo $parkings; ?>">
      <?php if (!empty($errors['parkings'])) : ?>
        <div class="message error"><?php echo $errors['parkings']; ?></div>
      <?php endif; ?>
    </fieldset>
    <!-- seller info -->
    <fieldset>
      <legend>Vendedor</legend>
      <select name="seller" id="seller">
        <option value="" disabled selected>-- Seleccione --</option>
        <?php while ($row = mysqli_fetch_assoc($result1)) : ?>
          <option <?php echo $seller === $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id']; ?>"><?php echo $row['name'] . ' ' . $row['lastname']; ?></option>
        <?php endwhile; ?>
      </select>
      <?php if (!empty($errors['seller'])) : ?>
        <div class="message error"><?php echo $errors['seller']; ?></div>
      <?php endif; ?>
    </fieldset>
    <div class="form-buttons">
      <a href="/admin" class="button-back">Volver</a>
      <input type="submit" value="Actualizar Propiedad" class="full-block button-green">
    </div>
  </form>
</main>
<?php
mysqli_close($db);
includeTemplate('footer');
?>