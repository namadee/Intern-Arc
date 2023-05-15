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


function isCurrentDateWithinRound($startDate, $endDate)
{
  date_default_timezone_set('Asia/Colombo');
  $currentDate = date("Y-m-d");
  if ($startDate <= $currentDate && $endDate >= $currentDate) {

    return TRUE;
  } else {
    //Either round dates are not set or currentDate in not during the round period
    return FALSE;
  }
}

function roundCheckFunction()
{
  $roundTableData = $_SESSION['roundTableData'];
  date_default_timezone_set('Asia/Colombo');
  $currentDate = date("Y-m-d");

 

  $isRoundOneSet = isCurrentDateWithinRound($roundTableData[0]->start_date, $roundTableData[0]->end_date);
  $isRoundTwoSet = isCurrentDateWithinRound($roundTableData[1]->start_date, $roundTableData[1]->end_date);

  if ($isRoundOneSet) {
    $roundNumber = 1;
    $disabledClass = "disabled-button-style";
    $hrefStatus = "javascript:void(0)";
  } else if ($isRoundTwoSet) {
    $roundNumber = 2;
    $disabledClass = "disabled-button-style";
    $hrefStatus = "javascript:void(0)";
  } else {
    //Either round dates are not set or currentDate in not during the round period
    $roundNumber = NULL; //No need of constraints
    $disabledClass = "disabled-button-style";
    $hrefStatus = "javascript:void(0)";
  }


  $roundDataArray = [
    'roundNumber' => $roundNumber,
    'roundTableData' => $roundTableData,
    'currentDate' => $currentDate,
    'disabledClass' => $disabledClass,
    'hrefStatus' => $hrefStatus
  ];

  return $roundDataArray;
}
