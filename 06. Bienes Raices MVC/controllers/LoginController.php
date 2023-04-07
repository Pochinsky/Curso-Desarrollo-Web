<?php

namespace Controller;

use MVC\Router;
use Model\Admin;

class LoginController
{
  public static function login(Router $router)
  {
    $errors = [];
    $existErrors = false;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $auth = new Admin($_POST);
      $errors = $auth->validate();
      $existErrors = Admin::getExistErrors();
      if (!$existErrors) {
        // check if user exists
        $result = $auth->existUser();
        if ($result) {
          // check user's password
          $authentified = $auth->checkPassword($result);
          if ($authentified) {
            // authentify user
            $auth->authentify();
          } else {
            $errors = Admin::getErrors();
            $existErrors = Admin::getExistErrors();
          }
        } else {
          $errors = Admin::getErrors();
          $existErrors = Admin::getExistErrors();
        }
      }
    }
    $router->render('auth/login', ['errors' => $errors, 'existErrors' => $existErrors]);
  }

  public static function logout()
  {
    session_start();
    $_SESSION = [];
    header('Location: /');
  }
}
