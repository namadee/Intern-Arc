<?php


function getNavigationByUser($userType)
{
  
  
  switch ($userType) {

    case 'pdc': //PDC User Menu
      $navigation = array(
        array('#', 'dashboard', 'Dashboard'),
        array('#', 'contact_phone', 'Manage Company'),
        array('#', 'school', 'Manage Student'),
        array('#', 'work', 'Job Roles'),
        array('#', 'text_to_speech', 'Advertisements'),
        array('#', 'compare_arrows', 'Requests'),
        array('#', 'manage_accounts', 'Profile')
      );
      return $navigation;
      break;

    case 'company': //Company User Menu
      $navigation = array(
        array('#', 'dashboard', 'Admin'),
        array('#', 'contact_phone', 'Manage Company'),
        array('#', 'school', 'Manage Student'),
        array('#', 'work', 'Job Roles'),
        array('#', 'text_to_speech', 'Advertisements'),
        array('#', 'compare_arrows', 'Requests'),
        array('#', 'manage_accounts', 'Profile')
      );

      return $navigation;
      break;

    case 'student': //Student User Menu
      $navigation = array(
        array('#', 'dashboard', 'Student'),
        array('#', 'contact_phone', 'Manage Company'),
        array('#', 'school', 'Manage Student'),
        array('#', 'work', 'Job Roles'),
        array('#', 'text_to_speech', 'Advertisements'),
        array('#', 'compare_arrows', 'Requests'),
        array('#', 'manage_accounts', 'Profile')
      );
      return $navigation;
      break;

    default:
    // 4 == Admin
      $navigation = array(
        array('admin/dashboard', 'dashboard', 'Company'),
        array('admin/company  ', 'contact_phone', 'Manage Company'),
        array('#', 'school', 'Manage Student'),
        array('#', 'work', 'Job Roles'),
        array('#', 'text_to_speech', 'Advertisements'),
        array('#', 'compare_arrows', 'Requests'),
        array('#', 'manage_accounts', 'Profile')
      );
      return $navigation;
  }
}
