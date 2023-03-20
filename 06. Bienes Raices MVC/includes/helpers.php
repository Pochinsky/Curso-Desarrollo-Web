<?php

// constants

define('TEMPLATE_URL', __DIR__ . '/templates');
define('HELPERS_URL', __DIR__ . '/helpers.php');
define('IMAGES_FOLDER', $_SERVER['DOCUMENT_ROOT'] . '/images/');

// functions

function includeTemplate(string $name, bool $home = false)
{
  require TEMPLATE_URL . "/$name.php";
}

function numberToCurrency($number): string
{
  return '$ ' . number_format(floatval($number), 0, ',', '.');
}

function isAuthenticated()
{
  session_start();
  if (!$_SESSION['login']) header('Location: /');
}

function debug($var)
{
  echo '<pre>';
  var_dump($var);
  echo '</pre>';
  exit;
}

function sanitize($html): string
{
  $sanitized = htmlspecialchars($html);
  return $sanitized;
}

function validateTypeContent($type)
{
  $types = ['property', 'seller'];
  return in_array($type, $types);
}

function showNotificacion($code)
{
  $message = '';
  switch ($code) {
    case 1:
      $message = 'Creado Correctamente';
      break;
    case 2:
      $message = 'Actualizado Correctamente';
      break;
    case 3:
      $message = 'Eliminado Correctamente';
      break;
    default:
      $message = false;
      break;
  }
  return $message;
}

function validateOrRedirect(string $url)
{
  $id = $_GET['id'];
  $id = filter_var($id, FILTER_VALIDATE_INT);
  if (!$id) header("Location: $url");
  return $id;
}
