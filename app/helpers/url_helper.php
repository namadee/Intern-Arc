<?php
// Simple page redirect
function redirect($page)
{
  header('location: ' . URLROOT . $page);
}


function stripTags()
{
  foreach ($_POST as $key => $value) 
  {
    $_POST[$key] = strip_tags($value);
  }
}
