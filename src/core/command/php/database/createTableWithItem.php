<?php

require('../../../component/Loader.php');

$loader = new Loader();

$options = getopt('n:');

if(!isset($option['n']))
	echo "Argument -n missing\n";exit;

var_dump($_GET);
var_dump($options);