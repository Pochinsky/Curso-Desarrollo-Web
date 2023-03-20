<?php

namespace Controller;

use MVC\Router;
use Model\Property;
use Model\Seller;
use Intervention\Image\ImageManagerStatic as Image;

class PropertyController
{
  public static function index(Router $router)
  {
    // get all properties
    $properties = Property::all();
    // get all sellers
    $sellers = Seller::all();
    // conditional message handler
    $result = $_GET['result'] ?? null;
    $router->render('properties/admin', [
      'properties' => $properties,
      'result' => $result,
      'sellers' => $sellers
    ]);
  }

  public static function create(Router $router)
  {
    // property object
    $property = new Property();
    // get sellers
    $sellers = Seller::all();
    // error values
    $errors = Property::getErrors();
    $existErrors = Property::getExistErrors();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $property = new Property($_POST);
      // image upload
      $nameImage = md5(uniqid(rand(), true)) . '.jpg';
      if ($_FILES['image']['tmp_name']) {
        $image = Image::make($_FILES['image']['tmp_name'])->fit(800, 600);
        $property->setImage($nameImage);
      }
      // validate
      $errors = $property->validate();
      $existErrors = Property::getExistErrors();
      // create if not exit errors
      if (!$existErrors) {
        if (!is_dir(IMAGES_FOLDER)) mkdir(IMAGES_FOLDER);
        $image->save(IMAGES_FOLDER . $nameImage);
        $result = $property->save();
      }
    }
    $router->render('properties/create', [
      'property' => $property,
      'sellers' => $sellers,
      'errors' => $errors,
      'existErrors' => $existErrors
    ]);
  }

  public static function update(Router $router)
  {
    // get property id
    $id = validateOrRedirect('/admin');
    // get property to update
    $property = Property::find($id);
    // get all sellers
    $sellers = Seller::all();
    // error values
    $errors = Property::getErrors();
    $existErrors = Property::getExistErrors();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // sync property
      $args = $_POST;
      $property->sync($args);
      // validate
      $errors = $property->validate();
      // image upload
      $nameImage = md5(uniqid(rand(), true)) . '.jpg';
      if ($_FILES['image']['tmp_name']) {
        $image = Image::make($_FILES['image']['tmp_name'])->fit(800, 600);
        $property->setImage($nameImage);
      }
      // update if not exist errors
      if (!$existErrors) {
        if ($image) {
          if (!is_dir(IMAGES_FOLDER)) mkdir(IMAGES_FOLDER);
          $image->save(IMAGES_FOLDER . $nameImage);
        }
        $property->save();
      }
    }
    $router->render('/properties/update', [
      'property' => $property,
      'sellers' => $sellers,
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
          $property = Property::find($id);
          $property->delete();
        }
      }
    }
  }
}
