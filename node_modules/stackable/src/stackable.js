'use strict';

require('es6-promise').polyfill();
require('isomorphic-fetch');

class Stackable {
    constructor(token) {
        this._token = token;
        this._apiVersion = 'v1';
        this._apiUrl = 'https://api.stackable.space';
    }

    getContainers(callback) {
        this._get('containers', function (err, res) {
            callback(err, res);
        });
    }

    getContainer(containerId, callback) {
        this._get(`containers/${containerId}`, function (err, res) {
            callback(err, res);
        });
    }

    getContainerItems(containerId, query, callback) {
        if (typeof callback === 'undefined') {
            callback = query;
            query = {};
        }

        this._get(`containers/${containerId}/items`, query, function (err, res) {
            callback(err, res);
        });
    }

    getAllItems(query, callback) {
        if (typeof callback === 'undefined') {
            callback = query;
            query = {};
        }

        this._get('items', query, function (err, res) {
            callback(err, res);
        });
    }

    getItem(itemId, query, callback) {
        if (typeof callback === 'undefined') {
            callback = query;
            query = {};
        }

        this._get(`items/${itemId}`, query, function (err, res) {
            callback(err, res);
        });
    }

    createItem(containerId, data, callback) {
        this._post('items', {containerId}, data, function (err, res) {
            callback(err, res);
        });
    }

    updateItem(itemId, data, callback) {
        this._put(`items/${itemId}`, data, function (err, res) {
            callback(err, res);
        });
    }

    _queryString(obj) {
        return Object.keys(obj).map(function(key) {
            return key + '=' + obj[key];
        }).join('&');
    }

    _get(path, query, callback) {
        let endPoint = `${this._apiUrl}/${this._apiVersion}/${path}?token=${this._token}&${this._queryString(query)}`;

        if (typeof callback == 'undefined') {
            callback = query;
        }

        fetch(endPoint)
            .then(function (response) {
                if (response.status >= 400) {
                    var err = {
                        'message': 'There was an error with this request.'
                    };
                    return callback(err, false);
                }
                return response.json();
            })
            .then(function (response) {
                callback(false, response);
            });
    }

    _post(path, params, data, callback) {
        let endPoint = `${this._apiUrl}/${this._apiVersion}/${path}?token=${this._token}`;

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
                return response.json()
            })
            .then(function (response) {
                return callback(false, response);
            });
    }

    _put(path, data, callback) {
        let endPoint = `${this._apiUrl}/${this._apiVersion}/${path}?token=${this._token}`;

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
                return response.json()
            })
            .then(function (response) {
                return callback(false, response);
            });
    }
}

export default Stackable;
//if (typeof window === 'undefined') {
//    //node
//    module.exports = Stackable;
//} else {
//    //browser
//    window.Stackable = Stackable;
//}
