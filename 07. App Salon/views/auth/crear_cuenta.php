<h1 class="nombre-pagina">Crear cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario para crear una cuenta</p>

<form class="formulario" method="POST" action="/crear-cuenta">
  <div class="campo">
    <label for="name">Nombre</label>
    <input type="text" name="name" id="name" placeholder="Ej: Roberto">
  </div>
  <div class="campo">
    <label for="lastname">Apellido</label>
    <input type="text" name="lastname" id="lastname" placeholder="Ej: González">
  </div>
  <div class="campo">
    <label for="phone">Teléfono</label>
    <input type="tel" name="phone" id="phone" placeholder="Ej: +56912345678">
  </div>
  <div class="campo">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" placeholder="Ej: correo@correo.com">
  </div>
  <div class="campo">
    <label for="password">Contraseña</label>
    <input type="password" name="password" id="password" placeholder="Ej: ********">
  </div>
  <input type="submit" value="Crear Cuenta" class="button">
</form>
<div class="acciones">
  <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
  <a href="/password-olvidada">¿Olvidaste tu contraseña? Recuperarla</a>
</div>