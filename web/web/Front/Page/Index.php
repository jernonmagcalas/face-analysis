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

						curl_setopt($ch, CURLOPT_URL, 'http://server.faceanalyzer.dev/');
						curl_setopt($ch, CURLOPT_POST, 1);
						curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

						$result = curl_exec($ch);

						curl_close ($ch);


                        $result = json_decode($result, true);

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

        $timestamp = time();
		return array(
            'timestamp' => $timestamp,
            'token' => md5('unique_salt' . $timestamp)
        );
	}
}