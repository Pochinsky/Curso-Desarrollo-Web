<?php

namespace App;

class Seller extends ActiveRecord
{
  protected static $columns = ['id', 'name', 'lastname', 'phone'];
  protected static $table = 'seller';
  protected static $errors = [
    'name' => '',
    'lastname' => '',
    'phone' => ''
  ];
  public $id;
  public $name;
  public $lastname;
  public $phone;

  // constructor
  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? '';
    $this->name = $args['name'] ?? '';
    $this->lastname = $args['lastname'] ?? '';
    $this->phone = $args['phone'] ?? '';
  }

  public function validate(): array
  {
    // define error messages
    if (!$this->name) self::$errors['name'] = 'El nombre es obligatorio';
    if (!$this->lastname) self::$errors['lastname'] = 'El precio es obligatorio';
    if (!preg_match('/\+[0-9]{11}/',$this->phone)) self::$errors['phone'] = 'El formato de teléfono no es válido';

    // set errors
    foreach (self::$errors as $error) {
      if (!empty($error)) {
        self::$existErrors = true;
        break;
      }
    }
    return self::$errors;
  }
}
