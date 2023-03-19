<?php

namespace App;

class ActiveRecord
{
  /**
   * Static Attributes
   */
  protected static $db;
  protected static $columns = [];
  protected static $table = '';
  protected static $errors = [];
  protected static $existErrors = false;

  /**
   * Public Attributes
   */

  public $id = '';
  public $image = '';

  /**
   * Setters
   */

  public static function setDatabase($db)
  {
    self::$db = $db;
  }

  /**
   * Getters
   */

  public static function getErrors()
  {
    return static::$errors;
  }

  public static function getExistErrors()
  {
    return static::$existErrors;
  }

  /**
   * Methods
   */

  protected function deleteImage()
  {
    $imageExists = file_exists(IMAGES_FOLDER . $this->image);
    if ($imageExists) unlink(IMAGES_FOLDER . $this->image);
  }

  protected function attributes(): array
  {
    $attrs = [];
    foreach (static::$columns as $column)
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

  protected static function createObject($register)
  {
    $object = new static;
    foreach ($register as $key => $value)
      if (property_exists($object, $key))
        $object->$key = $value;
    return $object;
  }

  protected static function querySQL($query)
  {
    // get all registers as objects
    $result = self::$db->query($query);
    $array = [];
    while ($register = $result->fetch_assoc()) {
      $array[] = static::createObject($register);
    }
    // free memory
    $result->free();
    return $array;
  }

  public static function all()
  {
    $query = "SELECT * FROM " . static::$table;
    $result = self::querySQL($query);
    return $result;
  }

  public static function get($quantity)
  {
    $query = "SELECT * FROM " . static::$table . " LIMIT " . $quantity;
    $result = self::querySQL($query);
    return $result;
  }

  public static function find($id)
  {
    $query = "SELECT * FROM " . static::$table . " WHERE id=$id";
    $result = self::querySQL($query);
    return $result[0];
  }

  protected function create()
  {
    // sanitize data
    $attrs = $this->sanitizeAttributes();

    // insert data
    $query = "INSERT INTO " . static::$table . " (";
    $query .= join(', ', array_keys($attrs));
    $query .= ") VALUES ('";
    $query .= join("', '", array_values($attrs));
    $query .= "')";
    $result = self::$db->query($query);
    if ($result) header("Location: /admin?result=1");
  }

  protected function update()
  {
    // sanitize data
    $attrs = $this->sanitizeAttributes();

    // mapping data
    $values = [];
    foreach ($attrs as $key => $value) $values[] = "$key='$value'";
    $query = "UPDATE " . static::$table . " SET ";
    $query .= join(', ', $values);
    $query .= "WHERE id='" . self::$db->escape_string($this->id) . "' ";
    $query .= "LIMIT 1";
    $result = self::$db->query($query);
    if ($result) header("Location: /admin?result=2");
  }

  public function save()
  {
    if ($this->id) $this->update();
    else $this->create();
  }

  public function delete()
  {
    $query = "DELETE FROM " . static::$table . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
    $result = self::$db->query($query);
    if ($result) {
      $this->deleteImage();
      header('Location: /admin?result=3');
    }
  }

  public function validate(): array
  {
    static::$errors = [];
    foreach (static::$errors as $error) {
      if (!empty($error)) static::$existErrors = true;
    }
    return static::$errors;
  }

  public function sync($args = [])
  {
    foreach ($args as $key => $value)
      if (property_exists($this, $key))
        $this->$key = $value;
  }
}
