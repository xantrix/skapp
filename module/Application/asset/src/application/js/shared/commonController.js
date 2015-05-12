(function() {
'use strict';

angular.module('application.shared')
.controller('CommonController', ['$scope', function($scope) {
    
	$scope.user = {};
	$scope.counter = 0;
    $scope.change = function() {
      $scope.counter++;
    };
    
}]);

}());