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
class Index extends \Page 
{	
	protected $title = "Index";
	protected $class = "home";

	public function getVariables()
	{	
		if(isset($_POST) && !empty($_POST)) {
			if(isset($_POST['token'])) {
				$uploadDir = control()->path('upload').'/';

				// Set the allowed file extensions
				$fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // Allowed file extensions

				$verifyToken = md5('unique_salt' . $_POST['timestamp']);

				if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
					$tempFile   = $_FILES['Filedata']['tmp_name'];
					$targetFile = $uploadDir . $_FILES['Filedata']['name'];

					// Validate the filetype
					$fileParts = pathinfo($_FILES['Filedata']['name']);
					if (in_array(strtolower($fileParts['extension']), $fileTypes)) {
						$data = file_get_contents($tempFile);

						$post = array();
						$post['img'] = 'data:image/'.$fileParts['extension'].';base64,'.base64_encode($data);

						$ch = curl_init();

						curl_setopt($ch, CURLOPT_URL, 'http://server.face-analyzer.com');
						curl_setopt($ch, CURLOPT_POST, 1);
						curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

						$result = curl_exec($ch);

						curl_close ($ch);

						echo $result; 
						$result[] = array(
							'face' => array(array(
								'attribute' => array(
									'age' => array('range' => 5, 'value' => 4),
									'gender' => array("confidence" => 99.9325, "value" => "Female"),
									'glass' => array("confidence" => 99.9943, "value" => "None"),
									'race' => array("confidence" => 95.136, "value" => "White"),
									'smiling' => array('value' => 81.2131),
								),
								'face_id' => "d8bbad09026e71b071c7b388cd0bda01",
								'position' => array(
									'center' => array("x" => 68.425926, "y" => 30.712166),
									'eye_left' => array("x" => 65.367037, "y" => 25.361217),
									'eye_right' => array("x" => 72.265556, "y" => 27.028724),
									'height' => 22.848665,

								)
							)),
							"img_height" => 337, 
						    "img_id" => "33a07c707c17343b66014c52ddd9ec38", 
						    "img_width" => 540, 
						    "session_id" => "b33188dabf85487fb2339a190af65bd4", 
						    "url" => "http://www.hdwallpapersimages.com/wp-content/uploads/images/Child-Girl-with-Sunflowers-Images-540x337.jpg"
						);

						die(json_encode(array('image' => $post['img'], 'analysis' => $result )));
					} else {

						// The file type wasn't allowed
						echo 'Invalid file type.';

					}
				}
			}

			if(isset($_POST['url'])) {
				$ch = curl_init();

				curl_setopt($ch, CURLOPT_URL, 'http://server.face-analyzer.com');
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));

				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

				$result = curl_exec($ch);

				curl_close ($ch);

				echo $result;
				
				return array('image' => $post['img'], 'analysis' => $result );
			}
		}

		return array();
	}
}