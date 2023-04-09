<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>
<form class="formulario" method="POST" action="/">
  <div class="campo">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="Ej: correo@correo.com">
  </div>
  <div class="campo">
    <label for="password">Contraseña</label>
    <input type="password" id="password" name="password" placeholder="Ej: ********">
  </div>
  <input type="submit" value="Iniciar Sesión" class="button">
</form>
<div class="acciones">
  <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crear Una</a>
  <a href="/password-olvidada">¿Olvidaste tu contraseña? Recuperarla</a>
</div>