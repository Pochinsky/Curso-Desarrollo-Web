<?php
// templates
require '../includes/app.php';
// check that session exists
$auth = isAuthenticated();
if (!$auth) header('Location: /');
// consult properties store in DB
$db = connectDatabase();
$query = 'SELECT id, title, price, image FROM property';
$resultSQL = mysqli_query($db, $query);
// conditional message handler
$result = $_GET['result'] ?? null;
// to delete
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $id = filter_var($id, FILTER_VALIDATE_INT);
  if ($id) {
    // delete file
    $query = "SELECT image FROM property WHERE id=$id";
    $result = mysqli_query($db, $query);
    $property = mysqli_fetch_assoc($result);
    unlink('../images/' . $property['image']);
    //delete register
    $query = "DELETE FROM property WHERE id = $id";
    $result = mysqli_query($db, $query);
    if ($result) {
      header('Location: /admin?result=3');
    }
  }
}
includeTemplate('header');
?>
<!-- main -->
<main class="container section">
  <h1>Administrador de Bienes Raíces</h1>
  <?php if (intval($result) === 1) : ?>
    <div class="alert success">Propiedad agregada correctamente</div>
  <?php elseif (intval($result) === 2) : ?>
    <div class="alert success">Propiedad actualizada correctamente</div>
  <?php elseif (intval($result) === 3) : ?>
    <div class="alert success">Propiedad eliminada correctamente</div>
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
              <div class="delete-confirmation">
                <p>¿Seguro/a de eliminar la propiedad?</p>
                <div>
                  <button class="button-back close-delete">No, mantener</button>
                  <form method="POST" class="w-100">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="submit" value="Si, eliminar" class="button-red w-100">
                  </form>
                </div>
              </div>
              <div class="button-red open-delete">Eliminar</div>
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