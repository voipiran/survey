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

var _playbackRateBarValueContainer = require('../playbackRateBarValue/playbackRateBarValueContainer');

var _playbackRateBarValueContainer2 = _interopRequireDefault(_playbackRateBarValueContainer);

var _constants = require('../../util/constants');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var PlaybackRateBar = function PlaybackRateBar(props) {
  return _react2.default.createElement(
    _barContainer2.default,
    {
      clickMoveBar: props.clickMoveBar,
      touchMoveBar: props.touchMoveBar
    },
    _react2.default.createElement(
      'div',
      { className: _constants.classes.PLAYBACK_RATE_BAR },
      props.children
    )
  );
};

PlaybackRateBar.defaultProps = {
  children: _react2.default.createElement(_playbackRateBarValueContainer2.default, null)
};

PlaybackRateBar.propTypes = {
  clickMoveBar: _propTypes2.default.func.isRequired,
  touchMoveBar: _propTypes2.default.func.isRequired,
  children: _propTypes2.default.node
};

exports.default = PlaybackRateBar;