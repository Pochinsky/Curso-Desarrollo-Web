<?php

namespace Controller;

use MVC\Router;
use Model\Seller;

class SellerController
{
  public static function create(Router $router)
  {
    // seller object
    $seller = new Seller();
    // error values
    $errors = Seller::getErrors();
    $existErrors = Seller::getExistErrors();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $seller = new Seller($_POST);
      // validate
      $errors = $seller->validate();
      $existErrors = Seller::getExistErrors();
      if (!$existErrors) $seller->save();
    }
    $router->render('sellers/create', [
      'seller' => $seller,
      'errors' => $errors,
      'existErrors' => $existErrors
    ]);
  }

  public static function update(Router $router)
  {
    // get property id
    $id = validateOrRedirect('/admin');
    // get seller to update
    $seller = Seller::find($id);
    // error values
    $errors = Seller::getErrors();
    $existErrors = Seller::getExistErrors();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // sync property
      $args = $_POST;
      $seller->sync($args);
      // validate
      $errors = $seller->validate();
      $existErrors = Seller::getExistErrors();
      // update if not exist errors
      if (!$existErrors) $seller->save();
    }
    $router->render('/sellers/update', [
      'seller' => $seller,
      'errors' => $errors,
      'existErrors' => $existErrors
    ]);
  }

  public static function delete()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // get id
      $id = $_POST['id'];
      $id = filter_var($id, FILTER_VALIDATE_INT);
      if ($id) {
        $type = $_POST['type'];
        if (validateTypeContent($type)) {
          $seller = Seller::find($id);
          $seller->delete();
        }
      }
    }
  }
}
