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

var FullScreen = function FullScreen(_ref) {
  var setFullScreen = _ref.setFullScreen,
      id = _ref.id,
      fullScreen = _ref.fullScreen,
      children = _ref.children;
  return _react2.default.createElement(
    'button',
    {
      className: _constants.classes.FULL_SCREEN,
      onClick: function onClick() {
        return setFullScreen(id, !fullScreen);
      }
    },
    children
  );
};

FullScreen.propTypes = {
  children: _propTypes2.default.node.isRequired,
  setFullScreen: _propTypes2.default.func.isRequired,
  id: _propTypes2.default.string.isRequired,
  fullScreen: _propTypes2.default.bool.isRequired
};

exports.default = FullScreen;