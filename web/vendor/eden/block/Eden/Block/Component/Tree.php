<?php //-->
/*
 * This file is part of the Block package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

namespace Eden\Block\Component;

use Eden\Block\Base;
use Eden\Block\Argument;

/**
 * Tree Component Block
 *
 * @vendor Eden
 * @package Block
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Tree extends Base 
{
	protected static $loaded = false;
	
	protected $root = null;
	protected $tree = array();
	protected $handle = null;
	protected $callback = null;
	
	/**
	 * Contructor - Need to know if this is the first time
	 * because it's a recursive call
	 *
	 * @param string|null
	 */
	public function __construct($root = null) 
	{
		$this->root = $root;
		$this->callback = array($this, 'defaultRender');
	}
	
	/**
	 * Adds item to the tree
	 *
	 * @param string
	 * @param mixed
	 * @return array
	 */
	public function addItem($path, $object = array(), $class = null) 
	{
		$path = explode('/', $path);
		
		$object['class'] = $class;
		
		$args = array();
		foreach($path as $key) {
			$args[] = $key;
			$args[] = 'children';	
		}
		
		//soft inject
		$tree = eden('registry', $this->tree);
		$last = count($args);
		foreach($object as $key => $value) {
			$args[$last - 1] = $key;
			$args[$last] = $value;
			$tree->callArray('set', $args);
		}
		
		$this->tree = $tree->getArray();
		return $this;
	}
	
	/**
	 * Enable Toggling
	 *
	 * @param string selector
	 * @return Eden\Block\Component\Tree
	 */
	public function canToggle($selector) 
	{
		$this->handle = $selector;
		return $this;
	}
	
	/**
	 * Returns a template file
	 * 
	 * @param array data
	 * @return string
	 */
	public function getTemplate() 
	{
		return __DIR__.'/tree.phtml';
	}
	
	/**
	 * Returns the template variables in key value format
	 *
	 * @param array data
	 * @return array
	 */
	public function getVariables() 
	{ 
		$loaded = self::$loaded;
		
		if(trim($this->handle)) {
			self::$loaded = true;
		}
		
		return array(
			'loaded'	=> $loaded,
			'root'		=> $this->root,
			'rows' 		=> $this->tree,
			'handle'	=> $this->handle, 
			'callback' 	=> $this->callback);
	}
	
	/**
	 * Returns default item template
	 *
	 * @param string
	 * @param mixed
	 * @return string
	 */
	public function defaultRender($path, $item) 
	{
		return $path;
	}
	 
	/**
	 * Sets item callback
	 *
	 * @param callable
	 * @return Eden\Block\Component\Tree
	 */
	public function setCallback($callable) 
	{
		Argument::i()->test(1, 'callable');
		
		$this->callback = $callable;
		
		return $this;
	}
	
	/**
	 * Sets the entire tree data
	 *
	 * @param array
	 * @return Eden\Block\Component\Tree
	 */
	public function setData(array $tree) 
	{
		$this->tree = $tree;
		return $this;
	}
}