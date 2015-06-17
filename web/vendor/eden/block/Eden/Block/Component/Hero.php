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
 * Hero Component Block
 *
 * @vendor Eden
 * @package Block
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Hero extends Base 
{
	protected $attributes	= array();
	protected static $loaded = false;
	
	/**
	 * Returns a template file
	 * 
	 * @param array data
	 * @return string
	 */
	public function getTemplate() 
	{
		return __DIR__.'/hero.phtml';
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
			->attributes['class'].' carousel');
		} else {
			$this->attributes['class'] = 'carousel';
		}

		$loaded = self::$loaded;
		self::$loaded = true;

		$variables['attributes'] =$this->attributes;
		$variables['loaded'] =$loaded;

		return $variables;
	}
	
	/**
	 * Returns the template variables in key value format
	 *
	 * @param string|array
	 * @param scalar|null|array
	 * @return Eden\Block\Component\Hero
	 */
	public function setAttributes($name, $value = null) 
	{
		Argument::i()
			->test(1, 'string', 'null')
			->test(2, 'scalar', 'null','array')
			->test(3, 'array', 'null');
		
		if(is_array($name)) {
			$this->attributes = $name;
			return $this;
		}
		
		$this->attributes[$name] = $value;
		return $this;
	}
	
	/**
	 * Sets the slideshow delay
	 *
	 * @param scalar
	 * @return Eden\Block\Component\Hero
	 */
	public function setDelay($interval) 
	{
		return $this->setAttributes('interval', $interval);
	}

	/**
	 * Sets the slideshow images and desc
	 *
	 * @param scalar
	 * @return Eden\Block\Component\Hero
	 */
	public function setImages($data) 
	{
		return $this->setAttributes('imageSlides',$data);
	}
}