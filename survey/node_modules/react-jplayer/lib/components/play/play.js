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

var Play = function Play(_ref) {
  var play = _ref.play,
      id = _ref.id,
      paused = _ref.paused,
      children = _ref.children;
  return _react2.default.createElement(
    'button',
    { className: _constants.classes.PLAY, onClick: function onClick() {
        return play(id, paused);
      } },
    children
  );
};

Play.propTypes = {
  children: _propTypes2.default.node.isRequired,
  play: _propTypes2.default.func.isRequired,
  id: _propTypes2.default.string.isRequired,
  paused: _propTypes2.default.bool.isRequired
};

exports.default = Play;