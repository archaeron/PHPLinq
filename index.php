<?php

$data = array
	(
		array
		(
			'id' => 4,
			'price' => 200,
			'name' => 'bicycle'
		),
		array
		(
			'id' => 5,
			'price' => 300,
			'name' => 'dog'
		),
		array
		(
			'id' => 2,
			'price' => 700,
			'name' => 'car'
		),
		array
		(
			'id' => 6,
			'price' => 400,
			'name' => 'computer'
		),
	);

echo '<pre>';
$data2 = unserialize('a:4:{i:0;O:8:"stdClass":3:{s:2:"id";s:1:"4";s:5:"price";s:3:"200";s:4:"name";s:7:"bicycle";}i:1;O:8:"stdClass":3:{s:2:"id";s:1:"5";s:5:"price";s:3:"300";s:4:"name";s:3:"dog";}i:2;O:8:"stdClass":3:{s:2:"id";s:1:"2";s:5:"price";s:3:"700";s:4:"name";s:3:"car";}i:3;O:8:"stdClass":3:{s:2:"id";s:1:"6";s:5:"price";s:3:"400";s:4:"name";s:8:"computer";}}');

include('phpquery.php');

use \PHPQuery\PHPQuery;

$l = new PHPQuery();
$l->from($data);
$l->where('id', function($a){ return $a != 5; });
$l->where('price', function($p){return $p > 300;});
$l->select('id', 'name');

echo '<pre>';
foreach($l as $i)
{
	//var_dump($i);
}

//var_dump($l->to_array());
//var_dump($l->to_array(true));

//$t1 = microtime(true);
//$l->order_by('name');
//$t2 = microtime(true);


//var_dump($l->to_array());


echo '</pre>';

$l = new PHPQuery();
$l->from($data2);
$l->where('id', function($a){ return $a != 5; });
$l->where('price', function($p){return $p > 300;});
$l->select('id', 'name');

echo '-----<br />';

echo '<pre>';
foreach($l as $i)
{
	var_dump($i);
}

//var_dump($l->to_array());
//var_dump($l->to_array(true));

//$t1 = microtime(true);
$l->order_by('name', false);
//$t2 = microtime(true);


var_dump($l->to_array());


echo '</pre>';

?>