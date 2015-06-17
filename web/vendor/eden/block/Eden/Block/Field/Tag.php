<?php //-->
/*
 * This file is part of the Block package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

namespace Eden\Block\Field;

/**
 * Tag Field Block
 *
 * @vendor Eden
 * @package Block
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Tag extends Text 
{
	protected static $loaded = false;
	protected $options	= array();
	
	/**
	 * Returns a template file
	 * 
	 * @param array data
	 * @return string
	 */
	public function getTemplate() 
	{
		return __DIR__.'/tag.phtml';
	}
	
	/**
	 * Returns the template variables in key value format
	 *
	 * @param array data
	 * @return array
	 */
	public function getVariables() 
	{
		if(isset($this->attributes['class'])) {
			$this->attributes['class'] = trim($this
			->attributes['class'].' eden-field-tag');
		} else {
			$this->attributes['class'] = 'eden-field-tag';
		}
		
		$variables = parent::getVariables();
		
		$loaded = self::$loaded;
		self::$loaded = true;
		
		$variables['loaded'] = $loaded;
		$variables['options'] = $this->options;
		
		if(count($variables['options']) == 1) {
			$variables['options'] = $variables['options'][0];
		}
		
		return $variables;
	}
	
	/**
	 * Returns the template variables in key value format
	 * https://github.com/twitter/typeahead.js
	 *
	 * @param string
	 * @param array
	 * @return this
	 */
	public function addOptions($name, array $options) 
	{
		$options['name'] = $name;
		$this->options[] = $options;
		return $this;
	}
}