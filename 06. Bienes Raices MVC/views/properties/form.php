<!-- general info --->
<fieldset>
  <legend>Información General</legend>
  <label for="title">Título</label>
  <input type="text" name="title" id="title" value="<?php echo sanitize($property->title); ?>" placeholder="Ej: Casa en el bosque con quincho">
  <?php if (!empty($errors['title'])) : ?>
    <div class="message error"><?php echo $errors['title']; ?></div>
  <?php endif; ?>
  <label for="price">Precio</label>
  <input type="number" name="price" id="price" value="<?php echo sanitize($property->price); ?>" placeholder="Ej: 250000000">
  <?php if (!empty($errors['price'])) : ?>
    <div class="message error"><?php echo $errors['price']; ?></div>
  <?php endif; ?>
  <label for="image">Imagen</label>
  <input type="file" name="image" id="image" accept="image/*">
  <?php if (!empty($errors['image'])) : ?>
    <div class="message error"><?php echo $errors['image']; ?></div>
  <?php endif; ?>
  <label for="description">Descripción</label>
  <textarea name="description" id="description"><?php echo sanitize($property->description); ?></textarea>
  <?php if (!empty($errors['description'])) : ?>
    <div class="message error"><?php echo $errors['description']; ?></div>
  <?php endif; ?>
</fieldset>
<!-- property info -->
<fieldset>
  <legend>Información de la Propiedad</legend>
  <label for="room">Habitaciones</label>
  <input type="number" name="room" id="room" placeholder="Ej: 3" min="1" max="9" value="<?php echo sanitize($property->room); ?>">
  <?php if (!empty($errors['room'])) : ?>
    <div class="message error"><?php echo $errors['room']; ?></div>
  <?php endif; ?>
  <label for="bathroom">Baños</label>
  <input type="number" name="bathroom" id="bathroom" placeholder="Ej: 3" min="1" max="9" value="<?php echo sanitize($property->bathroom); ?>">
  <?php if (!empty($errors['bathroom'])) : ?>
    <div class="message error"><?php echo $errors['bathroom']; ?></div>
  <?php endif; ?>
  <label for="parking">Estacionamientos</label>
  <input type="number" name="parking" id="parking" placeholder="Ej: 3" min="1" max="9" value="<?php echo sanitize($property->parking); ?>">
  <?php if (!empty($errors['parking'])) : ?>
    <div class="message error"><?php echo $errors['parking']; ?></div>
  <?php endif; ?>
</fieldset>
<!-- seller info -->
<fieldset>
  <legend>Vendedor</legend>
  <select name="sellerId" id="sellerId">
    <option value="" disabled selected>-- Seleccione --</option>
    <?php foreach ($sellers as $seller) : ?>
      <option <?php echo $property->sellerId === $seller->id ? 'selected' : ''; ?> value="<?php echo sanitize($seller->id); ?>">
        <?php echo sanitize($seller->name) . ' ' . sanitize($seller->lastname); ?>
      </option>
    <?php endforeach; ?>
  </select>
  <?php if (!empty($errors['sellerId'])) : ?>
    <div class="message error"><?php echo $errors['sellerId']; ?></div>
  <?php endif; ?>
</fieldset>