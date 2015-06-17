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
 * Sort Component Block
 *
 * @vendor Eden
 * @package Block
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Crumbs extends Base 
{
	protected $crumbs = array();
	
	
	/**
	 * Returns the template variables in key value format
	 *
	 * @param string
	 * @param string|null
	 * @return Eden\Block\Component\Crumbs
	 */
	public function add($label, $icon = null, $path = null) 
	{
		Argument::i()->test(1, 'string')->test(2, 'string', 'null');
		
		$this->crumbs[] = array(
			'label' => $label, 
			'icon' 	=> $icon, 
			'path' 	=> $path);
		
		return $this;
	}
	
	/**
	 * Returns the template variables in key value format
	 *
	 * @param array data
	 * @return array
	 */
	public function getVariables() 
	{
		return array('crumbs' => $this->crumbs);
	}
	
	/**
	 * Returns a template file
	 * 
	 * @param array data
	 * @return string
	 */
	public function getTemplate() 
	{
		return __DIR__.'/crumbs.phtml';
	}
	
	/**
	 * Returns the template variables in key value format
	 *
	 * @param array
	 * @return Eden\Block\Component\Crumbs
	 */
	public function set(array $crumbs) 
	{
		$this->crumbs = $crumbs;
		
		return $this;
	}
}