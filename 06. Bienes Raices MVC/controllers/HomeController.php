<?php

namespace Controller;

use MVC\Router;
use Model\Property;

class HomeController
{
  public static function index(Router $router)
  {
    $properties = Property::get(3);
    $home = true;
    $router->render('home/index', [
      'properties' => $properties,
      'home' => $home
    ]);
  }

  public static function aboutus(Router $router)
  {
    $router->render('home/aboutus');
  }

  public static function properties(Router $router)
  {
    $properties = Property::all();
    $router->render('home/properties', [
      'properties' => $properties
    ]);
  }

  public static function property(Router $router)
  {
    // get property id
    $id = validateOrRedirect('/');
    // get property to update
    $property = Property::find($id);
    $router->render('home/property', [
      'property' => $property
    ]);
  }

  public static function blog(Router $router)
  {
    $router->render('home/blog');
  }

  public static function entry(Router $router)
  {
    $router->render('home/entry');
  }

  public static function contact(Router $router)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    }
    $router->render('home/contact');
  }
}
