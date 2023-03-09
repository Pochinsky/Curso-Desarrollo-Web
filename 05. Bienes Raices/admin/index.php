<?php

require '../includes/app.php';

use App\Property;

// check that session exists
isAuthenticated();

// get all properties
$properties = Property::all();

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
        <?php foreach ($properties as $property) : ?>
          <tr>
            <td>
              <img class="image-table" src="/images/<?php echo $property->image; ?>" alt="Casa imagen">
            </td>
            <td><?php echo $property->title; ?></td>
            <td><?php echo numberToCurrency($property->price); ?></td>
            <td>
              <div id="delete-confirmation-<?php echo $property->id; ?>" class="delete-confirmation">
                <p>¿Seguro/a de eliminar la propiedad?</p>
                <div>
                  <button id="close-delete-<?php echo $property->id; ?>" class="button-back close-delete">No, mantener</button>
                  <form method="POST" class="w-100">
                    <input type="hidden" name="id" value="<?php echo $property->id; ?>">
                    <input type="submit" value="Si, eliminar" class="button-red w-100">
                  </form>
                </div>
              </div>
              <div id="open-delete-<?php echo $property->id; ?>" class="button-red open-delete">Eliminar</div>
              <a class="button-yellow-block" href="/admin/properties/update.php?id=<?php echo $property->id; ?>">Actualizar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</main>
<?php
includeTemplate('footer');
?>