(function() {
'use strict';

angular.module('application.shared')
.controller('TestController', ['$scope', function($scope) {

	//$scope.user = {}; //inherit from parent when commented
    $scope.counter = 0;
    $scope.change = function() {
      $scope.counter++;
    };	
    
}]);

}());