<?php //-->
/*
 * This file is part of the Block package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

namespace Eden\Block;

use Eden\Core\Base as CoreBase;

/**
 * Core Block Class
 *
 * @vendor Eden
 * @package Block
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Factory extends CoreBase
{
    const INSTANCE = 1;
	
	protected static $assets = NULL;
	protected static $language = array();
	
	/**
	 * Returns the block factory
	 *
	 * @return Eden\Block\Component
	 */
	public function component() 
	{
		return Component::i();
	}
	
	/**
	 * Returns the block factory
	 *
	 * @return Eden\Block\Field
	 */
	public function field() 
	{
		return Field::i();
	}
	
	/**
	 * Returns the block factory
	 *
	 * @return Eden\Block\Form
	 */
	public function form() 
	{
		return Form::i();
	}
	
	/**
	 * Sets Block Asset Root Path
	 *
	 * @param string
	 * @return Eden\Block\Factory
	 */
	public function getAssetRoot() 
	{
		return self::$assets;
	}
	
	/**
	 * Sets Block Asset Root Path
	 *
	 * @param string
	 * @return Eden\Block\Factory
	 */
	public function setAssetRoot($path) 
	{
		self::$assets = $path;
		return $this;
	}
	
	/**
	 * Sets Block Asset Root Path
	 *
	 * @param string
	 * @return Eden\Block\Factory
	 */
	public function getLanguage() 
	{
		return self::$language;
	}
	
	/**
	 * Sets Block Asset Root Path
	 *
	 * @param string
	 * @return Eden\Block\Factory
	 */
	public function setLanguage(Eden\Language\Base $language) 
	{
		self::$language = $language;
		return $this;
	}
}