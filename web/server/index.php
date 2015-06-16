<?php
header("Access-Control-Allow-Origin: *");
require_once __DIR__.'/faceAppSDK.php';

$facepp = new Facepp();
$facepp->api_key       = '83ec85fc12b1d2ca37067da2aa4b510a';
$facepp->api_secret    = 'zQAUYqxBjotNNMaV7874l2mVMs4gZhPp';

if(!isset($_POST)) {
	$_POST = json_decode(file_get_contents('php://input'),true);
}

if(!isset($_POST['img']) && !isset($_POST['url'])) {
$error = array('error' => true, 'message' => 'Missing img or url arguement');
    die(json_encode($error));
}

if(isset($_POST['img'])) {
	$root           = realpath(__DIR__.'/..');
	$path           = '/upload/';
	$file           = md5(time().floor(rand() * 1000000000000));
	$tmp            = explode(';', $_POST['img']);
	$extension      = str_replace('data:image/', '', array_shift($tmp));
	file_put_contents(
	        $root.$path.$file.'.'.$extension,
	        base64_decode(trim(str_replace('base64,', '', implode(';', $tmp)))));

	#detect local image 
	$params['url'] = 'http://face-analyzer.dev/images/'.$file.'.'.$extension;
	$params['url'] = 'http://www.hdwallpapersimages.com/wp-content/uploads/images/Child-Girl-with-Sunflowers-Images-540x337.jpg';
}

if(isset($_POST['url'])) {
	$params['url'] = $_POST['url'];
}

$params['attribute']    = 'gender,age,race,smiling,glass,pose';
$response               = $facepp->execute('/detection/detect', $params);
if(isset($_POST['img'])) { unlink($root.$path.$file.'.'.$extension); }
die($response['body']);