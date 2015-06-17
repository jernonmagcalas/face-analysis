<?php //-->
/*
 * This file is part of the Utility package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */
 
class Eden_Block_Tests_Block_FormTest extends \PHPUnit_Framework_TestCase
{
	public function testAddress() 
	{
		$class = eden('block')->form()->address();
		$this->assertInstanceOf('Eden\\Block\\Form\\Address', $class);
	}
	
	public function testLogin() 
	{
		$class = eden('block')->form()->login();
		$this->assertInstanceOf('Eden\\Block\\Form\\Login', $class);
	}
	
	public function testPost() 
	{
		$class = eden('block')->form()->post();
		$this->assertInstanceOf('Eden\\Block\\Form\\Post', $class);
	}
	
	public function testRegister() 
	{
		$class = eden('block')->form()->register();
		$this->assertInstanceOf('Eden\\Block\\Form\\Register', $class);
	}
	
	public function testSearch() 
	{
		$class = eden('block')->form()->search();
		$this->assertInstanceOf('Eden\\Block\\Form\\Search', $class);
	}
}