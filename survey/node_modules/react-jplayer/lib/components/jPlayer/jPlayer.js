'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _propTypes = require('prop-types');

var _propTypes2 = _interopRequireDefault(_propTypes);

var _keyControlContainer = require('./keyControl/keyControlContainer');

var _keyControlContainer2 = _interopRequireDefault(_keyControlContainer);

var _screenFullContainer = require('./screenFull/screenFullContainer');

var _screenFullContainer2 = _interopRequireDefault(_screenFullContainer);

var _errorLoggerContainer = require('./errorLogger/errorLoggerContainer');

var _errorLoggerContainer2 = _interopRequireDefault(_errorLoggerContainer);

var _timeDisplayContainer = require('./timeDisplay/timeDisplayContainer');

var _timeDisplayContainer2 = _interopRequireDefault(_timeDisplayContainer);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

/* eslint-disable react/forbid-prop-types */

var JPlayer = function JPlayer(props) {
  var className = props.className,
      keyBindings = props.keyBindings,
      children = props.children,
      onMouseMoveCapture = props.onMouseMoveCapture,
      id = props.id;


  return _react2.default.createElement(
    'div',
    {
      id: id,
      className: className,
      draggable: false,
      onMouseMoveCapture: onMouseMoveCapture
    },
    _react2.default.createElement(_keyControlContainer2.default, { keyBindings: keyBindings }),
    _react2.default.createElement(_timeDisplayContainer2.default, null),
    _react2.default.createElement(_screenFullContainer2.default, null),
    _react2.default.createElement(_errorLoggerContainer2.default, null),
    children
  );
};

JPlayer.defaultProps = {
  keyBindings: null
};

JPlayer.propTypes = {
  keyBindings: _propTypes2.default.object,
  onMouseMoveCapture: _propTypes2.default.func.isRequired,
  className: _propTypes2.default.string.isRequired,
  id: _propTypes2.default.string.isRequired,
  children: _propTypes2.default.oneOfType([_propTypes2.default.arrayOf(_propTypes2.default.element), _propTypes2.default.element]).isRequired
};

exports.default = JPlayer;