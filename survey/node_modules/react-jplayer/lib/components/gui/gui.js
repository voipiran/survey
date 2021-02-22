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

var Gui = function Gui(_ref) {
  var opacity = _ref.opacity,
      children = _ref.children,
      onMouseMove = _ref.onMouseMove;
  return _react2.default.createElement(
    'div',
    {
      className: _constants.classes.GUI,
      onMouseMove: onMouseMove,
      style: { opacity: opacity }
    },
    children
  );
};

Gui.propTypes = {
  opacity: _propTypes2.default.number.isRequired,
  onMouseMove: _propTypes2.default.func.isRequired,
  children: _propTypes2.default.oneOfType([_propTypes2.default.arrayOf(_propTypes2.default.element), _propTypes2.default.element]).isRequired
};

exports.default = Gui;