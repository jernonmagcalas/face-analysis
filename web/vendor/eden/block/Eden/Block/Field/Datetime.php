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
 * Datetime Field Block
 *
 * @vendor Eden
 * @package Block
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Datetime extends Text 
{
	protected static $loaded = false;
	
	protected $options	= array(
		'format' 			=> 'MM/dd/yyyy HH:mm PP',	
		'language' 			=> 'en',
		'pickDate'			=> true,
		'pickTime'			=> true,
      	'pick12HourFormat' 	=> true);
	
	/**
	 * Returns a template file
	 * 
	 * @param array data
	 * @return string
	 */
	public function getTemplate() 
	{
		return __DIR__.'/datetime.phtml';
	}
	
	/**
	 * Returns the template variables in key value format
	 *
	 * @param array data
	 * @return array
	 */
	public function getVariables() 
	{
		$variables = parent::getVariables();
		
		$loaded = self::$loaded;
		self::$loaded = true;
		
		$variables['loaded'] = $loaded;
		$variables['options'] = $this->options;
		
		return $variables;
	}
	
	/**
	 * Returns the template variables in key value format
	 * http://tarruda.github.io/bootstrap-datetimepicker/
	 *
	 * @param string
	 * @param array
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