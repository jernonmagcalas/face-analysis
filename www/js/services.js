angular.module('starter.services', [])

.factory('Camera', ['$q', function($q) {
 
  return {
    getPicture: function(options) {
      var q = $q.defer();
      
      navigator.camera.getPicture(function(result) {
        // Do any magic you need
        q.resolve(result);
      }, function(err) {
        q.reject(err);
      }, options);
      
      return q.promise;
    }
  }
}])

.factory('Analyzer', ['$http', function($http) {

    return {
        send : function(data, success, err) {
            $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
            //var fd = new FormData();
            //$http.get("deals.theshop.ph/feed/gdeals")
            //    .success(function(response) {console.log(response)});
            //fd.append('img', $data);
            //fd.append('api_key', '83ec85fc12b1d2ca37067da2aa4b510a')
            //fd.append('api_secret', 'zQAUYqxBjotNNMaV7874l2mVMs4gZhPp')
            $http.post('http://fa-server.chiligarlic.com', {img : data}).success(success).error(err);
        }
    }
}])

/**
 * A simple example service that returns some data.
 */
.factory('Friends', function() {
  // Might use a resource here that returns a JSON array

  // Some fake testing data
  var friends = [
    { id: 0, name: 'Scruff McGruff' },
    { id: 1, name: 'G.I. Joe' },
    { id: 2, name: 'Miss Frizzle' },
    { id: 3, name: 'Ash Ketchum' }
  ];

  return {
    all: function() {
      return friends;
    },
    get: function(friendId) {
      // Simple index lookup
      return friends[friendId];
    }
  }
});
