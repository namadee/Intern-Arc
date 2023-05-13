<?php

// Load Config
require_once 'config/config.php';

//Load Helpers
require_once 'helpers/general_helper.php';
require_once 'helpers/Email.php';
require_once 'helpers/PdfHandler.php';
require_once 'helpers/generator_helper.php';
require_once 'helpers/Session.php';
require_once 'helpers/navigation_helper.php';
require_once 'helpers/flashMessage_helper.php';

//Load PHP Mailer files
require_once '../vendor/autoload.php';

// Autoload Core Libraries
spl_autoload_register(function ($className) {
  require_once 'libraries/' . $className . '.php';
});
