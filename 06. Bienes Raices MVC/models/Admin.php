<?php

namespace Model;

class Admin extends ActiveRecord
{
  protected static $table = 'user';
  protected static $columnsDB = ['id', 'email', 'password'];

  public $id;
  public $email;
  public $password;

  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->email = $args['email'] ?? null;
    $this->password = $args['password'] ?? null;
  }

  public function validate(): array
  {
    if (!$this->email) self::$errors['email'] = 'El email es obligatorio';
    if (!$this->password) self::$errors['password'] = 'La contraseña es obligatoria';

    // set errors
    foreach (self::$errors as $error)
      if (!empty($error)) self::$existErrors = true;
    return self::$errors;
  }

  public function existUser()
  {
    $query = 'SELECT * FROM ' . self::$table . " WHERE email='" . $this->email . "' LIMIT 1";
    $result = self::$db->query($query);
    if (!$result->num_rows) {
      self::$errors['email'] = 'El usuario no existe';
      self::$existErrors = true;
      return;
    }
    return $result;
  }

  public function checkPassword($result)
  {
    $user = $result->fetch_object();
    $auth = password_verify($this->password, $user->password);
    if (!$auth) {
      self::$errors['password'] = 'La contraseña es incorrecta';
      self::$existErrors = true;
    }
    return $auth;
  }

  public function authentify()
  {
    session_start();
    $_SESSION['user'] = $this->email;
    $_SESSION['login'] = true;
    header('Location: /admin');
  }
}
