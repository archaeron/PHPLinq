<?php

namespace PHPQuery;

class PHPQueryArray implements \Iterator
{
	private $_array;
	private $_where = array();
	private $_select = array();
	private $_position;
	
	function from($array)
	{
		$this->_array = $array;
		$this->_where = array();
		$this->_select = array();
		$this->_position = 0;
		return $this;
	}
	
	function where($name, $where_function)
	{
		$this->_where[$name] = $where_function;
		return $this;
	}
	
	function select()
	{
		$args_list = func_get_args();
		$num_args = func_num_args();
		
		if($num_args > 0)
		{
			if( is_array($args_list[0]) )
			{
				$this->_select = $args_list[0];
			}
			else
			{
				foreach($args_list as $arg)
				{
					$this->_select[] = $arg;
				}
			}
		}
	}
	
	function current()
	{
		if(count($this->_select) > 0)
		{
			foreach($this->_select as $s)
			{
				$result[$s] = $this->_array[$this->_position][$s];
			}
			return $result;
		}
		else
		{
			return $this->_array[$this->_position];
		}
	}
	
	function next()
	{
		if(count($this->_where) > 0)
		{
			$array_count = count($this->_array);
			foreach($this->_where as $key => $function)
			{
				$this->_position++;
				if($this->_position >= $array_count)
				{
					break;
				}
				while(! ($function($this->_array[$this->_position][$key])) && ( ++$this->_position < $array_count ))
				{

				}
			}
		}
		else
		{
			$this->_position++;
		}
	}
	
	function key()
	{
		return $this->_position;
	}
	
	function valid()
	{
		return $this->_position < count($this->_array);
	}
	
	function rewind()
	{
		$this->_position = 0;
	}
	
	function to_array($preserve_keys)
	{
		if($preserve_keys)
		{
			foreach($this as $key => $element)
			{
				$result[$key] = $element;
			}
		}
		else
		{
			foreach($this as $element)
			{
				$result[] = $element;
			}
		}
		return $result;
	}
	
	function order_by($order_key, $ascending)
	{
		$to_sort = $this->to_array(false);
		usort($to_sort, function($a, $b) use ($order_key, $ascending)
			{
				$a_val = $a[$order_key];
				$b_val = $b[$order_key];
				if($a_val === $b_val)
				{
					return 0;
				}
				if($ascending)
				{
					return $a_val < $b_val ? -1 : 1;
				}
				else
				{
					return $a_val > $b_val ? -1 : 1;
				}
			}
		);
		$this->_array = $to_sort;
		$this->_where = array();
		$this->_select = array();
	}
}

?>