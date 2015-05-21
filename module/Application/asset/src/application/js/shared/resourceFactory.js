(function() {
'use strict';

angular.module('application.shared')
.factory('Resource', ['$q', '$filter', '$timeout','$resource', function ($q, $filter, $timeout, $resource) {

	function getPage(url, page, length, search, sort, params) {

		var deferred = $q.defer();
		
		//call server endpoint
		var result = $resource(url, {page:page, length:length, search:search, sort:sort } ).get(function(){
			deferred.resolve({
				data: result.data,
				numberOfPages: result.pagesTotal
			});    		
    	});		
		
		return deferred.promise;
	}

	return {
		getPage: getPage
	};
    
}]);

}());