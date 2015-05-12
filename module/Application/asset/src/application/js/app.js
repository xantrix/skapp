(function() {
    'use strict';
  
    /* Register modules */
    angular.module('application.shared',[]);
    
    /* Register application */
    angular.module('application', [
	    'ui.bootstrap',
	    'application.shared',
	    'application.version'    
    ]);

}());
