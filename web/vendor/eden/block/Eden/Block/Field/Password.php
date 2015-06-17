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
 * Password Field Block
 *
 * @vendor Eden
 * @package Block
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Password extends Text 
{
	protected static $loaded = false;
	
	protected $type = 'password';
	protected $useMask = false;
	
	/**
	 * Returns a template file
	 * 
	 * @param array data
	 * @return string
	 */
	public function getTemplate() 
	{
		return __DIR__.'/password.phtml';
	}
	
	/**
	 * Returns the template variables in key value format
	 *
	 * @param array data
	 * @return array
	 */
	public function getVariables() 
	{
		if(!$this->useMask) {
			return parent::getVariables();
		}
		
		if(isset($this->attributes['class'])) {
			$this->attributes['class'] = trim($this
			->attributes['class'].' eden-field-password');
		} else {
			$this->attributes['class'] = 'eden-field-password';
		}
		
		$variables = parent::getVariables();
		$variables['loaded'] = self::$loaded;
		self::$loaded = true;
		
		return $variables;
	}
	
	/**
	 * Turn on Apple like Masking
	 *
	 * @return Eden\Block\Field\Password
	 */
	public function useMask() 
	{
		$this->useMask = true;
		return $this;
	}
}