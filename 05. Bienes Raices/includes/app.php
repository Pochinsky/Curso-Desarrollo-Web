<?php

// requires

require 'helpers.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

use App\Property;

// connect database

Property::setDatabase(connectDatabase());
