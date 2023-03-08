<?php
require __DIR__ . '/includes/app.php';
$db = connectDatabase();
$errors = [
  'email' => '',
  'password' => ''
];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = mysqli_real_escape_string(
    $db,
    filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
  );
  $password = $_POST['password'];
  if (!$email) $errors['email'] = 'El email es obligatorio';
  if (!$password) $errors['password'] = 'La contraseña es obligatoria';
  foreach ($errors as $error)
    if (!empty($error)) $existErrors = true;
  if (!$existErrors) {
    // check user exists
    $query = "SELECT password FROM user WHERE email='$email'";
    $result = mysqli_query($db, $query);
    if ($result->num_rows) {
      $user = mysqli_fetch_assoc($result);
      // check password is correct
      $auth = password_verify($password, $user['password']);
      if ($auth) {
        session_start();
        $_SESSION['email'] = $user['email'];
        $_SESSION['login'] = true;
        header('Location: /admin');
      } else {
        $errors['password'] = 'La contraseña es incorrecta';
      }
    } else {
      $errors['user'] = 'El usuario no existe';
    }
  }
}
includeTemplate('header');
?>
<!-- main -->
<main class="container section content-center">
  <h1>Iniciar sesión</h1>
  <?php
  if ($existErrors) :
  ?>
    <div class="alert error">
      Existen errores en algunos campos
    </div>
  <?php endif; ?>
  <form class="form" method="POST">
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
<?php
mysqli_close($db);
includeTemplate('footer');
?>