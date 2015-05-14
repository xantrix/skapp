Asset
=======================

Application setup
----------------------

1. Install nodejs
2. `npm install -g bower`
3. `npm install -g grunt-cli`
4. `cd module/Application/asset` and execute:
    `npm install`
    `bower install`
    `grunt default`

**Note:** use `grunt watch` to keep js/less files synced in dist directory

Differences
-------------
http://stackoverflow.com/questions/21198977/difference-between-grunt-npm-and-bower-package-json-vs-bower-json 
package.json is intended for back-end purposes, in this case specify grunt tasks, node dependencies, etc. 
In the other side, bower.json is intended for front-end purposes.

Semantic Versioning
----
MAJOR.MINOR.PATCH
http://semver.org/
https://github.com/npm/node-semver#ranges

Grunt
-----------
grunt default #'clean:build', 'stylesheet', 'javascript', 'copy:images']
grunt javascript #'concat', 'uglify', 'copy:main'
grunt stylesheet #'less:compile', 'cssmin', 'copy:fonts'


Npm
------------
npm --version
http://jshint.com/docs/ [.jshintrc ]
sudo npm -g update npm #update global npm

npm list #list local packages
npm outdated
npm update, [global install/update: sudo npm update -g bower]

Bower
------------
bower --version #show version
http://bower.io/docs/config/   [.bowerrc ]
https://github.com/bower/bower.json-spec [bower.json]
bower list #List local packages - and possible updates 
bower update