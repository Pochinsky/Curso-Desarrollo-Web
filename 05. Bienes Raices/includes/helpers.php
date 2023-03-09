<?php

// constants

define('TEMPLATE_URL', __DIR__ . '/templates');
define('HELPERS_URL', __DIR__ . '/helpers.php');
define('IMAGES_FOLDER', __DIR__ . '/../images/');

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
