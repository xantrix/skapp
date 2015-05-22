(function() {
'use strict';

angular.module('application.shared')
.factory('Resource', ['$q', '$filter', '$timeout','$resource','$http', function ($q, $filter, $timeout, $resource, $http) {

	function getPage(url, page, length, search, sort, tableState) {

		var params = search.predicateObject || {};
		params.page = page;
		params.length = length;
		params.sort = sort;
		
		//return promise
		return $http.get(url, { params: params } );//url,config
		
		/**
		 * http://stackoverflow.com/questions/12190166/angularjs-any-way-for-http-post-to-send-request-parameters-instead-of-json
		 * https://github.com/angular/angular.js/issues/6039
		 * http://victorblog.com/2012/12/20/make-angularjs-http-service-behave-like-jquery-ajax/
		 */
		/*return $http.post(
				url, 
				params,
				{
					transformRequest: function(data){
			        return $.param(data);
					},
					headers: {'Content-Type': 'application/x-www-form-urlencoded'} 
			    }
		);*/ 
		//url,data,config
		
		//var deferred = $q.defer();
		//call server endpoint
		/*var result = $resource(url, {page:page, length:length, search:search, sort:sort } ).get(function(){
			deferred.resolve({
				data: result.data,
				numberOfPages: result.pagesTotal
			});    		
    	});	*/	
		//return deferred.promise;
	}

	return {
		getPage: getPage
	};
    
}]);

}());