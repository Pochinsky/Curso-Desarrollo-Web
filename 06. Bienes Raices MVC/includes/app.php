<?php

// requires

require 'helpers.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

use Model\ActiveRecord;

// connect database

ActiveRecord::setDatabase(connectDatabase());
