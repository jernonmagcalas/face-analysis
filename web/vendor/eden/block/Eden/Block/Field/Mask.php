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
 * Mask Field Block
 *
 * @vendor Eden
 * @package Block
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Mask extends Text 
{
	protected static $loaded = false;

	/**
	 * Returns a template file
	 * 
	 * @param array data
	 * @return string
	 */
	public function getTemplate() 
	{
		return __DIR__.'/mask.phtml';
	}
	
	/**
	 * Returns the template variables in key value format
	 *
	 * @param array data
	 * @return array
	 */
	public function getVariables() 
	{
		$this->attributes['class'] = 'eden-field-mask';
		if(isset($this->attributes['class'])) {
			$this->attributes['class'] = trim($this
			->attributes['class'].' eden-field-mask');
		}
		
		$variables = parent::getVariables();
		
		$variables['pattern'] = $this->pattern;
		$variables['loaded'] = self::$loaded;
		
		self::$loaded = true;
		
		return $variables;
	}

	/**
	 * Sets the data mask
	 *
	 * @param scalar
	 * @return Eden\Block\Field\Mask
	 */
	public function setPattern($pattern) 
	{
		$this->pattern = $pattern;
		return $this;
	}
}