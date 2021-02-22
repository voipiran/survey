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

var PlaybackRateBarValue = function PlaybackRateBarValue(props) {
  var ratio = (props.playbackRate - props.minPlaybackRate) / (props.maxPlaybackRate - props.minPlaybackRate);
  var playbackRateBarPercentage = ratio * 100 + '%';
  var style = {
    width: !props.verticalPlaybackRate ? playbackRateBarPercentage : null,
    height: props.verticalPlaybackRate ? playbackRateBarPercentage : null
  };

  return _react2.default.createElement('div', {
    className: _constants.classes.PLAYBACK_RATE_BAR_VALUE,
    style: style
  });
};

PlaybackRateBarValue.propTypes = {
  verticalPlaybackRate: _propTypes2.default.bool.isRequired,
  minPlaybackRate: _propTypes2.default.number.isRequired,
  maxPlaybackRate: _propTypes2.default.number.isRequired,
  playbackRate: _propTypes2.default.number.isRequired
};

exports.default = PlaybackRateBarValue;