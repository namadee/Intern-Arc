<?php


function getNavigationByUser($userType)
{
  
  
  switch ($userType) {

    case 'pdc': //PDC User Menu
      $navigation = array(
        array(URLROOT.'pdc', 'dashboard', 'Dashboard'),
        array(URLROOT.'companies/manage-company', 'cases', 'Companies'),
        array(URLROOT.'students/manage-student', 'school', 'Students'),
        array(URLROOT.'jobroles', 'category', 'Job Roles'),
        array(URLROOT.'advertisements', 'text_to_speech', 'Advertisements'),
        array(URLROOT.'requests/all-requests', 'compare_arrows', 'Requests'),
        array(URLROOT.'profiles/view-profile-details', 'manage_accounts', 'Profile')
      );
      return $navigation;
      break;

    case 'company': //Company User Menu
      $navigation = array(
        array(URLROOT.'companies', 'dashboard', 'Dashboard'),
        array(URLROOT.'advertisements', 'text_to_speech', 'Advertisements'),
        array(URLROOT.'requests', 'school', 'Student Requests'),
        array(URLROOT.'requests/shortlisted-list', 'list_alt', 'Shortlisted'),
        array(URLROOT.'advertisements', 'calendar_month', 'Schedule'),
        array(URLROOT.'advertisements', 'approval_delegation', 'Complaint'),
        array(URLROOT.'profiles/company-profile', 'manage_accounts', 'Profile')
      );

      return $navigation;
      break;

    case 'student': //Student User Menu
      $navigation = array(
        array(URLROOT.'students', 'dashboard', 'Dashboard'),
        array(URLROOT.'companies/view-company-list', 'cases', 'Companies'),
        array(URLROOT.'profiles/student-profile', 'manage_accounts', 'Profile'),
        array(URLROOT.'advertisements/show-student-advertisements', 'text_to_speech', 'Advertisements'),
        array(URLROOT.'complaints', 'approval_delegation', 'Complaint'),
        array(URLROOT.'schedule', 'calendar_month', 'Schedule')
      );
      return $navigation;
      break;

    default:
    // 4 == Admin
      $navigation = array(
        array(URLROOT.'admin', 'dashboard', 'Dashboard'),
        array(URLROOT.'admin/company', 'cases', 'Companies'),
        array(URLROOT.'admin/viewStudentList', 'school', 'Student'),
        array(URLROOT.'admin/viewPdcStaff', 'groups', 'PDC'),
        array(URLROOT.'admin/complaint', 'approval_delegation', 'Complaints'),
        array(URLROOT.'admin/report', 'monitoring', 'Reports'),
        array(URLROOT.'admin/viewprofile', 'manage_accounts', 'Profile')
      );
      return $navigation;
  }
}