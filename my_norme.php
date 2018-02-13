<?php
$compt_faute = 0;

//function longer than 25 lines
function how_long_func($file)
{
	global $compt_faute;
  $i = 0;
  $j = 0;
  $k = 0;
  $mistake = 0;
  $begin_func = '/^(void)[\ ]+[a-z\_]+[\(][a-z]+[\ ][a-z\*]+(\))/';

  while ($i < sizeof($file))
  {
    if (preg_match($begin_func, $file[$i]))
      $j = $i;
    if (preg_match('/(\{)/', $file[$i]))
      ++$k;
    if (preg_match('/(\})/', $file[$i]))
      --$k;
    if ($k == 0)
    {
      if ($i - $j > 27)
      {
        $mistake = $mistake + $i - $j - 27;
        $line = $i - $mistake + 1;
        print "Erreur a partir de la ligne ".$line.", trop de ligne.\n";
      }
      $j = $i;
    }
    ++$i;
  }
	$compt_faute += $mistake;
  return $mistake;
}

//Number of function in a file
function how_many_func($file)
{
	global $compt_faute;
  $type = '(int|char|void|float|double|long double)';
  $decl_fun1 = '/^'.$type.'[\ ]+[\*]*[a-z\_]+(\()'.$type.'+[\ ][a-z\*]+(\))$/';
  $decl_fun2 = '/^'.$type.'[\ ]+[\*]*[a-z\_]+(\(\))$/';
  $decl_main = '/^'.$type.'[\ ]+[\*]*(main)$/';
  $mistake = 0;

  for ($i = 0; isset($file[$i]); ++$i)
  {
    if (preg_match($decl_fun1, $file[$i]))
      if (preg_match($decl_main, $file[$i]) == FALSE)
      {
        ++$mistake;
        if ($mistake > 5)
          print "Erreur a la ligne ".($i + 1).", une fonction de trop.\n";
      }
    else if (preg_match($decl_fun2, $file[$i]))
      if (preg_match($decl_main, $file[$i]) == FALSE)
      {
        ++$mistake;
        if ($mistake > 5)
          print "Erreur a la ligne ".($i + 1).", une fonction de trop.\n";
      }
  }
  if ($mistake > 5) {
		$compt_faute += $mistake;
    return $mistake - 5;
	}
  else
    return 0;
}

//Space at the end of a line
function white_space_on_line($line)
{
	global $compt_faute;
	$faute = 0;
	foreach ($line as $value)
	{
		if (preg_match('/ $/',$value))
			++$faute;
	}
	echo "Espace en fin de ligne : " . $faute . " fautes\n";
	$compt_faute += $faute;
}

//Missing space after a keyword
function space_after_keyword($file)
{
	global $compt_faute;
  $keyword = array("auto", "break", "case", "char", "const", "continue",
  "default", "double", "else", "enum", "extern", "float", "for", "if", "int",
  "long", "register", "return", "short", "signed", "static", "struct",
  "typedef", "union", "unsigned", "void", "volatile", "while");
  $i = 0;
  $j = 0;
  $mistake = 0;

  while ($i < sizeof($file))
  {
    while ($j < sizeof($keyword))
    {
      if (preg_match("/\b(".$keyword[$j].")[^\ ]/", $file[$i]))
      {
        ++$mistake;
        print "Erreur a la ligne ".$i.", espace manquant apres un mot-cle.\n";
      }
      ++$j;
    }
    $j = 0;
    ++$i;
  }
	$compt_faute += $mistake;
  return $mistake;
}

//double return twice
function double_return($line)
{
	global $compt_faute;
	$faute = 0;
	foreach ($line as $value)
	{
		if (preg_match('/^\n/', $value))
			++$faute;
	}
		echo "Double retour à la ligne : " . $faute . "fautes\n";
		$compt_faute += $faute;
}

//Line longer than 80 characters
function beyond_eighty($file_arr)
{
	global $compt_faute;
  $mistake = 0;

  for ($i = 0; $i < sizeof($file_arr); ++$i)
  {
    if (preg_match('/^(\/\/)/', $file_arr[$i]) == FALSE)
    {
      if (strlen($file_arr[$i]) > 80)
      {
        print "Erreur a la ligne ".$i.", trop de caracteres pour la ligne.\n";
        $mistake += strlen($file_arr[$i]) - 80;
      }
    }
    ++$i;
  }
	$compt_faute += $mistake;
  return $mistake;
}

//Check where includes appear
function order_incl($file)
{
	global $compt_faute;
  $i = 0;
  $j = 0;
  $mistake = 0;
  $begin_func = '/^(void)[\ ]+[a-z\_]+[\(][a-z]+[\ ][a-z\*]+(\))/';
  $check_incl = '/^(#include)/';

  while (isset($file[$i]))
  {
    if (preg_match($begin_func, $file[$i]))
      ++$j;
    if ($j !== 0)
      if (preg_match($check_incl, $file[$i]))
        ++$mistake;
    ++$i;
  }
	$compt_faute += $mistake;
  return $mistake;
}

//Declare and define on the same line
function declar_affect($line)
{
	global $compt_faute;
	$faute = 0;
	foreach ($line as $value)
	{
		if(preg_match('/int|tab|float|char|doublefloat|long|signed|unsigned|short|double/', $value))
		{
			if(preg_match('/=/',$value))
				++$faute;
		}
	}
	echo "Déclaration + Affectation même ligne : " . $faute . "fautes\n";
	$compt_faute += $faute;
}

//Define in a source file
function define_in_source_file($file)
{
	global $compt_faute;
  $i = 0;
  $mistake = 0;
  $check_define = '/^(#define )/';

  while (isset($file[$i]))
  {
    if (preg_match($check_define, $file[$i]))
      ++$mistake;
    ++$i;
  }
	$compt_faute += $mistake;
  return $mistake;
}

//Carriot return between two functions
function two_return_func($line)
{
	global $compt_faute;
	$faute = 0;
	foreach ($line as $value)
	{
		if (preg_match('/}/', $value))
		{
			++$value;
			if (preg_match('/(^void|int|char)/', $value) )
				++$faute;
		}
	}
	echo "Retour à la ligne entre 2 fonctions : " . $faute . " fautes\n";
	$compt_faute += $faute;
}

$dir = $argv[1];
$files = scandir($dir); // pour tous les fichiers

for ($i = 0; $i < count($files); $i++)
{
	$compteur = 0;
	if (preg_match('/(\.c|\.h)$/', $files[$i]))
	{
		$line = file($files[$i]);
		$last_line = count($line);
		how_long_func($line);
		how_many_func($line);
		white_space_on_line($line);
		space_after_keyword($line);
		double_return($line);
		beyond_eighty($line);
		order_incl($line);
		declar_affect($line);
		define_in_source_file($line);
		two_return_func($line);
		print $compt_faute."\n";
		$compt_faute = 0;
	}
}
