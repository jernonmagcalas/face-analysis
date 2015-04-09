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

        var reset = function() {
            $scope.age = '';
            $scope.gender = '';
            $scope.glass = '';
            $scope.race = '';
            $scope.happy = '';
        }

        $scope.getPhoto = function() {


            Camera.getPicture(
                {
                    quality: 100,
                    targetWidth: 320,
                    targetHeight: 320,
                    saveToPhotoAlbum: false,
                    destinationType: navigator.camera.DestinationType.DATA_URL,
                    correctOrientation: true
                }
            ).then(function(imageData) {
                var x = 'data:image/jpeg;base64,' + imageData;
                document.getElementById('preview').src = x ;
                reset();

                Analyzer.send(x,function(response) {
                    if(!response.face[0]) {
                        alert('Unable to detect your stupid face. Pleace change your face.')
                        return;
                    }

                    $scope.age = response.face[0].attribute.age.value;
                    $scope.gender = response.face[0].attribute.gender.value;
                    $scope.glass = response.face[0].attribute.glass.value;
                    $scope.race = response.face[0].attribute.race.value;
                    $scope.happy = response.face[0].attribute.smiling.value + '%';

                }, function() {
                    alert('rest server error');
                });
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
                    correctOrientation: true,
                    destinationType: navigator.camera.DestinationType.DATA_URL,
                    sourceType: navigator.camera.PictureSourceType.PHOTOLIBRARY
                }
            ).then(function(imageData) {
                var x = 'data:image/jpeg;base64,' + imageData;
                document.getElementById('preview').src = x ;
                reset();

                Analyzer.send(x,function(response) {
                    if(!response.face[0]) {
                        alert('Unable to detect your stupid face. Pleace change your face.')
                        return;
                    }

                    $scope.age = response.face[0].attribute.age.value;
                    $scope.gender = response.face[0].attribute.gender.value;
                    $scope.glass = response.face[0].attribute.glass.value;
                    $scope.race = response.face[0].attribute.race.value;
                    $scope.happy = response.face[0].attribute.smiling.value + '%';

                }, function() {
                    alert('rest server error');
                });
            }, function(err) {
                console.log(err);
            });
        }

    })
