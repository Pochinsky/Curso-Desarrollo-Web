<?php

require '../includes/app.php';

use App\Property;
use App\Seller;

// check that session exists
isAuthenticated();

// get all properties
$properties = Property::all();

// get all sellers
$sellers = Seller::all();

// conditional message handler
$result = $_GET['result'] ?? null;

// to delete
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // get id
  $id = $_POST['id'];
  $id = filter_var($id, FILTER_VALIDATE_INT);
  if ($id) {
    $type = $_POST['type'];
    if (validateTypeContent($type)) {
      // delete property
      if ($type === 'property') {
        $property = Property::find($id);
        $property->delete();
      } else if ($type === 'seller') {
        $seller = Seller::find($id);
        $seller->delete();
      }
    }


    // delete file

  }
}
includeTemplate('header');
?>
<!-- main -->
<main class="container section">
  <h1>Administrador de Bienes Raíces</h1>
  <!-- success messages -->
  <?php
  $message = showNotificacion(intval($result));
  if ($message) : ?>
    <p class="alert success"><?php echo sanitize($message); ?></p>
  <?php endif; ?>
  ?>
  <div class="center">
    <a href="/admin/properties/create.php" class="button-green">Agregar Propiedad</a>
    <a href="/admin/sellers/create.php" class="button-green">Agregar Vendedor/a</a>
  </div>
  <h2>Propiedades</h2>
  <!-- properties table -->
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
              <div id="delete-confirmation-property-<?php echo $property->id; ?>" class="delete-confirmation">
                <p>¿Seguro/a de eliminar la propiedad?</p>
                <div>
                  <button id="close-delete-property-<?php echo $property->id; ?>" class="button-back close-delete">No, mantener</button>
                  <form method="POST" class="w-100">
                    <input type="hidden" name="id" value="<?php echo $property->id; ?>">
                    <input type="hidden" name="type" value="property">
                    <input type="submit" value="Si, eliminar" class="button-red w-100">
                  </form>
                </div>
              </div>
              <div id="open-delete-property-<?php echo $property->id; ?>" class="button-red open-delete">Eliminar</div>
              <a class="button-yellow-block" href="/admin/properties/update.php?id=<?php echo $property->id; ?>">Actualizar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <h2>Vendedores/as</h2>
  <!-- sellers table -->
  <div class="container container-table">
    <table class="properties">
      <!-- thead -->
      <thead>
        <tr>
          <th>Nombre y Apellido</th>
          <th>Celular</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <!-- tbody -->
      <tbody>
        <?php foreach ($sellers as $seller) : ?>
          <tr>
            <td><?php echo $seller->name . ' ' . $seller->lastname; ?></td>
            <td><?php echo $seller->phone ? $seller->phone : '---'; ?></td>
            <td>
              <div id="delete-confirmation-seller-<?php echo $seller->id; ?>" class="delete-confirmation">
                <p>¿Seguro/a de eliminar el/la vendedora/a?</p>
                <div>
                  <button id="close-delete-seller-<?php echo $seller->id; ?>" class="button-back close-delete">No, mantener</button>
                  <form method="POST" class="w-100">
                    <input type="hidden" name="id" value="<?php echo $seller->id; ?>">
                    <input type="hidden" name="type" value="seller">
                    <input type="submit" value="Si, eliminar" class="button-red w-100">
                  </form>
                </div>
              </div>
              <div id="open-delete-seller-<?php echo $seller->id; ?>" class="button-red open-delete">Eliminar</div>
              <a class="button-yellow-block" href="/admin/sellers/update.php?id=<?php echo $seller->id; ?>">Actualizar</a>
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
