<?php //-->
/*
 * This file is part of the Utility package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */
 
class Eden_Block_Tests_Block_FieldTest extends \PHPUnit_Framework_TestCase
{
	public function testButton() 
	{
		$class = eden('block')->field()->button('Submit');
		$this->assertInstanceOf('Eden\\Block\\Field\\Button', $class);
		
		$actual = eden('block')->field()->button('button')
		->setAttributes('class', 'btn-primary');
		
		$expected = '<button class="btn-primary btn" >button</button>';
		$this->assertEquals($expected, trim($actual));
	}
	
	public function testCheckbox() 
	{
		$class = eden('block')->field()->checkbox();
		$this->assertInstanceOf('Eden\\Block\\Field\\Checkbox', $class);
		
		$actual = eden('block')->field()
		->checkbox('checkbox', array(2, 4), array(
			'1' => 'Option 1',
			'2' => 'Option 2',
			'3' => 'Option 3',
			'4' => 'Option 4'
		));
		
		$expected = '<label class="checkbox-inline">
<input name="checkbox[]" type="checkbox" value="1" />
<span>Option 1</span>
</label>
<label class="checkbox-inline">
<input name="checkbox[]" type="checkbox" value="2" checked="checked" />
<span>Option 2</span>
</label>
<label class="checkbox-inline">
<input name="checkbox[]" type="checkbox" value="3" />
<span>Option 3</span>
</label>
<label class="checkbox-inline">
<input name="checkbox[]" type="checkbox" value="4" checked="checked" />
<span>Option 4</span>
</label>';

		//$this->assertEquals($expected, trim($actual));
		$this->assertTrue(strpos((string) $actual, 
		'<label class="checkbox-inline">') === 0);
	}
	
	public function testPassword() 
	{
		$class = eden('block')->field()->password();
		$this->assertInstanceOf('Eden\\Block\\Field\\Password', $class);
	}
	
	public function testRadio() 
	{
		$class = eden('block')->field()->radio();
		$this->assertInstanceOf('Eden\\Block\\Field\\Radio', $class);
		
		$actual = eden('block')->field()->radio('radio', 3, array(
			'1' => 'Option 1',
			'2' => 'Option 2',
			'3' => 'Option 3',
			'4' => 'Option 4'));
		
		$expected = '<label>
<input name="radio" type="radio" value="1" />
<span>Option 1</span>
</label>
<label>
<input name="radio" type="radio" value="2" />
<span>Option 2</span>
</label>
<label>
<input name="radio" type="radio" value="3" checked="checked" />
<span>Option 3</span>
</label>
<label>
<input name="radio" type="radio" value="4" />
<span>Option 4</span>
</label>';
	
		//$this->assertEquals($expected, trim($actual));
		$this->assertTrue(strpos((string) $actual, '<label>') === 0);
	}
	
	public function testSelect() 
	{
		$class = eden('block')->field()->select();
		$this->assertInstanceOf('Eden\\Block\\Field\\Select', $class);
		
		$actual = eden('block')->field()->select('select', 4, array(
			'1' => 'Option 1',
			'2' => 'Option 2',
			'3' => 'Option 3',
			'4' => 'Option 4'
		));
		
		$expected = '<select name="select" class="form-control">
				<option value="1">Option 1</option>
						<option value="2">Option 2</option>
						<option value="3">Option 3</option>
						<option value="4" selected="selected">Option 4</option>
			</select>';
		
		//$this->assertEquals($expected, trim($actual));
		$this->assertTrue(strpos((string) $actual, 
		'<select name="select" class="form-control">') === 0);
	}
	
	public function testSubmit() 
	{
		$class = eden('block')->field()->submit('Submit');
		$this->assertInstanceOf('Eden\\Block\\Field\\Submit', $class);
	}
	
