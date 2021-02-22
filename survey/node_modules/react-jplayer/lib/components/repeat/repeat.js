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

var Repeat = function Repeat(_ref) {
  var loop = _ref.loop,
      children = _ref.children;
  return _react2.default.createElement(
    'button',
    { className: _constants.classes.REPEAT, onClick: loop },
    children
  );
};

Repeat.propTypes = {
  children: _propTypes2.default.node.isRequired,
  loop: _propTypes2.default.func.isRequired
};

exports.default = Repeat;