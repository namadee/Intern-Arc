<?php
session_start();
  // Load Config
  require_once 'config/config.php';
  require_once 'helpers/url_helper.php';
  require_once 'helpers/navigation_helper.php';

  // Autoload Core Libraries
  spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';
  });
  
