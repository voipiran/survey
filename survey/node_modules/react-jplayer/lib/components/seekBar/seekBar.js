'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _propTypes = require('prop-types');

var _propTypes2 = _interopRequireDefault(_propTypes);

var _barContainer = require('../barContainer');

var _barContainer2 = _interopRequireDefault(_barContainer);

var _constants = require('../../util/constants');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var SeekBar = function SeekBar(props) {
  return _react2.default.createElement(
    _barContainer2.default,
    {
      clickMoveBar: props.clickMoveBar,
      touchMoveBar: props.touchMoveBar
    },
    _react2.default.createElement(
      'div',
      {
        className: _constants.classes.SEEK_BAR,
        style: { width: props.seekPercent + '%' }
      },
      props.children
    )
  );
};

SeekBar.propTypes = {
  seekPercent: _propTypes2.default.number.isRequired,
  clickMoveBar: _propTypes2.default.func.isRequired,
  touchMoveBar: _propTypes2.default.func.isRequired,
  children: _propTypes2.default.oneOfType([_propTypes2.default.arrayOf(_propTypes2.default.element), _propTypes2.default.element]).isRequired
};

exports.default = SeekBar;