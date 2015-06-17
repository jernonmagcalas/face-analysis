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
class Sort extends Base 
{
	const ASC 	= 'ASC';
	const DESC 	= 'DESC';
	
	protected $query = array();
	protected $url = null;
	protected $key = null;
	protected $label = null;
	protected $className = null;
	
	/**
	 * Contructor - Need to store query, key and label
	 *
	 * @param array
	 * @param string
	 * @param string
	 */
	public function __construct(array $query, $key, $label) 
	{
		Argument::i()
			->test(2, 'string')
			->test(3, 'string')
			->test(4, 'string', 'null');
			
		$this->query = $query;
		$this->key 	= $key;
		$this->label = $label;
	}
	
	/**
	 * Returns the template variables in key value format
	 *
	 * @param array data
	 * @return array
	 */
	public function getVariables() 
	{
		$order = null;
		if(!isset($this->query['sort']) || $this->query['sort'] != $this->key) {
			$this->query['sort'] = $this->key;
			$this->query['order'] = self::ASC;
		} else if($this->query['order'] == self::ASC) {
			$order = self::ASC;
			$this->query['order'] = self::DESC;
		} else {
			$order = self::DESC;
			$this->query['order'] = self::ASC;
		}
		
		return array(
			'url'	=> $this->url,
			'query' => $this->query,
			'label' => $this->label,
			'order'	=> strtolower($order),
			'class'	=> $this->className);
	}
	
	/**
	 * Returns a template file
	 * 
	 * @param array data
	 * @return string
	 */
	public function getTemplate() 
	{
		return __DIR__.'/sort.phtml';
	}
	
	/**
	 * Sets class for each page link
	 *
	 * @param string
	 * @return Eden\Block\Component\Sort 
	 */
	public function setClass($class) 
	{
		Argument::i()->test(1, 'string');
		
		$this->className = $class;
		return $this;
	}
	
	/**
	 * This Block has pagination we need to pass in the url
	 *
	 * @param array
	 * @return Eden\Block\Component\Sort 
	 */
	public function setUrl($url) 
	{
		Argument::i()->test(1, 'string');
		$this->url = $url;
		return $this;
	}
}