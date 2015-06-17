<?php //-->
/*
 * This file is part of the Block package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

namespace Eden\Block\Form;

use Eden\Block\Base;
use Eden\Block\Argument;

/**
 * Search Form Block
 *
 * @vendor Eden
 * @package Block
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Search extends Base 
{
	protected $attributes = array();
	protected $useIcon = false;
	
	/**
	 * Returns a template file
	 * 
	 * @param array data
	 * @return string
	 */
	public function getTemplate() 
	{
		return __DIR__.'/search.phtml';
	}
	
	/**
	 * Returns the template variables in key value format
	 *
	 * @param array data
	 * @return array
	 */
	public function getVariables() 
	{
		return array(
			'attributes' => $this->attributes, 
			'use_icon' => $this->useIcon);
	}
	
	/**
	 * Returns the template variables in key value format
	 *
	 * @param string|array
	 * @param scalar|null
	 * @return Eden\Block\Form\Search
	 */
	public function setAttributes($name, $value = null) 
	{
		Argument::i()
			->test(1, 'string', 'array')
			->test(2, 'scalar', 'null');
		
		if(is_array($name)) {
			$this->attributes = $name;
			return $this;
		}
		
		$this->attributes[$name] = $value;
		return $this;
	}
	
	/**
	 * Sets the place holder
	 *
	 * @param scalar
	 * @return Eden\Block\Form\Search
	 */
	public function setHolder($holder) 
	{
		return $this->setAttributes('placeholder', $holder);
	}
	
	/**
	 * Sets the field name
	 *
	 * @param scalar
	 * @return Eden\Block\Form\Search
	 */
	public function setName($name) 
	{
		return $this->setAttributes('name', $name);
	}
	
	/**
	 * Sets the field value
	 *
	 * @param scalar
	 * @return Eden\Block\Form\Search
	 */
	public function setValue($value) 
	{
		return $this->setAttributes('value', $value);
	}
	
	/**
	 * Use icon for the button instead of text
	 *
	 * @return Eden\Block\Form\Search
	 */
	public function useIcon() 
	{
		$this->useIcon = true;
		return $this;
	}
}