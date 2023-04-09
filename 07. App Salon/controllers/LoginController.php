<?php

namespace Controller;

use MVC\Router;

class LoginController
{
  public static function login(Router $router)
  {
    $router->render('auth/login');
  }

  public static function logout()
  {
    echo 'desde logout';
  }

  public static function password_olvidada(Router $router)
  {
    $router->render('auth/password_olvidada');
  }

  public static function recuperar_password()
  {
    echo 'desde recuperar_password';
  }

  public static function crear(Router $router)
  {
    $router->render('auth/crear_cuenta', [

    ]);
  }
}
