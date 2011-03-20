<?php

namespace PHPQuery;

include "phpqueryarray.php";
include 'phpqueryobject.php';


class PHPQuery implements \Iterator
{
	
	private $_type;
	
	function from($array)
	{
		foreach($array as $elem)
		{
			if(is_array($elem))
			{
				$this->_type = new PHPQueryArray();
			}
			else
			{
				$this->_type = new PHPQueryObject();
			}
			break;
		}
		$this->_type->from($array);
	}
	
	function where($name, $where_function)
	{
		$this->_type->where($name, $where_function);
	}
	
	function select()
	{
		$this->_type->select(func_get_args());
	}
	
	function current()
	{
		return $this->_type->current();
	}
	
	function next()
	{
		$this->_type->next();
	}
	
	function key()
	{
		return $this->_type->key();
	}
	
	function valid()
	{
		return $this->_type->valid();
	}
	
	function rewind()
	{
		$this->_type->rewind();
	}
	
	function to_array($preserve_keys = false)
	{
		return $this->_type->to_array($preserve_keys);
	}
	
	function order_by($order_key, $ascending = true)
	{
		$this->_type->order_by($order_key, $ascending);
	}
}

?>