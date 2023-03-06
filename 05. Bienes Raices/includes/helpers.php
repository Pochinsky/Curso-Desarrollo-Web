<?php
require 'app.php';

function includeTemplate(string $name, bool $home = false)
{
  require TEMPLATE_URL . "/$name.php";
}

function numberToCurrency($number): string
{
  return '$ ' . number_format(floatval($number), 0, ',', '.');
}
