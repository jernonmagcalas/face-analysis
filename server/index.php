<?php
header("Access-Control-Allow-Origin: *");
require_once __DIR__.'/faceAppSDK.php';

$facepp = new Facepp();
$facepp->api_key       = '83ec85fc12b1d2ca37067da2aa4b510a';
$facepp->api_secret    = 'zQAUYqxBjotNNMaV7874l2mVMs4gZhPp';

$_POST = json_decode(file_get_contents('php://input'),true);

file_put_contents('test.txt', $_POST);

if(!isset($_POST['img'])) {
$error = array('error' => true, 'message' => 'Missing img arguement');
    die(json_encode($error));
}

$root           = realpath(__DIR__);
$path           = '/';
$file           = md5(time().floor(rand() * 1000000000000));
$tmp            = explode(';', $_POST['img']);
$extension      = str_replace('data:image/', '', array_shift($tmp));
file_put_contents(
        $root.$path.'/'.$file.'.'.$extension,
        base64_decode(trim(str_replace('base64,', '', implode(';', $tmp)))));


#detect local image 
$params['img']          = $root.$path.'/'.$file.'.'.$extension;
$params['attribute']    = 'gender,age,race,smiling,glass,pose';

$response               = $facepp->execute('/detection/detect', $params);
unlink($root.$path.'/'.$file.'.'.$extension);
die($response['body']);