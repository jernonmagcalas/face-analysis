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
 * Submit Field Block
 *
 * @vendor Eden
 * @package Block
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Submit extends Text 
{
	protected $image = null;
	protected $type	= 'submit';
	protected $attributes = array();
	
	/**
	 * Returns the template variables in key value format
	 *
	 * @param array data
	 * @return array
	 */
	public function getVariables() 
	{	
		if($this->image) {
			$this->type = 'image';
			$this->attributes['src'] = $this->image;
		}
		
		return parent::getVariables();
	}
	
	/**
	 * Sets a background image
	 *
	 * @param string
	 * @return Eden\Block\Field\Submit
	 */
	public function setImage($image) 
	{
		Argument::i()->test(1, 'string');
		$this->image = $image;
		return $this;
	}
}