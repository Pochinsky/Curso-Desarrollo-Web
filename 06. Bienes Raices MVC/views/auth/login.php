<main class="container section content-center">
  <h1>Iniciar sesión</h1>
  <?php
  if ($existErrors) :
  ?>
    <div class="alert error">
      Existen errores en algunos campos
    </div>
  <?php endif; ?>
  <form class="form" method="POST" action="login">
    <!-- Personal Info -->
    <label for="email">Email</label>
    <input type="email" name="email" id="email" placeholder="Ej: user@correo.com" />
    <?php if (!empty($errors['email'])) : ?>
      <div class="message error"><?php echo $errors['email']; ?></div>
    <?php endif; ?>
    <label for="password">Contraseña</label>
    <input type="password" name="password" id="password" placeholder="********" />
    <?php if (!empty($errors['password'])) : ?>
      <div class="message error"><?php echo $errors['password']; ?></div>
    <?php endif; ?>
    <div class="center">
      <input type="submit" value="Iniciar Sesión" class="full-block button-green" />
    </div>
  </form>
</main>