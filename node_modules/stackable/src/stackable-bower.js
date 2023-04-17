'use strict';

class Stackable {
    constructor(token) {
        this._token = token;
        this._apiVersion = 'v1';
        this._apiUrl = 'https://api.stackable.space';
    }

    getContainers(callback) {
        this._get('containers', function(err, res) {
            callback(err, res);
        });
    }

    getContainer(containerId, callback) {
        this._get(`containers/${containerId}`, function(err, res) {
            callback(err, res);
        });
    }

    getContainerItems(containerId, query, callback) {
        if (typeof callback === 'undefined') {
            callback = query;
            query = {};
        }

        this._get(`containers/${containerId}/items`, query, function(err, res) {
            callback(err, res);
        });
    }

    getAllItems(query, callback) {
        if (typeof callback === 'undefined') {
            callback = query;
            query = {};
        }

        this._get('items', query, function(err, res) {
            callback(err, res);
        });
    }

    getItem(itemId, query, callback) {
        if (typeof callback === 'undefined') {
            callback = query;
            query = {};
        }

        this._get(`items/${itemId}`, query, function(err, res) {
            callback(err, res);
        });
    }

    createItem(containerId, data, callback) {
        this._post('items', {containerId}, data, function(err, res) {
            callback(err, res);
        });
    }

    updateItem(itemId, data, callback) {
        this._put(`items/${itemId}`, data, function(err, res) {
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

        //is browser
        $.ajax({
            url: endPoint,
            type: 'GET',
            context: document.body,
            success: function(response) {
                callback(false, response);
            },
            error: function(err) {
                callback(err, false);
            }
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

        //is browser
        $.ajax({
            url: endPoint,
            type: 'POST',
            context: document.body,
            data: data,
            success: function(response) {
                callback(false, response);
            },
            error: function(err) {
                callback(err, false);
            }
        });
    }

    _put(path, data, callback) {
        let endPoint = `${this._apiUrl}/${this._apiVersion}/${path}?token=${this._token}`;

        //is browser
        $.ajax({
            url: endPoint,
            type: 'PUT',
            context: document.body,
            data: data,
            success: function(response) {
                callback(false, response);
            },
            error: function(err) {
                callback(err, false);
            }
        });
    }
}

window.Stackable = Stackable;
