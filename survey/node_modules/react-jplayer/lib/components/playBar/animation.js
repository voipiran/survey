'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _reactMotion = require('react-motion');

var _propTypes = require('prop-types');

var _propTypes2 = _interopRequireDefault(_propTypes);

var _playBar = require('./playBar');

var _playBar2 = _interopRequireDefault(_playBar);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var Animation = function Animation(props) {
  return _react2.default.createElement(
    _reactMotion.Motion,
    { style: { smoothWidth: (0, _reactMotion.spring)(props.currentPercentAbsolute, [250]) } },
    function (values) {
      return _react2.default.createElement(_playBar2.default, {
        smoothWidth: values.smoothWidth,
        smoothPlayBar: props.smoothPlayBar,
        currentPercentRelative: props.currentPercentRelative
      });
    }
  );
};

Animation.propTypes = {
  currentPercentRelative: _propTypes2.default.number.isRequired,
  currentPercentAbsolute: _propTypes2.default.number.isRequired,
  smoothPlayBar: _propTypes2.default.bool.isRequired
};

exports.default = Animation;