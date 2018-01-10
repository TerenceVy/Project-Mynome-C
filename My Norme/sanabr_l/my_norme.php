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
function open_file_arr($file_to_open)
{
  $file = @file($file_to_open);

  if ($file == FALSE)
    return "Oops ! Something wrong happened : no file found.\n";
  else
    return $file;
}

//function to open the file. Returns a string
function open_file_str($file_to_open)
{
  $file = @file_get_contents($file_to_open);

  if ($file == FALSE)
    return "Oops ! Something wrong happened : no file found.\n";
  else
    return $file;
}

$file_arr = open_file_arr($argv[1]);
$file_str = open_file_str($argv[1]);
var_dump($file_str);

//function longer than 25 lines
require_once('how_long_func.php');
print "Nombre de ligne en trop pour une fonction => ".how_long_func($file_arr)."\n";

//wrong header
//number of function per file
require_once('how_many_func.php');
print "Nombre fonction en trop => ".how_many_func($file_arr)."\n";

//space at the end of a line
//missing space after keyword
require_once('space_after_keyword.php');
print "Espace apres mot cle => ".space_after_keyword($file_str)."\n";

//carriot return twice
//line longer than 80 characters
require_once('beyond_eighty.php');
print "Plus de 80 caracteres sur une ligne => ".beyond_eighty($file_arr)."\n";

//more than 4 parameters for a function
//where includes appear
require_once('order_incl.php');
print "Des includes mal places => ".order_incl($file_arr)."\n";

//declare and define a variable on the same line
//Define in source file
require_once('define_in_source.php');
print "Des defines dans le code source => ".define_in_source_file($file_arr)."\n";

//carriot return between two functions
//tabulation when a variable is declared
require_once("tab_in_declaration.php");
print "Manque de tabulation dans les variables => ".tab_in_declaration($file_str)."\n";

//carriot return when variables defined
//display colors for better readability
