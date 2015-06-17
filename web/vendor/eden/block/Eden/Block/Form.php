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

use Eden\Block\Form\Address;
use Eden\Block\Form\Login;
use Eden\Block\Form\Post;
use Eden\Block\Form\Register;
use Eden\Block\Form\Search;

/**
 * Field Blocks
 *
 * @vendor Eden
 * @package Block
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Form extends CoreBase 
{
	const INSTANCE = 1;
	
	/**
	 * Returns address block
	 *
	 * @return Eden\Block\Form\Address
	 */
	public function address() 
	{
		return Address::i();
	}
	
	/**
	 * Returns login block
	 *
	 * @return Eden\Block\Field\Login
	 */
	public function login() 
	{
		return Login::i();
	}
	
	/**
	 * Returns post block
	 *
	 * @return Eden\Block\Field\Post
	 */
	public function post() 
	{
		return Post::i();
	}
	
	/**
	 * Returns register block
	 *
	 * @return Eden\Block\Field\Register
	 */
	public function register() 
	{
		return Register::i();
	}
	
	/**
	 * Returns search block
	 *
	 * @return Eden\Block\Field\Search
	 */
	public function search() 
	{
		return Search::i();
	}
}