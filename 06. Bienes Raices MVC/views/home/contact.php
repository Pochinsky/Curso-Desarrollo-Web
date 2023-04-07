<!-- main -->
<main class="container section content-center">
  <h1>Contacto</h1>
  <?php if ($message) : ?>
    <p class="alert success"><?php echo $message; ?></p>
  <?php endif; ?>
  <picture>
    <source srcset="/build/img/destacada3.webp" type="image/webp" />
    <source srcset="/build/img/destacada3.jpg" type="image/jpeg" />
    <img src="/build/img/destacada3.jpg" alt="Imagen contacto" loading="lazy" />
  </picture>
  <h2>Contáctanos completando el siguiente formulario</h2>
  <form class="form" action="/contact" method="POST">
    <!-- Personal Info -->
    <fieldset>
      <legend>Información Personal</legend>
      <label for="name">Nombre</label>
      <input type="text" name="name" id="name" placeholder="Ej: Daniela" />
      <label for="message">Mensaje</label>
      <textarea name="message" id="message"></textarea>
    </fieldset>
    <!-- House Info -->
    <fieldset>
      <legend>Información sobre la Propiedad</legend>
      <label for="options">Vende o compra</label>
      <select name="options" id="options">
        <option value="" disabled selected>-- Seleccione --</option>
        <option value="buy">Vende</option>
        <option value="sell">Compra</option>
      </select>
      <label for="budget">Precio o presupuesto</label>
      <input type="number" name="budget" id="budget" placeholder="Ej: 200000000" />
    </fieldset>
    <!-- Contact -->
    <fieldset>
      <legend>Contacto</legend>
      <p>¿Cómo deseas ser contactado?</p>
      <div class="form-contact">
        <label for="contact-phone">Teléfono</label>
        <input type="radio" name="contact-type" id="contact-phone" value="contact-phone" />
        <label for="contact-email">Email</label>
        <input type="radio" name="contact-type" id="contact-email" value="contact-email" />
      </div>
      <div id="contact"></div>
    </fieldset>
    <div class="center">
      <input type="submit" value="Enviar" class="full-block button-green" />
    </div>
  </form>
</main>