'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _propTypes = require('prop-types');

var _propTypes2 = _interopRequireDefault(_propTypes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var Bar = function Bar(props) {
  return _react2.default.cloneElement(_react2.default.Children.only(props.children), {
    onClick: props.onClick,
    onMouseDown: props.onMouseDown,
    onTouchStart: props.onTouchStart,
    ref: props.setBar
  });
};

Bar.propTypes = {
  children: _propTypes2.default.element.isRequired,
  onClick: _propTypes2.default.func.isRequired,
  onMouseDown: _propTypes2.default.func.isRequired,
  onTouchStart: _propTypes2.default.func.isRequired,
  setBar: _propTypes2.default.func.isRequired
};

exports.default = Bar;