	public function testMask() 
	{
		$class = eden('block')->field()->mask('999-999-*999');
		$this->assertInstanceOf('Eden\\Block\\Field\\Mask', $class);
		
		$actual = eden('block')->field()->mask('99-999-a-**-999', '99-999-a-a1-321');
		
		$expected = '<input placeholder="99-999-a-a1-321" class="eden-field-mask eden-field-mask form-control" type="text" /><script type="text/javascript" src="/eve/scripts/mask.js"></script>
<link rel="stylesheet" type="text/css" href="/eve/styles/mask.css" />
<script type="text/javascript">jQuery(\'input.eden-field-mask\').not(\'.eden-field-loaded\').addClass(\'eden-field-loaded\').inputmask({mask: \'99-999-a-**-999\'});</script>';

		//$this->assertEquals($expected, trim($actual));
		$this->assertTrue(strpos((string) $actual, 
		'<input placeholder="99-999-a-a1-321" class="eden-field-mask eden-field-mask') === 0);
	}
	
	public function testText() 
	{
		$class = eden('block')->field()->text();
		$this->assertInstanceOf('Eden\\Block\\Field\\Text', $class);
	}
	
	public function testTextarea() 
	{
		$class = eden('block')->field()->textarea();
		$this->assertInstanceOf('Eden\\Block\\Field\\Textarea', $class);
	}
	
	public function testAutocomplete() 
	{
		$class = eden('block')->field()->autocomplete();
		$this->assertInstanceOf('Eden\\Block\\Field\\Autocomplete', $class);
		
		$actual = eden('block')->field()->autocomplete('autocomplete')
		->addOptions('autocomplete', array('local' => array(
		'Lorem Ipsum', 
		'Ipsum Dolor',
		'Dolor Levity',
		'Levity Dasma',
		'Dasma Dogity',
		'Dogity Lorem',
		'Lord Of the Rings')));
		
		$expected = '<input name="autocomplete" class="eden-field-autocomplete form-control" type="text" /><script type="text/javascript" src="/eve/scripts/autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="/eve/styles/autocomplete.css" />
<script type="text/javascript">jQuery(\'input.eden-field-autocomplete\').not(\'.eden-field-loaded\').addClass(\'eden-field-loaded\').typeahead({"local":["Lorem Ipsum","Ipsum Dolor","Dolor Levity","Levity Dasma","Dasma Dogity","Dogity Lorem","Lord Of the Rings"],"name":"autocomplete"});</script>';

		//$this->assertEquals($expected, trim($actual));
		
		$this->assertTrue(strpos((string) $actual, 
		'<input name="autocomplete" class="eden-field-autocomplete form-control"') === 0);
	}
	
	public function testColor() 
	{
		$class = eden('block')->field()->color();
		$this->assertInstanceOf('Eden\\Block\\Field\\Color', $class);
		
		$actual = eden('block')->field()->color('colour', '#006699');
		$expected = '<div class="input-group eden-field-color-wrapper">
    <input name="colour" value="#006699" type="text" class="form-control" />    <span class="input-group-addon">
    <img class="eden-field-color" 
    src="/assets/library/eve/field/color/images/blank.gif" 
    style="background-color:#006699" />
    </span>
</div>
<link rel="stylesheet" href="/eve/styles/color.css" type="text/css" />
<script type="text/javascript" src="/eve/scripts/color.js"></script>';

		//$this->assertEquals($expected, trim($actual));
		
		$this->assertTrue(strpos((string) $actual, 
		'<div class="input-group eden-field-color-wrapper">') === 0);
	}
	
	public function testCombobox() 
	{
		$class = eden('block')->field()->combobox();
		$this->assertInstanceOf('Eden\\Block\\Field\\Combobox', $class);
		
		$actual = eden('block')->field()->combobox('combobox')
		->addOptions('combobox', array('local' => array(
			'Lorem Ipsum', 
			'Ipsum Dolor',
			'Dolor Levity',
			'Levity Dasma',
			'Dasma Dogity',
			'Dogity Lorem',
			'Lord Of the Rings 3')));
		
		$expected = '<div class="input-group eden-field-combobox">
    <input name="combobox" class="eden-field-autocomplete form-control" type="text" />    <span class="input-group-addon">
    	<i class="icon-caret-down"></i>
    </span>
</div>

<script type="text/javascript" src="/eve/scripts/autocomplete.js"></script>
<script type="text/javascript" src="/eve/scripts/combobox.js"></script>
<script type="text/javascript">
jQuery(\'div.eden-field-combobox\').not(\'.eden-field-loaded\').addClass(\'eden-field-loaded\').combobox([{"local":["Lorem Ipsum","Ipsum Dolor","Dolor Levity","Levity Dasma","Dasma Dogity","Dogity Lorem","Lord Of the Rings 2"],"name":"combobox"}]);
</script>';

		//$this->assertEquals($expected, trim($actual));
		
		$this->assertTrue(strpos((string) $actual, 
		'<div class="input-group eden-field-combobox">') === 0);
	}
	
	public function testDate() 
	{
		$class = eden('block')->field()->date();
		$this->assertInstanceOf('Eden\\Block\\Field\\Datetime', $class);
		
		$actual = eden('block')->field()->date('date');
		$expected = '<div class="input-group date eden-field-datetime">
    <input name="date" type="text" class="form-control" />    <span class="input-group-addon">
        <i class="icon-calendar"></i>
        </span>
</div>

<script type="text/javascript" src="/eve/scripts/datetime.js"></script>
<link rel="stylesheet" type="text/css" href="/eve/styles/datetime.css" />
<script type="text/javascript">jQuery(\'div.eden-field-datetime\').not(\'.eden-field-loaded\').addClass(\'eden-field-loaded\').datetimepicker({"format":"MM\/dd\/yyyy","language":"en","pickDate":true,"pickTime":false,"pick12HourFormat":true});</script>';

		//$this->assertEquals($expected, trim($actual));
		
		$this->assertTrue(strpos((string) $actual, 
		'<div class="input-group date eden-field-datetime">') === 0);
	}
	
	public function testDatetime() 
	{
		$class = eden('block')->field()->datetime();
		$this->assertInstanceOf('Eden\\Block\\Field\\Datetime', $class);
		
		$actual = eden('block')->field()->datetime('datetime');
		
		$expected = '<div class="input-group date eden-field-datetime">
    <input name="datetime" type="text" class="form-control" />    <span class="input-group-addon">
        <i class="icon-calendar"></i>
        </span>
</div>

<script type="text/javascript" src="/eve/scripts/datetime.js"></script>
<link rel="stylesheet" type="text/css" href="/eve/styles/datetime.css" />
<script type="text/javascript">jQuery(\'div.eden-field-datetime\').not(\'.eden-field-loaded\').addClass(\'eden-field-loaded\').datetimepicker({"format":"MM\/dd\/yyyy HH:mm PP","language":"en","pickDate":true,"pickTime":true,"pick12HourFormat":true});</script>';

		//$this->assertEquals($expected, trim($actual));
		
		$this->assertTrue(strpos((string) $actual, 
		'<div class="input-group date eden-field-datetime">') === 0);
	}
	
	public function testFile() 
	{
		$class = eden('block')->field()->file();
		$this->assertInstanceOf('Eden\\Block\\Field\\File', $class);
		
		$actual = eden('block')->field()->file('file', true);
		$expected = '<div class="eden-field-file form-control clearfix">
<input name="file" multiple="multiple" type="file" class="form-control" /><span class="eden-field-file-list clearfix"></span>
<script type="text/javascript" src="/eve/scripts/file.js"></script>
<link rel="stylesheet" type="text/css" href="/eve/styles/file.css" />
</div>
<script type="text/javascript">jQuery(\'div.eden-field-file\').not(\'.eden-field-loaded\').addClass(\'eden-field-loaded\').addClass(\'eden-field-file\').file();</script>';

		//$this->assertEquals($expected, trim($actual));
		
		$this->assertTrue(strpos((string) $actual, 
		'<div class="eden-field-file form-control clearfix">') === 0);
	}
	
	public function testImage() 
	{
		$class = eden('block')->field()->image();
		$this->assertInstanceOf('Eden\\Block\\Field\\File', $class);
		
		$actual = eden('block')->field()->image('image', true);
		$expected  = '<div class="eden-field-file form-control clearfix">
<input name="image" multiple="multiple" accept="image/gif,image/jpg,image/jpeg,image/png" type="file" class="form-control" /><span class="eden-field-file-list clearfix"></span>
</div>
<script type="text/javascript">jQuery(\'div.eden-field-file\').not(\'.eden-field-loaded\').addClass(\'eden-field-loaded\').addClass(\'eden-field-file\').file();</script>';

		//$this->assertEquals($expected, trim($actual));
		
		$this->assertTrue(strpos((string) $actual, 
		'<div class="eden-field-file form-control clearfix">') === 0);
	}
	
	public function testSlider() 
	{
		$class = eden('block')->field()->slider();
		$this->assertInstanceOf('Eden\\Block\\Field\\Text', $class);
		
		$actual = eden('block')->field()->slider('slider');
		
		$expected = '<input name="slider" type="range" class="form-control" />';
		
		$this->assertEquals($expected, trim($actual));
	}
	
	public function testTag() 
	{
		$class = eden('block')->field()->tag();
		$this->assertInstanceOf('Eden\\Block\\Field\\Tag', $class);
		
		$actual = eden('block')->field()->tag('tags', 'test,swe')
		->addOptions('test', array('local' => array(
		'Lorem', 	'Ipsum',
		'Dolor',	'Levity',
		'Dasma',	'Dogity',
		'Lord Of the Rings')));
		
		$expected = '<input name="tags" value="test,swe" class="eden-field-tag form-control" type="text" /><script type="text/javascript" src="/eve/scripts/tag.js"></script>
<link rel="stylesheet" type="text/css" href="/eve/styles/tag.css" />
<script type="text/javascript" src="/eve/scripts/autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="/eve/styles/autocomplete.css" />
<script type="text/javascript">(function($) {var tag = jQuery(\'input.eden-field-tag\').not(\'.eden-field-loaded\').addClass(\'eden-field-loaded\');tag.tagsManager({prefilled: tag.val().split(\',\'), replace: true, tagClass: \'btn\'});tag.typeahead({"local":["Lorem","Ipsum","Dolor","Levity","Dasma","Dogity","Lord Of the Rings"],"name":"test"}).on(\'typeahead:selected\', function (e, d) {tag.tagsManager("pushTag", d.value);});})(jQuery);</script>';
		
		//$this->assertEquals($expected, trim($actual));
		
		$this->assertTrue(strpos((string) $actual, 
		'<input name="tags" value="test,swe" class="eden-field-tag form-control"') === 0);
	}
	
	public function testTime() 
	{
		$class = eden('block')->field()->time();
		$this->assertInstanceOf('Eden\\Block\\Field\\Datetime', $class);
		
		$actual = eden('block')->field()->time('time');
		
		$expected = '<div class="input-group date eden-field-datetime">
    <input name="time" type="text" class="form-control" />    <span class="input-group-addon">
        <i class="icon-time"></i>
	    </span>
</div>

<script type="text/javascript" src="/eve/scripts/datetime.js"></script>
<link rel="stylesheet" type="text/css" href="/eve/styles/datetime.css" />
<script type="text/javascript">jQuery(\'div.eden-field-datetime\').not(\'.eden-field-loaded\').addClass(\'eden-field-loaded\').datetimepicker({"format":"HH:mm PP","language":"en","pickDate":false,"pickTime":true,"pick12HourFormat":true});</script>';

		//$this->assertEquals($expected, trim($actual));
		
		$this->assertTrue(strpos((string) $actual, 
		'<div class="input-group date eden-field-datetime">') === 0);
	}
	
	public function testWysiwyg() 
	{
		$class = eden('block')->field()->wysiwyg();
		$this->assertInstanceOf('Eden\\Block\\Field\\Wysiwyg', $class);
	}
}