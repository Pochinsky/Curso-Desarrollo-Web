<?php
require 'app.php';

function includeTemplate(string $name, bool $home = false)
{
  require TEMPLATE_URL . "/$name.php";
}
