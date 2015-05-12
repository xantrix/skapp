(function() {
'use strict';

angular.module('application.shared')
.directive('addItem', [function() {
	return function(scope, elm, attrs, p4) {
        
		elm.bind( "click", function() {
			var currentCount = $('div#'+attrs.id+' > fieldset > fieldset').length;
	        var template = $('div#'+attrs.id+' > fieldset > span').data('template');
	        template = template.replace(/__index__/g, currentCount);

	        $('div#'+attrs.id+' > fieldset').append(template);
	        return false;
		});		
		
	};
}])
.directive('removeItem', [function() {
	return function(scope, elm, attrs, p4) {
        
		elm.bind( "click", function() {
	        $('div#'+attrs.id+' > fieldset > fieldset:last-of-type').remove();
	        return false;
		});		
		
	};
}]);

}());