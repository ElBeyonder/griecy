var http = require('http');
var Stackable = require('../dist/stackable-node');

var stackable = new Stackable('kX8JddwDJqdf');

var server = http.createServer(function(request, response) {
  console.log('loading data...');
  stackable.getContainers(function (error, result) {
    console.log('all containers', error, result);
  });
  stackable.getContainerItems('yuXN5CHkCpfqi8Pk9', function (error, result) {
    console.log('single container items', error, result);
  });
}).listen(8080);
