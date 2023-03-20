<!-- main -->
<main class="container section">
  <h1>Administrador de Bienes Raíces</h1>
  <!-- success messages -->
  <?php
  if ($result) :
    $message = showNotificacion(intval($result));
    if ($message) : ?>
      <p class="alert success"><?php echo sanitize($message); ?></p>
    <?php endif; ?>
  <?php endif; ?>
  <div class="center">
    <a href="/properties/create" class="button-green">Agregar Propiedad</a>
    <a href="/sellers/create" class="button-green">Agregar Vendedor/a</a>
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
              <!-- delete confirmation div -->
              <div id="delete-confirmation-property-<?php echo $property->id; ?>" class="delete-confirmation">
                <p>¿Seguro/a de eliminar la propiedad?</p>
                <div>
                  <button id="close-delete-property-<?php echo $property->id; ?>" class="button-back close-delete">No, mantener</button>
                  <form method="POST" class="w-100" action="/properties/delete">
                    <input type="hidden" name="id" value="<?php echo $property->id; ?>">
                    <input type="hidden" name="type" value="property">
                    <input type="submit" value="Si, eliminar" class="button-red w-100">
                  </form>
                </div>
              </div>
              <div id="open-delete-property-<?php echo $property->id; ?>" class="button-red open-delete">Eliminar</div>
              <a class="button-yellow-block" href="/properties/update?id=<?php echo $property->id; ?>">Actualizar</a>
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
                  <form method="POST" class="w-100" action="sellers/delete">
                    <input type="hidden" name="id" value="<?php echo $seller->id; ?>">
                    <input type="hidden" name="type" value="seller">
                    <input type="submit" value="Si, eliminar" class="button-red w-100">
                  </form>
                </div>
              </div>
              <div id="open-delete-seller-<?php echo $seller->id; ?>" class="button-red open-delete">Eliminar</div>
              <a class="button-yellow-block" href="/sellers/update?id=<?php echo $seller->id; ?>">Actualizar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</main>