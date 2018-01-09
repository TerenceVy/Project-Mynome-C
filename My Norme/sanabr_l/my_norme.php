<?php
#!/usr/bin/env php
// my_norme.php for main in
//
// Made by SANABRIA Luis-Edouard
// Login   <sanabr_l@etna-alternance.net>
//
// Started on  Mon Jan  8 11:35:18 2018 SANABRIA Luis-Edouard
// Last update Mon Jan  8 11:36:18 2018 SANABRIA Luis-Edouard
//

//function to open the file. Returns an array, each element being a line of the file
function open_file_arr($file_to_open) {
  $file = @file($file_to_open);

  if ($file == FALSE) {
    return "Oops ! Something wrong happened : no file found.\n";
  } else {
    return $file;
  }
}

//function to open the file. Returns a string
function open_file_str($file_to_open) {
  $file = @file_get_contents($file_to_open);

  if ($file == FALSE) {
    return "Oops ! Something wrong happened : no file found.\n";
  } else {
    return $file;
  }
}

//function longer than 25 lines
require_once('how_long_func.php');

//wrong header
//number of function per file
require_once('how_many_func.php');

//space at the end of a line
//missing space after keyword
require_once('space_after_keyword.php');

//carriot return twice
//line longer than 80 characters
//more than 4 parameters for a function
//where includes appear
//declare and define a variable on the same line
//Define in .c file
//carriot return between two functions
//tabulation when a variable is declared
//carriot return when variables defined
//display colors for better readability


$file_arr = open_file_arr($argv[1]);
$file_str = open_file_str($argv[1]);

print how_long_func($file_arr);
print how_many_func($file_arr);
print space_after_keyword($file_str);
