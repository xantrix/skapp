(function() {
'use strict';

angular.module('application.version', [
  'application.version.interpolate-filter',
  'application.version.version-directive'
])

.value('version', '0.1');

}());