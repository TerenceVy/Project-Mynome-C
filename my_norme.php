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

require_once('open_file.php');
require_once('how_long_func.php');

$file = open_file($argv[1]);
print how_long_func($file);
