(function() {
'use strict';

angular.module('application.shared')
.controller('StController', ['$scope','$attrs','$controller','Resource', function($scope, $attrs, $controller, service) {
    
	  $scope.isLoading = true;
	  $scope.displayed = [];

	  //st-pipe="callServer"
	  $scope.callServer = function callServer(tableState) {

		  $scope.isLoading = true;

		  var page = (tableState.pagination.start / tableState.pagination.number)+1; //start->first-index of current page
		  var length = tableState.pagination.number;//st-items-by-page
	      var search = tableState.search; //st-search: full of filters object (typeof tableState.search != 'undefined' ) ;
	      var sort = tableState.sort; //st-sort
	    
	      //call resource factory
		  service.getPage($attrs.url, page, length, search, sort, tableState).then(function (result) {
			  $scope.displayed = result.data;
			  tableState.pagination.numberOfPages = result.numberOfPages;//set the number of pages from server
			  $scope.isLoading = false;
		  });
	  };
    
}]);

}());