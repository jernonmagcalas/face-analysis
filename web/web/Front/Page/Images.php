<?php //-->


namespace Front\Page;

/**
 * The base class for any class that defines a view.
 * A view controls how templates are loaded as well as 
 * being the final point where data manipulation can occur.
 *
 * @vendor Openovate
 * @package Framework
 */
class Images extends \Page 
{	
	protected $title = "Index";
	protected $class = "home";

	public function getVariables()
	{	
		$imagePath = control()->path('upload').'/';
		$image = control()->registry()->get('request', 'variables', 0);
		
		$image = eden('image', $imagePath.$image, 'jpg');

		header('Content-type: image/jpeg');
		echo $image;   
		exit;
	}
}