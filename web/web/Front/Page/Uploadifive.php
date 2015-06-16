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
class Uploadifive extends \Page 
{	
	protected $title = "Index";
	protected $class = "home";

	public function getVariables()
	{
		$uploadDir = '/uploads/';

		// Set the allowed file extensions
		$fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // Allowed file extensions

		$verifyToken = md5('unique_salt' . $_POST['timestamp']);

		if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
			$tempFile   = $_FILES['Filedata']['tmp_name'];
			//$uploadDir  = $_SERVER['DOCUMENT_ROOT'] . $uploadDir;
			$targetFile = $uploadDir . $_FILES['Filedata']['name'];

			echo $targetFile;

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

				$result = curl_exec ($ch);

				echo $result;

				curl_close ($ch);

				die($result);

				// Save the file
				// move_uploaded_file($tempFile, $targetFile);
				// echo 1;

			} else {

				// The file type wasn't allowed
				echo 'Invalid file type.';

			}
		}

		return array();
	}
}