<?php
// database
require '../../includes/config/database.php';
$db = connectDatabase();
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
$title = '';
$price = '';
$image = $_FILES['image'];
$description = '';
$rooms = '';
$bathrooms = '';
$parkings = '';
$created = date('Y/m/d');
$seller = '';
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
  if (!$image['name']) $errors['image'] = 'La imagen es obligatoria';
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
    // save files
    $folder = '../../images/';
    if (!is_dir($folder)) mkdir($folder);
    $nameImage = md5(uniqid(rand(), true)) . '.jpg';
    move_uploaded_file($image['tmp_name'], $folder . $nameImage);
    // insert data
    $query2 = "
      INSERT INTO property (
        title, price, image, description, room, bathroom, parking, created, seller_id) 
      VALUES (
        '$title', '$price', '$nameImage', '$description', '$rooms', '$bathrooms', '$parkings', '$created', '$seller'
      )";
    $result2 = mysqli_query($db, $query2);
    if ($result2)
      header("Location: /admin?result=1");
  }
}
// templates
require '../../includes/helpers.php';
includeTemplate('header');
?>
<!-- main -->
<main class="container section">
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
      <input type="submit" value="Agregar Propiedad" class="full-block button-green">
    </div>
  </form>
</main>
<?php includeTemplate('footer'); ?>