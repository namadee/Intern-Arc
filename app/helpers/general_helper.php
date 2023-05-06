<?php
// Simple page redirect
function redirect($page)
{
  header('location: ' . URLROOT . $page);
}


function stripTags()
{
  foreach ($_POST as $key => $value) {
    $_POST[$key] = strip_tags($value);
  }
}

//Round Selection Function
// For constraints, the round is set
function roundCheckFunction()
{
  $roundTableData = $_SESSION['roundTableData'];
  date_default_timezone_set('Asia/Colombo');
  $currentDate = date("Y-m-d");

  $disabledClass = "disabled-button-style";
  $hrefStatus = "javascript:void(0)";
  if ($roundTableData[0]->start_date <= $currentDate && $roundTableData[0]->end_date >= $currentDate) {
    $roundNumber = 1;
  } else if ($roundTableData[1]->start_date <= $currentDate && $roundTableData[1]->end_date >= $currentDate) {
    $roundNumber = 2;
  } else {
    //Either round dates are not set or currentDate in not during the round period
    $roundNumber = NULL; //No need of constraints
    $disabledClass = "";
    $hrefStatus = "";
  }


  $roundDataArray = [
    'roundNumber' => $roundNumber,
    'roundTableData' => $roundTableData,
    'currentDate' => $currentDate,
    'disabledClass' => $disabledClass,
    'hrefStatus' => $hrefStatus
  ];

  return $roundDataArray;



  // if ($roundPeriodsDetails[0]->start_date <= $currentDate && $roundPeriodsDetails[0]->end_date >= $currentDate) {
  //   SESSION::setValues('roundNumber', 1);
  //   SESSION::setValues('hrefStatus', "javascript:void(0)");
  //   //Update Company System Access to 1 automatically when the round starts
  //   $this->companyModel->updateCompanyAccess(1);
  //   //Update Student System Access to 1 automatically when the round starts



  // } else if ($roundPeriodsDetails[1]->start_date <= $currentDate && $roundPeriodsDetails[1]->end_date >= $currentDate) {
  //   SESSION::setValues('roundNumber', 2);
  //   SESSION::setValues('hrefStatus', "javascript:void(0)");
  // } else {
  //   SESSION::setValues('roundNumber', NULL);
  //   SESSION::setValues('hrefStatus', NULL);
  //   SESSION::setValues('hrefStatus', NULL);
  // }
}
