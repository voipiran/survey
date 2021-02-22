'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _propTypes = require('prop-types');

var _propTypes2 = _interopRequireDefault(_propTypes);

var _constants = require('../../util/constants');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var BufferBar = function BufferBar(_ref) {
  var setCanvas = _ref.setCanvas;
  return _react2.default.createElement('canvas', {
    ref: setCanvas,
    className: _constants.classes.BUFFER_BAR
  });
};

BufferBar.propTypes = {
  setCanvas: _propTypes2.default.func.isRequired
};

exports.default = BufferBar;