<?php //-->
/*
 * This file is part of the Utility package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */
 
class Eden_Block_Tests_Block_ComponentTest extends \PHPUnit_Framework_TestCase
{
	public function testHero() 
	{
		$class = eden('block')->component()->hero();
		$this->assertInstanceOf('Eden\\Block\\Component\\Hero', $class);
	}
	
	public function testSort() 
	{
		$class = eden('block')->component()->sort(array(), 'hi', 'Hello');
		$this->assertInstanceOf('Eden\\Block\\Component\\Sort', $class);
	}
	
	public function testPagination() 
	{
		$class = eden('block')->component()->pagination(100);
		$this->assertInstanceOf('Eden\\Block\\Component\\Pagination', $class);
	}
	
	public function testTree() 
	{
		$class = eden('block')->component()->tree();
		$this->assertInstanceOf('Eden\\Block\\Component\\Tree', $class);
	}
}