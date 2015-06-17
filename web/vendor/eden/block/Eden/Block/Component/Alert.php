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
 * Sort Component Block
 *
 * @vendor Eden
 * @package Block
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Alert extends Base 
{
	protected $message = null;
	protected $type = null;
	
	/**
	 * Contructor - Need to store query, key and label
	 *
	 * @param string
	 * @param string
	 */
	public function __construct($message, $type = 'info') 
	{
		Argument::i()
			->test(2, 'string')
			->test(3, 'string');
			
		$this->message = $message;
		$this->type = $type;
	}
	
	/**
	 * Returns the template variables in key value format
	 *
	 * @param array data
	 * @return array
	 */
	public function getVariables() 
	{
		return array(
			'message' => $this->message,
			'type' => $this->type);
	}
	
	/**
	 * Returns a template file
	 * 
	 * @param array data
	 * @return string
	 */
	public function getTemplate() 
	{
		return __DIR__.'/alert.phtml';
	}
}