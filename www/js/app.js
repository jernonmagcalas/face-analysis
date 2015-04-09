// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
// 'starter.services' is found in services.js
// 'starter.controllers' is found in controllers.js
angular.module('starter', ['ionic', 'starter.services'])

    .config(function($compileProvider){
        $compileProvider.imgSrcSanitizationWhitelist(/^\s*(https?|ftp|mailto|file|tel):/);
    })

    .run(function($ionicPlatform) {
        $ionicPlatform.ready(function() {
            if(window.StatusBar) {
                // org.apache.cordova.statusbar required
                StatusBar.styleDefault();
            }
        });
    })

    .controller('MainCtrl', function($scope, Camera, Analyzer) {

        $scope.getPhoto = function() {
            Camera.getPicture(
                {
                    quality: 100,
                    targetWidth: 320,
                    targetHeight: 320,
                    saveToPhotoAlbum: false,
                    //destinationType: navigator.camera.DestinationType.DATA_URL,
                    //sourceType: navigator.camera.PictureSourceType.PHOTOLIBRARY,
                    correctOrientation: true
                }
            ).then(function(imageURI) {
                console.log(imageURI);
                $scope.lastPhoto = imageURI;
            }, function(err) {
                console.err(err);
            });
        };

        $scope.selectPhoto = function() {
            Camera.getPicture(
                {
                    quality: 100,
                    targetWidth: 320,
                    targetHeight: 320,
                    saveToPhotoAlbum: false,
                    destinationType: navigator.camera.DestinationType.DATA_URL,
                    sourceType: navigator.camera.PictureSourceType.PHOTOLIBRARY,
                    correctOrientation: true
                }
            ).then(function(imageData) {
                    var x = 'data:image/jpeg;base64,' + imageData;
                    console.log(x);
                    Analyzer.send(x,function(x, b, d) {
                        console.log('success');
                        console.log(b);
                        console.log(d);
                    }, function(x, b) {
                        console.log('error')
                        console.log(b)
                    })
                //$scope.lastPhoto = imageData;
            }, function(err) {
                console.log(err);
            });
        }

    })
