<?php //-->
/*
 * This file is part of the Utility package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */
 
class Eden_Block_Tests_Block_FactoryTest extends \PHPUnit_Framework_TestCase
{
	public function testComponent() 
	{
		$class = eden('block')->component();
		$this->assertInstanceOf('Eden\\Block\\Component', $class);
	}
	
	public function testField() 
	{
		$class = eden('block')->field();
		$this->assertInstanceOf('Eden\\Block\\Field', $class);
	}
	
	public function testForm() 
	{
		$class = eden('block')->form();
		$this->assertInstanceOf('Eden\\Block\\Form', $class);
	}
	
	public function testSetAssetRoot() 
	{
		eden('block')->setAssetRoot('/test');	
	}
	
	public function testGetAssetRoot() 
	{
		$root = eden('block')->getAssetRoot();
		$this->assertEquals('/test', $root);
	}
}