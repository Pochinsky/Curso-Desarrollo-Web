<?php
include 'includes/config/database.php';
$db = connectDatabase();
// give property id
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
if (!$id) header('Location: /');
// give property data
$query = "SELECT title, description, price, image, room, bathroom, parking FROM property WHERE id = $id";
$result = mysqli_query($db, $query);
if ($result->num_rows) header('Location: /');
$property = mysqli_fetch_assoc($result);
?>
<h1><?php echo $property['title']; ?></h1>
<img src="/images/<?php echo $property['image']; ?>" alt="Imagen propiedad" loading="lazy" />
<div>
  <p class="price"><?php echo numberToCurrency($property['price']); ?></p>
  <div class="container-ad-icons">
    <ul class="icons-properties">
      <li>
        <img src="/build/img/icono_wc.svg" alt="icono wc" loading="lazy" class="icon-property" />
        <p><?php echo $property['bathroom']; ?></p>
      </li>
      <li>
        <img src="/build/img/icono_estacionamiento.svg" alt="icono estacionamiento" loading="lazy" class="icon-property" />
        <p><?php echo $property['parking']; ?></p>
      </li>
      <li>
        <img src="/build/img/icono_dormitorio.svg" alt="icono dormitorio" loading="lazy" class="icon-property" />
        <p><?php echo $property['room']; ?></p>
      </li>
    </ul>
  </div>
  <p><?php echo $property['description']; ?></p>
  <p>
</div>

<?php mysqli_close($db); ?>