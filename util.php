<?php
function setFullName($firstName, $middleInitial, $lastName)
{
  if (strlen($middleInitial) == 0) {
    return $firstName . " " . $lastName;
  }

  return $firstName . " " . $middleInitial . ". " . $lastName;
}

function setDate($date) {
  return date_format(date_create_from_format('Y-m-d', $date), 'F d, Y');
}