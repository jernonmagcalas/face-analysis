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

use Eden\Block\Field\Autocomplete;
use Eden\Block\Field\Button;
use Eden\Block\Field\Checkbox;
use Eden\Block\Field\Color;
use Eden\Block\Field\Combobox;
use Eden\Block\Field\Datetime;
use Eden\Block\Field\File;
use Eden\Block\Field\Markdown;
use Eden\Block\Field\Mask;
use Eden\Block\Field\Password;
use Eden\Block\Field\Radio;
use Eden\Block\Field\Select;
use Eden\Block\Field\Submit;
use Eden\Block\Field\Tag;
use Eden\Block\Field\Text;
use Eden\Block\Field\Textarea;
use Eden\Block\Field\Wysiwyg;

/**
 * Field Blocks
 *
 * @vendor Eden
 * @package Block
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Field extends CoreBase 
{
	const INSTANCE = 1;
	
	/**
	 * Returns a ui button field
	 *
	 * @param string
	 * @param string|null
	 * @param bool
	 * @return Eden\Block\Field\Button
	 */
	public function button($value, $name = null) 
	{
		Argument::i()
			->test(1, 'string')
			->test(2, 'string', 'null')
			->test(3, 'bool');
		
		$field = Button::i()->setValue($value);
		
		if(!is_null($name)) {
			$field->setName($name);
		}
		
		return $field;
	}
	
	/**
	 * Returns a checkbox field or fieldset
	 *
	 * @param string|null
	 * @param array
	 * @param scalar|null
	 * @return Eden\Block\Field\Checkbox
	 */
	public function checkbox($name = null, $value = null, $items = array()) 
	{
		Argument::i()
			->test(1, 'string', 'null')
			->test(2, 'scalar', 'array', 'null')
			->test(3, 'string', 'array');
		
		$field = Checkbox::i()->setItems($items);
		
		if(!is_null($name)) {
			$field->setName($name);
		}
		
		if(!is_null($value)) {
			$field->setValue($value);
		}
		
		return $field;
	}
	
	/**
	 * Returns a password field
	 *
	 * @param string|null
	 * @param scalar|null
	 * @return Eden\Block\Field\Text
	 */
	public function password($name = null, $value = null) 
	{
		Argument::i()
			->test(1, 'string', 'null')
			->test(2, 'scalar', 'null');
			
		$field = Password::i();
		
		if(!is_null($name)) {
			$field->setName($name);
		}
		
		if(!is_null($value)) {
			$field->setValue($value);
		}
		
		return $field;
	}
	
	/**
	 * Returns a radio fieldset
	 *
	 * @param string|null
	 * @param array
	 * @param scalar|null
	 * @return Eden\Block\Field\Radio
	 */
	public function radio($name = null, $value = null, array $items = array()) 
	{
		Argument::i()
			->test(1, 'string', 'null')
			->test(2, 'scalar', 'null');
			
		$field = Radio::i($name)->setItems($items);
		
		if(!is_null($name)) {
			$field->setName($name);
		}
		
		if(!is_null($value)) {
			$field->setValue($value);
		}
		
		return $field;
	}
	
	/**
	 * Returns a select field
	 *
	 * @param string|null
	 * @param array
	 * @param scalar|null
	 * @return Eden\Block\Field\Select
	 */
	public function select($name = null, $value = null, array $items = array()) 
	{
		Argument::i()
			->test(1, 'string', 'null')
			->test(2, 'scalar', 'null');
			
		$field = Select::i()->setItems($items);
		
		if(!is_null($name)) {
			$field->setName($name);
		}
		
		if(!is_null($value)) {
			$field->setValue($value);
		}
		
		return $field;
	}
	
	/**
	 * Returns a submit field
	 *
	 * @param string
	 * @param scalar|null
	 * @param string|null
	 * @return Eden\Block\Field\Submit
	 */
	public function submit($value, $name = null, $image = null) 
	{
		Argument::i()
			->test(1, 'string')
			->test(2, 'string', 'null');
		
		$field = Submit::i()->setValue($value);
		
		if(!is_null($name)) {
			$field->setName($name);
		}
		
		if($image) {
			$field->setImage($image);
		}
		
		return $field;
	}

	/**
	 * Returns an input mask
	 *
	 * @param string
	 * @param string|null
	 * @param string|null
	 * @param scalar|null
	 * @return Eden\Block\Field\Mask
	 */
	public function mask($pattern, $placeholder = null, $name = null, $value = null) 
	{
		Argument::i()
			->test(1, 'string')
			->test(2, 'string', 'null')
			->test(3, 'string', 'null')
			->test(4, 'scalar', 'null');
			
		$field = Mask::i()->setPattern($pattern);
		
		if(!is_null($name)) {
			$field->setName($name);
		}
		
		if(!is_null($placeholder)){
			$field->setHolder($placeholder);
		}
		
		if(!is_null($value)) {
			$field->setValue($value);
		}
		
		return $field;
	}

	/**
	 * Returns a text field
	 *
	 * @param string|null
	 * @param scalar|null
	 * @return Eden\Block\Field\Text
	 */
	public function text($name = null, $value = null) 
	{
		Argument::i()
			->test(1, 'string', 'null')
			->test(2, 'scalar', 'null');
			
		$field = Text::i();
		
		if(!is_null($name)) {
			$field->setName($name);
		}
		
		if(!is_null($value)) {
			$field->setValue($value);
		}
		
		return $field;
	}
	
	/**
	 * Returns a textarea field
	 *
	 * @param string|null
	 * @param scalar|null
	 * @return Eden\Block\Field\Textarea
	 */
	public function textarea($name = null, $value = null) 
	{
		Argument::i()
			->test(1, 'string', 'null')
			->test(2, 'scalar', 'null');
			
		$field = Textarea::i();
		
		if(!is_null($name)) {
			$field->setName($name);
		}
		
		if(!is_null($value)) {
			$field->setValue($value);
		}
		
		return $field;
	}
	
	/**
	 * Returns an autcomplete field
	 *
	 * @param string|null
	 * @param scalar|null
	 * @return Eden\Block\Field\Autocomplete
	 */
	public function autocomplete($name = null, $value = null) 
	{
		Argument::i()
			->test(1, 'string', 'null')
			->test(2, 'scalar', 'null');
			
		$field = Autocomplete::i();
		
		if(!is_null($name)) {
			$field->setName($name);
		}
		
		if(!is_null($value)) {
			$field->setValue($value);
		}
		
		return $field;
	}
	
	/**
	 * Returns a color field
	 *
	 * @param string|null
	 * @param scalar|null
	 * @return Eden\Block\Field\Color
	 */
	public function color($name = null, $value = null) 
	{
		Argument::i()
			->test(1, 'string', 'null')
			->test(2, 'string', 'null');
			
		$field = Color::i($name);
		
		if(!is_null($name)) {
			$field->setName($name);
		}
		
		if(!is_null($value)) {
			$field->setValue($value);
		}
		
		return $field;
	}
	
	/**
	 * Returns a combobox field
	 *
	 * @param string|null
	 * @param scalar|null
	 * @return Eden\Block\Field\Combobox
	 */
	public function combobox($name = null, $value = null) 
	{
		Argument::i()
			->test(1, 'string', 'null')
			->test(2, 'scalar', 'null');
			
		$field = Combobox::i();
		
		if(!is_null($name)) {
			$field->setName($name);
		}
		
		if(!is_null($value)) {
			$field->setValue($value);
		}
		
		return $field;
	}
	
	/**
	 * Returns a date field
	 *
	 * @param string|null
	 * @param scalar|null
	 * @return Eden\Block\Field\Datetime
	 */
	public function date($name = null, $value = null) 
	{
		Argument::i()
			->test(1, 'string', 'null')
			->test(2, 'scalar', 'null');
			
		$field = Datetime::i()
		->setOptions('pickTime', false)
		->setOptions('format', 'MM/dd/yyyy');
		
		if(!is_null($name)) {
			$field->setName($name);
		}
		
		if(!is_null($value)) {
			$field->setValue($value);
		}
		
		return $field;
	}
	
	/**
	 * Returns a datetime field
	 *
	 * @param string|null
	 * @param scalar|null
	 * @return Eden\Block\Field\Datetime
	 */
	public function datetime($name = null, $value = null) 
	{
		Argument::i()
			->test(1, 'string', 'null')
			->test(2, 'scalar', 'null');
			
		$field = Datetime::i();
		
		if(!is_null($name)) {
			$field->setName($name);
		}
		
		if(!is_null($value)) {
			$field->setValue($value);
		}
		
		return $field;
	}
	
	/**
	 * Returns a file field
	 *
	 * @param string|null
	 * @param bool
	 * @param array
	 * @return Eden\Block\Field\File
	 */
	public function file($name = null, $multiple = false, array $accept = array()) 
	{
		Argument::i()
			->test(1, 'string', 'null')
			->test(2, 'bool');
			
		$field = File::i();
		
		if(!is_null($name)) {
			$field->setName($name);
		}
		
		if($multiple) {
			$field->setAttributes('multiple', 'multiple');
		}
		
		if(!empty($accept)) {
			$field->setAttributes('accept', implode(',', $accept));
		}
		
		return $field;
	}
	
	/**
	 * Returns an image upload field
	 *
	 * @param string|null
	 * @param bool
	 * @return Eden\Block\Field\File
	 */
	public function image($name = null, $multiple = false) 
	{
		Argument::i()
			->test(1, 'string', 'null')
			->test(2, 'bool');
		
		$accept = array('image/gif','image/jpg','image/jpeg','image/png');
		
		return $this->file($name, $multiple, $accept);
	}
	
	/**
	 * Returns a Markdown field
	 *
	 * @param string|null
	 * @param scalar|null
	 * @return Eden\Block\Field\Markdown
	 */
	public function markdown($name = null, $value = null) 
	{
		Argument::i()
			->test(1, 'string', 'null')
			->test(2, 'scalar', 'null');
			
		$field = Markdown::i();
		
		if(!is_null($name)) {
			$field->setName($name);
		}
		
		if(!is_null($value)) {
			$field->setValue($value);
		}
		
		return $field;
	}
	
	/**
	 * Returns a slider field
	 *
	 * @param string|null
	 * @param scalar|null
	 * @return Eden\Block\Field\Text
	 */
	public function slider($name = null, $value = null) 
	{
		Argument::i()
			->test(1, 'string', 'null')
			->test(2, 'scalar', 'null');
			
		$field = Text::i()->setType('range');
		
		if(!is_null($name)) {
			$field->setName($name);
		}
		
		if(!is_null($value)) {
			$field->setValue($value);
		}
		
		return $field;
	}
	
	/**
	 * Returns an autcomplete field
	 *
	 * @param string|null
	 * @param scalar|null
	 * @return Eden\Block\Field\Tag
	 */
	public function tag($name = null, $value = null) 
	{
		Argument::i()
			->test(1, 'string', 'null')
			->test(2, 'scalar', 'null');
			
		$field = Tag::i();
		
		if(!is_null($name)) {
			$field->setName($name);
		}
		
		if(!is_null($value)) {
			$field->setValue($value);
		}
		
		return $field;
	}
	
	/**
	 * Returns a time field
	 *
	 * @param string|null
	 * @param scalar|null
	 * @return Eden\Block\Field\Datetime
	 */
	public function time($name = null, $value = null) 
	{
		Argument::i()
			->test(1, 'string', 'null')
			->test(2, 'scalar', 'null');
			
		$field = Datetime::i()
			->setOptions('pickDate', false)
			->setOptions('format', 'HH:mm PP');
		
		if(!is_null($name)) {
			$field->setName($name);
		}
		
		if(!is_null($value)) {
			$field->setValue($value);
		}
		
		return $field;
	}
	
	/**
	 * Returns a WYSIWYG field
	 *
	 * @param string|null
	 * @param scalar|null
	 * @return Eden\Block\Field\Wysiwyg
	 */
	public function wysiwyg($name = null, $value = null) 
	{
		Argument::i()
			->test(1, 'string', 'null')
			->test(2, 'scalar', 'null');
			
		$field = Wysiwyg::i();
		
		if(!is_null($name)) {
			$field->setName($name);
		}
		
		if(!is_null($value)) {
			$field->setValue($value);
		}
		
		return $field;
	}
}