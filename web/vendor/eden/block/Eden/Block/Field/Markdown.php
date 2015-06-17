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
class Markdown extends Textarea 
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
		$this->attributes['data-provide'] = 'markdown';
		
		if(isset($this->attributes['class'])) {
			$this->attributes['class'] = trim($this
			->attributes['class'].' eden-field-markdown form-control');
		} else {
			$this->attributes['class'] = 'eden-field-markdown form-control';
		}
		
		$loaded = self::$loaded;
		self::$loaded = true;
		
		return array(
			'loaded'		=> $loaded,
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
		return __DIR__.'/markdown.phtml';
	}
}