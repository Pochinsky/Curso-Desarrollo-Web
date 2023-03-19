<?php

namespace App;

class Property extends ActiveRecord
{
  protected static $columns = [
    'id', 'title', 'price', 'image', 'description', 'room', 'bathroom', 'parking', 'created', 'sellerId'
  ];
  protected static $table = 'property';
  protected static $errors = [
    'title' => '',
    'price' => '',
    'image' => '',
    'description' => '',
    'room' => '',
    'bathroom' => '',
    'parking' => '',
    'sellerId' => ''
  ];
  public $id;
  public $title;
  public $price;
  public $image;
  public $description;
  public $room;
  public $bathroom;
  public $parking;
  public $created;
  public $sellerId;

  // constructor
  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? '';
    $this->title = $args['title'] ?? '';
    $this->price = $args['price'] ?? '';
    $this->image = $args['image'] ?? '';
    $this->description = $args['description'] ?? '';
    $this->room = $args['room'] ?? '';
    $this->bathroom = $args['bathroom'] ?? '';
    $this->parking = $args['parking'] ?? '';
    $this->created = date('Y/m/d');
    $this->sellerId = $args['sellerId'] ?? '';
  }

  public function validate(): array
  {
    // define error messages
    if (!$this->title) self::$errors['title'] = 'El título es obligatorio';
    if (!$this->price) self::$errors['price'] = 'El precio es obligatorio';
    if (!$this->image) self::$errors['image'] = 'La imagen es obligatoria';
    if (strlen($this->description) < 50)
      self::$errors['description'] = 'La descripción es obligatoria y debe tener, al menos, 50 caracteres';
    if (!$this->room) self::$errors['room'] = 'La cantidad de habitaciones es obligatoria';
    if (!$this->bathroom) self::$errors['bathroom'] = 'La cantidad de baños es obligatoria';
    if (!$this->parking) self::$errors['parking'] = 'La cantidad de estacionamientos es obligatoria';
    if (!$this->sellerId) self::$errors['sellerId'] = 'El/la vendedor/a es obligatorio/a';

    // set errors
    foreach (self::$errors as $error) {
      if (!empty($error)) self::$existErrors = true;
    }
    return self::$errors;
  }

  public function setImage($image)
  {
    // delete prev image
    if ($this->id) $this->deleteImage();
    // set image
    if ($image) $this->image = $image;
  }
}
