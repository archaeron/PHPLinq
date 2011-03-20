PHPLinq
=======

Technically this isnt a real Language Integrated Query, but it tries to emulate the excellent C# LINQ library.
Still without much functionality and not tested.

Usage
-----

    $sample_data = array
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
	
    $query = new PHPQuery();
	
    $query->from($sample_data);
    $query->where('id', function($a){ return $a != 5; });
    $query->where('price', function($p){return $p > 300;});
    $query->select('id', 'name');
    // or: $query->select(array('id', 'name'));
    
    foreach($query as $elem)
    {
        var_dump($elem);
    }
    
    // result
    array(2) {
      ["id"]=>
      int(4)
      ["name"]=>
      string(7) "bicycle"
    }
    array(2) {
      ["id"]=>
      int(6)
      ["name"]=>
      string(8) "computer"
    }