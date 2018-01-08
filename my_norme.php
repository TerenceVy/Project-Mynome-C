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

//function which opens the file. Variable is a string returned by the function
//function longer than 25 lines
//wrong header
//number of function per file
//space at the end of a line
//missing space after keyword
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

require_once('open_file.php');
require_once('how_long_func.php');
require_once('how_many_func.php');
require_once('space_after_keyword.php');

$file = open_file($argv[1]);
print how_long_func($file);
print how_many_func($file);
space_after_keyword($file);
