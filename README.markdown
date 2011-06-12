PHPLinq
=======

Technically this isn't a real Language Integrated Query, but it tries to emulate the excellent C# LINQ library.
Still without much functionality and not tested.

Usage
-----

    <?php	
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
    ?>
    
Documentation
-------------

See the [wiki][wiki] for more help

[wiki]: https://github.com/archaeron/PHPLinq/wiki
