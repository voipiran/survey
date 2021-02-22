'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.initialState = undefined;

var _lodash = require('lodash.merge');

var _lodash2 = _interopRequireDefault(_lodash);

var _constants = require('../util/constants');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var initialState = exports.initialState = {};

var options = function options(jPlayerOptions) {
  initialState[jPlayerOptions.id] = (0, _lodash2.default)({}, _constants.defaultStatus, _constants.defaultOptions, jPlayerOptions);
};

exports.default = options;