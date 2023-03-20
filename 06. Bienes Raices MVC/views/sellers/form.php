<fieldset>
  <legend>Información Personal</legend>
  <label for="name">Nombre</label>
  <input type="text" name="name" id="name" placeholder="Ej: Ariel" value="<?php echo sanitize($seller->name); ?>">
  <?php if (!empty($errors['name'])) : ?>
    <div class="message error"><?php echo $errors['name']; ?></div>
  <?php endif; ?>
  <label for="lastname">Apellido</label>
  <input type="text" name="lastname" id="lastname" placeholder="Ej: González" value="<?php echo sanitize($seller->lastname); ?>">
  <?php if (!empty($errors['lastname'])) : ?>
    <div class="message error"><?php echo $errors['lastname']; ?></div>
  <?php endif; ?>
</fieldset>
<fieldset>
  <legend>Información de Contacto</legend>
  <label for="phone">Teléfono</label>
  <input type="tel" name="phone" id="phone" placeholder="Ej: +56912345678" value="<?php echo sanitize($seller->phone); ?>">
  <?php if (!empty($errors['phone'])) : ?>
    <div class="message error"><?php echo $errors['phone']; ?></div>
  <?php endif; ?>
</fieldset>