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
 * File Field Block
 *
 * @vendor Eden
 * @package Block
 * @author Christian Blanquera cblanquera@openovate.com
 */
class File extends Text 
{
	protected static $loaded = false;
	
	protected $type		= 'file';
	protected $attributes	= array();
	
	/**
	 * Returns a template file
	 * 
	 * @param array data
	 * @return string
	 */
	public function getTemplate() 
	{
		return __DIR__.'/file.phtml';
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
		
		if(isset($variables['attributes']['multiple'])) {
			self::$loaded = true;
		}
		
		$variables['loaded'] = $loaded;
		
		return $variables;
	}
}