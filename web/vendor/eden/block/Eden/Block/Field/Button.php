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
 * Button Field Block
 *
 * @vendor Eden
 * @package Block
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Button extends Textarea 
{
	/**
	 * Returns a template file
	 * 
	 * @param array data
	 * @return string
	 */
	public function getTemplate() 
	{
		return __DIR__.'/button.phtml';
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
			$this->attributes['class'] = trim($this->attributes['class'].' btn');
		} else {
			$this->attributes['class'] = 'btn';
		}
		
		return array(
			'attributes' 	=> $this->attributes,
			'value'			=> $this->value);
	}
}