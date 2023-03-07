<?php
require 'includes/config/database.php';
$db = connectDatabase();
$query = "SELECT id, title, description, price, image, room, bathroom, parking FROM property";
if (isset($limit)) $query = $query . " LIMIT $limit";
$result = mysqli_query($db, $query);
?>
<div class="container-advertisements">
  <?php while ($row = mysqli_fetch_assoc($result)) : ?>
    <!-- advertisement -->
    <div class="advertisement">
      <img src="/images/<?php echo $row['image']; ?>" alt="anuncio" loading="lazy" />
      <div class="content-advertisement">
        <h3><?php echo $row['title']; ?></h3>
        <p><?php echo $row['description']; ?></p>
        <p class="price"><?php echo numberToCurrency($row['price']); ?></p>
        <ul class="icons-properties">
          <li>
            <img src="/build/img/icono_wc.svg" alt="icono wc" loading="lazy" class="icon-property" />
            <p><?php echo $row['bathroom']; ?></p>
          </li>
          <li>
            <img src="/build/img/icono_estacionamiento.svg" alt="icono estacionamiento" loading="lazy" class="icon-property" />
            <p><?php echo $row['parking']; ?></p>
          </li>
          <li>
            <img src="/build/img/icono_dormitorio.svg" alt="icono dormitorio" loading="lazy" class="icon-property" />
            <p><?php echo $row['room']; ?></p>
          </li>
        </ul>
        <a href="advertisement.php?id=<?php echo $row['id']; ?>" class="button-yellow-block">Ver propiedad</a>
      </div>
    </div>
  <?php endwhile; ?>
</div>
<?php mysqli_close($db); ?>