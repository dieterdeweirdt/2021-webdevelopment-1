<?php
session_start();

require 'config.php';

require BASE_DIR . '/libs/db.php';
require BASE_DIR . '/libs/router.php';


require BASE_DIR . '/models/BaseModel.php';
require BASE_DIR . '/models/Product.php';

require BASE_DIR . '/controllers/BaseController.php';

