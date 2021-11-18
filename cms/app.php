<?php

//App base path
CONST BASE_PATH = __DIR__ . '/';

//load config 
require BASE_PATH . 'config.php';

//load models
require BASE_PATH . 'models/base_model.php';
require BASE_PATH . 'models/brand.php';
require BASE_PATH . 'models/product.php';

//load controllers
require BASE_PATH . 'controllers/db.php';
require BASE_PATH . 'controllers/product.php';