(function() {
'use strict';

angular.module('application.shared')
.controller('DatePickerController', ['$scope', function($scope) {
	 $scope.today = function() {
		    $scope.dt = new Date();
		  };
	$scope.today()

	$scope.open = function($event) {
	    $event.preventDefault();
	    $event.stopPropagation();
	
	    $scope.opened = true;
	};	
	
    
}]);

}());