<?php


function getNavigationByUser($userType)
{
  
  
  switch ($userType) {

    case 'pdc': //PDC User Menu
      $navigation = array(
        array('#', 'dashboard', 'Dashboard'),
        array('#', 'cases', 'Companies'),
        array('#', 'school', 'Students'),
        array('#', 'category', 'Job Roles'),
        array('#', 'text_to_speech', 'Advertisements'),
        array('#', 'compare_arrows', 'Requests'),
        array('#', 'manage_accounts', 'Profile')
      );
      return $navigation;
      break;

    case 'company': //Company User Menu
      $navigation = array(
        array(URLROOT.'company', 'dashboard', 'Dashboard'),
        array(URLROOT.'advertisements', 'text_to_speech', 'Advertisements'),
        array(URLROOT.'requests', 'school', 'Student Requests'),
        array(URLROOT.'shortlist', 'list_alt', 'Shortlisted'),
        array(URLROOT.'advertisements', 'calendar_month', 'Schedule'),
        array(URLROOT.'advertisements', 'approval_delegation', 'Complaint'),
        array(URLROOT.'profiles/company-profile', 'manage_accounts', 'Profile')
      );

      return $navigation;
      break;

    case 'student': //Student User Menu
      $navigation = array(
        array('#', 'dashboard', 'Dashboard'),
        array('#', 'cases', 'Companies'),
        array('#', 'manage_accounts', 'Profile'),
        array('#', 'text_to_speech', 'Advertisements'),
        array('#', 'approval_delegation', 'Complaint'),
        array('#', 'calendar_month', 'Schedule')
      );
      return $navigation;
      break;

    default:
    // 4 == Admin
      $navigation = array(
        array('#', 'dashboard', 'Dashboard'),
        array('#', 'cases', 'Companies'),
        array('#', 'school', 'Student'),
        array('#', 'groups', 'PDC'),
        array('#', 'text_to_speech', 'Advertisements'),
        array('#', 'approval_delegation', 'Complaints'),
        array('#', 'monitoring', 'Reports'),
        array('#', 'manage_accounts', 'Profile')
      );
      return $navigation;
  }
}