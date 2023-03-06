<?php

function convertSize($bytes, $precision = 2) {

  // defined a list of units in an array
  $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB', 'HB'];

  // 1024 because base used for binary units (Kilo, Mega, Giga, etc.)
  $kilobytes = $bytes / 1024;

  $unitIndex = 0; // define index for search in tab 

  // verify if $kilobytes >= 1024 and verify number units for not exceed the units of the table
  while ($kilobytes >= 1024 && $unitIndex < count($units) - 1) {
    // at each iteration, the file size is divided by 1024, incrementing the index by unit
    $kilobytes /= 1024;
    $unitIndex++;
  }

  // return Kilobytes with precision and units
  return round($kilobytes, $precision) . ' ' . $units[$unitIndex];
}

/*
function convertSize($bytes, $precision = 2) {
  $kilobytes = $bytes / 1024;

  if ($kilobytes < 1024) {
    return round($bytes, $precision) . ' KB';
  }

  $megabytes = $kilobytes / 1024;

  if ($megabytes < 1024) {
    return round($megabytes, $precision) . ' MB';
  }

  $gigabytes = $megabytes / 1024;

  if ($gigabytes < 1024) {
    return round($gigabytes, $precision) . ' GB';
  }

  $terabytes = $gigabytes / 1024;

  if ($terabytes < 1024) {
    return round($terabytes, $precision) . ' TB';
  }

  $petabytes = $terabytes / 1024;

  if ($petabytes < 1024) {
    return round($petabytes, $precision) . ' TB';
  }

  $exabytes = $petabytes / 1024;

  if ($exabytes < 1024) {
    return round($exabytes, $precision) . ' EB';
  }

  $zettabytes = $exabytes / 1024;

  if ($zettabytes < 1024) {
    return round($zettabytes, $precision) . ' ZB';
  }

  $yottabytes = $zettabytes / 1024;

  if ($yottabytes < 1024) {
    return round($yottabytes, $precision) . ' ZB';
  }

  $hellabyte = $yottabytes / 1024;

  if ($hellabyte < 1024) {
    return round($hellabyte, $precision) . ' HB';
  }
  
  return $bytes . ' B';
}

*/
