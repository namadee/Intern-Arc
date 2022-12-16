<?php

  // Load Config
  require_once 'config/config.php';

  //Load Helpers
  require_once 'helpers/url_helper.php';
  require_once 'helpers/Email.php';
  require_once 'helpers/validation_helper.php';
  require_once 'helpers/Session.php';
  require_once 'helpers/navigation_helper.php';


  //Load PHP Mailer files
  require_once '../vendor/autoload.php';

  // Autoload Core Libraries
  spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';
  });
  
