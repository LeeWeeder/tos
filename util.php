<?php
function setFullName($firstName, $middleInitial, $lastName)
{
  if (strlen($middleInitial) == 0) {
    return $firstName . " " . $lastName;
  }

  return $firstName . " " . $middleInitial . ". " . $lastName;
}
