<?php
// constants
define('TEMPLATE_URL', __DIR__ . '/templates');
define('HELPERS_URL', __DIR__ . '/helpers.php');
// functions

function includeTemplate(string $name, bool $home = false)
{
  require TEMPLATE_URL . "/$name.php";
}

function numberToCurrency($number): string
{
  return '$ ' . number_format(floatval($number), 0, ',', '.');
}
