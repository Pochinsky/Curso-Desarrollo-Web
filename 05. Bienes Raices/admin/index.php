<?php
// consult properties store in DB
require '../includes/config/database.php';
$db = connectDatabase();
$query = 'SELECT id, title, price, image FROM property';
$resultSQL = mysqli_query($db, $query);
// conditional message handler
$result = $_GET['result'] ?? null;
// templates
require '../includes/helpers.php';
includeTemplate('header');
?>
<!-- main -->
<main class="container section">
  <h1>Administrador de Bienes Raíces</h1>
  <?php if (intval($result) === 1) : ?>
    <div class="alert success">Propiedad agregada correctamente</div>
  <?php elseif (intval($result) === 2) : ?>
    <div class="alert success">Propiedad actualizada correctamente</div>
  <?php endif; ?>
  <div class="center">
    <a href="/admin/properties/create.php" class="button-green">Agregar Propiedad</a>
  </div>
  <div class="container container-table">
    <table class="properties">
      <!-- thead -->
      <thead>
        <tr>
          <th>Imagen</th>
          <th>Título</th>
          <th>Precio</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <!-- tbody -->
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($resultSQL)) : ?>
          <tr>
            <td>
              <img class="image-table" src="/images/<?php echo $row['image']; ?>" alt="Casa imagen">
            </td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo numberToCurrency($row['price']); ?></td>
            <td>
              <a class="button-red" href="">Eliminar</a>
              <a class="button-yellow-block" href="/admin/properties/update.php?id=<?php echo $row['id']; ?>">Actualizar</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</main>
<?php
mysqli_close($db);
includeTemplate('footer');
?>