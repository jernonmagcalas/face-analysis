<?php //-->
/*
 * This file is part of the Block package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

namespace Eden\Block\Field;

use Eden\Block\Argument;

/**
 * Textarea Field Block
 *
 * @vendor Eden
 * @package Block
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Wysiwyg extends Textarea 
{
	protected static $loaded = false;
	protected $options = array();
	
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
			->attributes['class'].' eden-field-wysiwyg form-control');
		} else {
			$this->attributes['class'] = 'eden-field-wysiwyg form-control';
		}
		
		$loaded = self::$loaded;
		self::$loaded = true;
		
		return array(
			'loaded'		=> $loaded,
			'options'		=> $this->options,
			'attributes' 	=> $this->attributes,
			'value'			=> $this->value);
	}
	
	/**
	 * Returns a template file
	 * 
	 * @param array data
	 * @return string
	 */
	public function getTemplate() 
	{
		return __DIR__.'/wysiwyg.phtml';
	}
	
	/**
	 * Set Options
	 *
	 * @param string|array
	 * @param scalar
	 * @return this
	 */
	public function setOptions($option, $value = null) 
	{
		Argument::i()
			->test(1, 'array', 'string')
			->test(2, 'scalar', 'null');
		
		if(is_array($option)) {
			$this->options = $option;
			return $this;
		}
		
		$this->options[$option] = $value;
		return $this;
	}
	
}