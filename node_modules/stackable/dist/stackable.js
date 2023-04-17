'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

require('es6-promise').polyfill();
require('isomorphic-fetch');

var Stackable = function () {
    function Stackable(token) {
        _classCallCheck(this, Stackable);

        this._token = token;
        this._apiVersion = 'v1';
        this._apiUrl = 'https://api.stackable.space';
    }

    _createClass(Stackable, [{
        key: 'getContainers',
        value: function getContainers(callback) {
            this._get('containers', function (err, res) {
                callback(err, res);
            });
        }
    }, {
        key: 'getContainer',
        value: function getContainer(containerId, callback) {
            this._get('containers/' + containerId, function (err, res) {
                callback(err, res);
            });
        }
    }, {
        key: 'getContainerItems',
        value: function getContainerItems(containerId, query, callback) {
            if (typeof callback === 'undefined') {
                callback = query;
                query = {};
            }

            this._get('containers/' + containerId + '/items', query, function (err, res) {
                callback(err, res);
            });
        }
    }, {
        key: 'getAllItems',
        value: function getAllItems(query, callback) {
            if (typeof callback === 'undefined') {
                callback = query;
                query = {};
            }

            this._get('items', query, function (err, res) {
                callback(err, res);
            });
        }
    }, {
        key: 'getItem',
        value: function getItem(itemId, query, callback) {
            if (typeof callback === 'undefined') {
                callback = query;
                query = {};
            }

            this._get('items/' + itemId, query, function (err, res) {
                callback(err, res);
            });
        }
    }, {
        key: 'createItem',
        value: function createItem(containerId, data, callback) {
            this._post('items', { containerId: containerId }, data, function (err, res) {
                callback(err, res);
            });
        }
    }, {
        key: 'updateItem',
        value: function updateItem(itemId, data, callback) {
            this._put('items/' + itemId, data, function (err, res) {
                callback(err, res);
            });
        }
    }, {
        key: '_queryString',
        value: function _queryString(obj) {
            return Object.keys(obj).map(function (key) {
                return key + '=' + obj[key];
            }).join('&');
        }
    }, {
        key: '_get',
        value: function _get(path, query, callback) {
            var endPoint = this._apiUrl + '/' + this._apiVersion + '/' + path + '?token=' + this._token + '&' + this._queryString(query);

            if (typeof callback == 'undefined') {
                callback = query;
            }

            fetch(endPoint).then(function (response) {
                if (response.status >= 400) {
                    var err = {
                        'message': 'There was an error with this request.'
                    };
                    return callback(err, false);
                }
                return response.json();
            }).then(function (response) {
                callback(false, response);
            });
        }
    }, {
        key: '_post',
        value: function _post(path, params, data, callback) {
            var endPoint = this._apiUrl + '/' + this._apiVersion + '/' + path + '?token=' + this._token;

            var paramsStr = '';
            for (var key in params) {
                if (paramsStr != '') {
                    paramsStr += '&';
                }
                paramsStr += key + '=' + encodeURIComponent(params[key]);
            }

            if (paramsStr.length > 0) {
                endPoint = endPoint + '&' + paramsStr;
            }

            fetch(endPoint, {
                method: 'POST',
                headers: {
                    'Content-type': 'application/json'
                },
                body: data
            }).then(function (response) {
                if (response.status >= 400) {
                    var err = {
                        'message': 'There was an error with this request.'
                    };
                    return callback(err, false);
                }
                return response.json();
            }).then(function (response) {
                return callback(false, response);
            });
        }
    }, {
        key: '_put',
        value: function _put(path, data, callback) {
            var endPoint = this._apiUrl + '/' + this._apiVersion + '/' + path + '?token=' + this._token;

            fetch(endPoint, {
                method: 'PUT',
                headers: {
                    'Content-type': 'application/json'
                },
                body: data
            }).then(function (response) {
                if (response.status >= 400) {
                    var err = {
                        'message': 'There was an error with this request.'
                    };
                    return callback(err, false);
                }
                return response.json();
            }).then(function (response) {
                return callback(false, response);
            });
        }
    }]);

    return Stackable;
}();

exports.default = Stackable;
//if (typeof window === 'undefined') {
//    //node
//    module.exports = Stackable;
//} else {
//    //browser
//    window.Stackable = Stackable;
//}