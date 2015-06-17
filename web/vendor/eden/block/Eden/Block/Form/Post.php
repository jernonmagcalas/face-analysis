<?php //-->
/*
 * This file is part of the Block package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

namespace Eden\Block\Form;

use Eden\Block\Base;
use Eden\Block\Argument;

/**
 * Post Form Block
 *
 * @vendor Eden
 * @package Block
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Post extends Base 
{
	protected $data	= array(
		'post_slug'	=> null, 
		'post_title' => null,
		'post_detail' => null,
		'post_active' => null);
	
	protected $show	= array(
		'post_title' => true,
		'post_slug'	=> true, 
		'post_detail' => true,
		'post_active' => true);
	
	protected $labels = array(
		'post_slug'	=> 'URL Path', 
		'post_title' => 'Title',
		'post_detail' => 'Detail',
		'post_active' => 'Active');
		
	protected $errors = array();
	protected $holders = array();
	
	protected $wysiwyg = null;
	
	/**
	 * Returns a template file
	 * 
	 * @param array data
	 * @return string
	 */
	public function getTemplate() 
	{
		return __DIR__.'/post.phtml';
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
			'use_wysiwyg' => $this->wysiwyg,
			'fields' => $this->show,
			'labels' => $this->labels,
			'data' => $this->data,
			'errors' => $this->errors,
			'holders' => $this->holders);
	}
	
	/**
	 * Prevent rendering of active
	 *
	 * @return Eden\Block\Form\Post
	 */
	public function noActive() 
	{
		$this->show['post_active'] = false;
		return $this;
	}
	
	/**
	 * Prevent rendering of detail
	 *
	 * @return Eden\Block\Form\Post
	 */
	public function noDetail() 
	{
		$this->show['post_detail'] = false;
		return $this;
	}
	
	/**
	 * Prevent rendering of slug
	 *
	 * @return Eden\Block\Form\Post
	 */
	public function noSlug() 
	{
		$this->show['post_slug'] = false;
		return $this;
	}
	
	/**
	 * Prevent rendering of title
	 *
	 * @return Eden\Block\Form\Post
	 */
	public function noTitle() 
	{
		$this->show['post_title'] = false;
		return $this;
	}
	
	/**
	 * Sets form data
	 *
	 * @param array|string
	 * @return Eden\Block\Form\Post
	 */
	public function setData($data) 
	{
		if(is_array($data)) {
			$this->data = $data;
			return $this;
		}
		
		$args = func_get_args();
		$this->data[$args[0]] = $args[1];
		
		return $this;
	}
	
	/**
	 * Sets errors
	 *
	 * @param array|string
	 * @return Eden\Block\Form\Post
	 */
	public function setErrors($errors) 
	{
		if(is_array($errors)) {
			$this->errors = $errors;
			return $this;
		}
		
		$args = func_get_args();
		$this->errors[$args[0]] = $args[1];
		
		return $this;
	}
	
	/**
	 * Sets place holders
	 *
	 * @param string|array
	 * @return Eden\Block\Form\Post
	 */
	public function setHolders($holders) 
	{
		if(is_array($holders)) {
			$this->holders = $holders;
			return $this;
		}
		
		$args = func_get_args();
		$this->holders[$args[0]] = $args[1];
		
		return $this;
	}
	
	/**
	 * Sets labels
	 *
	 * @param string|array
	 * @return Eden\Block\Form\Post
	 */
	public function setLabels($labels) 
	{
		if(is_array($labels)) {
			$this->labels = $labels;
			return $this;
		}
		
		$args = func_get_args();
		$this->labels[$args[0]] = $args[1];
		
		return $this;
	}
	
	/**
	 * Activates wysiwyg on detail
	 *
	 * @return Eden\Block\Form\Post
	 */
	public function useWysiwyg() 
	{
		$this->wysiwyg = true;
		return $this;
	}
}