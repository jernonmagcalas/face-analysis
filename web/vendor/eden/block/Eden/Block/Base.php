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
use Eden\Core\Factory as CoreFactory;
use Eden\Template\Base as Template;

/**
 * The base class for all classes wishing to integrate with Eden.
 * Extending this class will allow your methods to seemlessly be
 * overloaded and overrided as well as provide some basic class
 * loading patterns.
 *
 * @vendor Eden
 * @package Block
 * @author Christian Blanquera cblanquera@openovate.com
 */
abstract class Base extends CoreBase
{
	protected static $global = array();
	
	protected $template = null;
	
	/**
	 * Magic: Try to call render
	 *
	 * @return string
	 */
	public function __toString() 
	{
		try {
			return (string) $this->render();
		} catch(\Exception $e) {
			CoreFactory::i()
				->exception()
				->handler($e);
		}
		
		return '';
	}
	
	/**
	 * returns location of template file
	 *
	 * @return string
	 */
	public function getTemplate() 
	{
		return $this->template;
	}
	
	/**
	 * returns variables used for templating
	 *
	 * @return array
	 */
	abstract public function getVariables();
	
	/**
	 * Transform block to string
	 *
	 * @param array
	 * @return string
	 */
	public function render() 
	{
		return Template::i()
			->set(array_merge($this->getHelpers(), $this->getVariables()))
			->parsePhp($this->getTemplate());
	}
	
	/**
	 * Returns helper methods
	 *
	 * @return array
	 */
	protected function getHelpers() 
	{
		$cdnRoot	= eden('block')->getAssetRoot();
		$language 	= eden('block')->getLanguage();
		
		return array(
			'cdn' => function() use ($cdnRoot) {
				echo $cdnRoot;
			},
			
			'_' => function($key) use ($language) {
				if($language instanceof Eden\Language\Base) {
					echo $language[$key];
				} else {
					echo $key;
				}
			});
	}
}