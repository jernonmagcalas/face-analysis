<?php
require_once __DIR__.'/faceAppSDK.php';

$facepp = new Facepp();
$facepp->api_key       = '83ec85fc12b1d2ca37067da2aa4b510a';
$facepp->api_secret    = 'zQAUYqxBjotNNMaV7874l2mVMs4gZhPp';

if(!isset($_POST['img'])) {
    die('Error! Missing Img arguement');
}

#detect local image 
$params['img']          = $_POST['img'];
$params['attribute']    = 'gender,age,race,smiling,glass,pose';

$response               = $facepp->execute('/detection/detect',$params);
die($response['body']);