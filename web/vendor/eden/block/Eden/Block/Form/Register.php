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
 * Register Form Block
 *
 * @vendor Eden
 * @package Block
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Register extends Base 
{
	protected $data	= array(
		'user_slug'	=> null, 
		'user_email' => null);
		
	protected $errors = array();
	protected $holders = array();
	protected $useEmail = true;
	
	
	/**
	 * Returns a template file
	 * 
	 * @param array data
	 * @return string
	 */
	public function getTemplate() 
	{
		return __DIR__.'/register.phtml';
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
			'use_email'	=> $this->useEmail,
			'data' => $this->data,
			'errors' => $this->errors,
			'holders' => $this->holders);
	}
	
	/**
	 * Sets form data
	 *
	 * @param array|string
	 * @return Eden\Block\Form\Register
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
	 * @return Eden\Block\Form\Register
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
	 * @return Eden\Block\Form\Register
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
	 * Uses Email as the unique identifier
	 *
	 * @return Eden\Block\Form\Register
	 */
	public function useEmail() 
	{
		$this->useEmail = true;
		return $this;
	}
	
	/**
	 * Uses Slug as the unique identifier
	 *
	 * @return Eden\Block\Form\Register
	 */
	public function useSlug() 
	{
		$this->useEmail = false;
		return $this;
	}
}