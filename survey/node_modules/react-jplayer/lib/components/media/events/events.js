'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _propTypes = require('prop-types');

var _propTypes2 = _interopRequireDefault(_propTypes);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var Events = function Events(props) {
  return _react2.default.cloneElement(_react2.default.Children.only(props.children), {
    onAbort: props.onAbort,
    onCanPlay: props.onCanPlay,
    onCanPlayThrough: props.onCanPlayThrough,
    onDurationChange: props.onDurationChange,
    onEmptied: props.onEmptied,
    onEncrypted: props.onEncrypted,
    onEnded: props.onEnded,
    onError: props.onError,
    onLoadedData: props.onLoadedData,
    onLoadedMetadata: props.onLoadedMetadata,
    onLoadStart: props.onLoadStart,
    onPause: props.onPause,
    onPlay: props.onPlay,
    onPlaying: props.onPlaying,
    onProgress: props.onProgress,
    onRateChange: props.onRateChange,
    onSeeked: props.onSeeked,
    onSeeking: props.onSeeking,
    onStalled: props.onStalled,
    onSuspend: props.onSuspend,
    onTimeUpdate: props.onTimeUpdate,
    onVolumeChange: props.onVolumeChange,
    onWaiting: props.onWaiting
  });
};

Events.propTypes = {
  children: _propTypes2.default.element.isRequired,
  onAbort: _propTypes2.default.func.isRequired,
  onCanPlay: _propTypes2.default.func.isRequired,
  onCanPlayThrough: _propTypes2.default.func.isRequired,
  onDurationChange: _propTypes2.default.func.isRequired,
  onEmptied: _propTypes2.default.func.isRequired,
  onEncrypted: _propTypes2.default.func.isRequired,
  onEnded: _propTypes2.default.func.isRequired,
  onError: _propTypes2.default.func.isRequired,
  onLoadedData: _propTypes2.default.func.isRequired,
  onLoadedMetadata: _propTypes2.default.func.isRequired,
  onLoadStart: _propTypes2.default.func.isRequired,
  onPause: _propTypes2.default.func.isRequired,
  onPlay: _propTypes2.default.func.isRequired,
  onPlaying: _propTypes2.default.func.isRequired,
  onProgress: _propTypes2.default.func.isRequired,
  onRateChange: _propTypes2.default.func.isRequired,
  onSeeked: _propTypes2.default.func.isRequired,
  onSeeking: _propTypes2.default.func.isRequired,
  onStalled: _propTypes2.default.func.isRequired,
  onSuspend: _propTypes2.default.func.isRequired,
  onTimeUpdate: _propTypes2.default.func.isRequired,
  onVolumeChange: _propTypes2.default.func.isRequired,
  onWaiting: _propTypes2.default.func.isRequired
};

exports.default = Events;