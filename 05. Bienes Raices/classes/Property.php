<?php

namespace App;

class Property
{
  // static attributes
  protected static $db;
  protected static $columns = [
    'id', 'title', 'price', 'image', 'description', 'room', 'bathroom', 'parking', 'created', 'sellerId'
  ];
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
  protected static $existErrors = false;

  // attributes
  protected $id;
  protected $title;
  protected $price;
  protected $image;
  protected $description;
  protected $room;
  protected $bathroom;
  protected $parking;
  protected $created;
  protected $sellerId;

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

  // setters

  public static function setDatabase($db)
  {
    self::$db = $db;
  }

  public function setImage($image)
  {
    if ($image) $this->image = $image;
  }

  // getters

  public static function getErrors()
  {
    return self::$errors;
  }

  public static function getExistErrors()
  {
    return self::$existErrors;
  }

  // methods

  protected function attributes(): array
  {
    $attrs = [];
    foreach (self::$columns as $column)
      if ($column !== 'id')
        $attrs[$column] = $this->$column;
    return $attrs;
  }

  protected function sanitizeAttributes(): array
  {
    $attrs = $this->attributes();
    $sanitize = [];

    foreach ($attrs as $key => $value)
      $sanitize[$key] = self::$db->escape_string($value);
    return $sanitize;
  }

  public function save()
  {
    // sanitize data
    $attrs = $this->sanitizeAttributes();

    // insert data
    $query = "INSERT INTO property (";
    $query .= join(', ', array_keys($attrs));
    $query .= ") VALUES ('";
    $query .= join("', '", array_values($attrs));
    $query .= "')";
    $result = self::$db->query($query);
    return $result;
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

    // insert data
    foreach (self::$errors as $error) {
      if (!empty($error)) self::$existErrors = true;
    }
    return self::$errors;
  }
}
