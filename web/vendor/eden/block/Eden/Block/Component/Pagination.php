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
 * Pagination Component Block
 *
 * @vendor Eden
 * @package Block
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Pagination extends Base 
{
	protected $start = 0;
	protected $range = 25;
	protected $total = 0;
	protected $show	= 5;
	protected $query = array();
	protected $url = null;
	protected $class = null;
	
	public function __construct($total) 
	{
		$this->total = $total;
	}
	
	/**
	 * Returns the template variables in key value format
	 *
	 * @param array data
	 * @return array
	 */
	public function getVariables() 
	{
		$pages 	= ceil($this->total / $this->range);
		$page 	= floor($this->start / $this->range) + 1;
		
		$min 	= $page - $this->show;
		$max 	= $page + $this->show;
		
		if($min < 1) {
			$min = 1;
		}
		
		if($max > $pages) {
			$max = $pages;
		}
		
		return array(
			'class'	=> $this->class,
			'url'	=> $this->url,
			'query' => $this->query,
			'start' => $this->start,
			'range' => $this->range,
			'total' => $this->total,
			'show'	=> $this->show,
			'min'	=> $min,
			'max'	=> $max, 
			'pages' => $pages,
			'page'	=> $page);
	}
	
	/**
	 * Returns a template file
	 * 
	 * @param array data
	 * @return string
	 */
	public function getTemplate() 
	{
		return __DIR__.'/pagination.phtml';
	}
	
	/**
	 * Sets start
	 *
	 * @param int
	 * @return Eden\Block\Component\Pagination 
	 */
	public function setStart($start) 
	{
		Argument::i()->test(1, 'int');
		
		if($start < 0) {
			$start = 0;
		}
		
		$this->start = $start;
		
		return $this;
	}
	
	/**
	 * Sets range
	 *
	 * @param int
	 * @return Eden\Block\Component\Pagination  
	 */
	public function setRange($range) 
	{
		Argument::i()->test(1, 'int');
		
		if($range < 0) {
			$range = 1;
		}
		
		$this->range = $range;
		
		return $this;
	}
	
	/**
	 * Sets page
	 *
	 * @param int
	 * @return Eden\Block\Component\Pagination  
	 */
	public function setPage($page) 
	{
		Argument::i()->test(1, 'int');
		
		if($page < 1) {
			$page = 1;
		}
		
		$this->start = ( $page - 1 ) * $this->range;
		return $this;
	}
	
	/**
	 * Sets pages to show left and right of the current page
	 *
	 * @param int
	 * @return Eden\Block\Component\Pagination  
	 */
	public function setShow($show) 
	{
		Argument::i()->test(1, 'int');
		if($show < 1) {
			$show = 1;
		}
		
		$this->show = $show;
		
		return $this;
	}
	
	/**
	 * This Block has pagination we need to pass in the GET query
	 *
	 * @param array
	 * @return Eden\Block\Component\Pagination 
	 */
	public function setQuery(array $query) 
	{
		$this->query = $query;
		return $this;
	}
	
	/**
	 * This Block has pagination we need to pass in the url
	 *
	 * @param array
	 * @return Eden\Block\Component\Pagination 
	 */
	public function setUrl($url) 
	{
		Argument::i()->test(1, 'string');
		
		$this->url = $url;
		return $this;
	}
	
	/**
	 * Sets class for each page link
	 *
	 * @param array
	 * @return Eden\Block\Component\Pagination 
	 */
	public function setClass($class) 
	{
		Argument::i()->test(1, 'string');
		
		$this->class = $class;
		return $this;
	}
}