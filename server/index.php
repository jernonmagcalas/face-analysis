<?php
header("Access-Control-Allow-Origin: *");
require_once __DIR__.'/faceAppSDK.php';

$facepp = new Facepp();
$facepp->api_key       = '83ec85fc12b1d2ca37067da2aa4b510a';
$facepp->api_secret    = 'zQAUYqxBjotNNMaV7874l2mVMs4gZhPp';

//$_POST = json_decode(file_get_contents('php://input'),true);

//file_put_contents('test.txt', $_POST);

if(!isset($_POST['img']) && !isset($_POST['url'])) {
    $error = array('error' => true, 'message' => 'Missing img or url arguement');
    die(json_encode($error));
}

if(!empty($_POST['img'])) {
    $root           = realpath(__DIR__);
    $path           = '/upload';
    $file           = md5(time().floor(rand() * 1000000000000));
    $tmp            = explode(';', $_POST['img']);
    $extension      = str_replace('data:image/', '', array_shift($tmp));
    $filePath       = $root.$path.'/'.$file.'.'.$extension;

    file_put_contents($filePath, base64_decode(trim(str_replace('base64,', '', implode(';', $tmp)))));


    #detect local image
    $params['url']          = 'http://'.$_SERVER['HTTP_HOST'].$path.'/'.$file.'.'.$extension;
//    $params['url']          = 'http://www.thoughtpursuits.com/wp-content/uploads/2014/03/happy-sad-face-720x340.jpg';
} else {
    $params['url'] = $_POST['url'];
}

$params['attribute']    = 'gender,age,race,smiling,glass,pose';

$response = $facepp->execute('/detection/detect', $params);

if(isset($filePath)) {
    unlink($root.$path.'/'.$file.'.'.$extension);
}

die($response['body']);