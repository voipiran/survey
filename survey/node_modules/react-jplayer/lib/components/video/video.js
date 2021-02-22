'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _propTypes = require('prop-types');

var _propTypes2 = _interopRequireDefault(_propTypes);

var _recompose = require('recompose');

var _mediaContainer = require('../media/mediaContainer');

var _mediaContainer2 = _interopRequireDefault(_mediaContainer);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

/* eslint-disable jsx-a11y/media-has-caption */

var Video = function Video(props) {
  return _react2.default.createElement(
    _mediaContainer2.default,
    {
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
    },
    _react2.default.createElement('video', null)
  );
};

Video.defaultProps = {
  onAbort: Function.prototype,
  onCanPlay: Function.prototype,
  onCanPlayThrough: Function.prototype,
  onDurationChange: Function.prototype,
  onEmptied: Function.prototype,
  onEncrypted: Function.prototype,
  onEnded: Function.prototype,
  onError: Function.prototype,
  onLoadedData: Function.prototype,
  onLoadedMetadata: Function.prototype,
  onLoadStart: Function.prototype,
  onPause: Function.prototype,
  onPlay: Function.prototype,
  onPlaying: Function.prototype,
  onProgress: Function.prototype,
  onRateChange: Function.prototype,
  onSeeked: Function.prototype,
  onSeeking: Function.prototype,
  onStalled: Function.prototype,
  onSuspend: Function.prototype,
  onTimeUpdate: Function.prototype,
  onVolumeChange: Function.prototype,
  onWaiting: Function.prototype
};

Video.propTypes = {
  onAbort: _propTypes2.default.func,
  onCanPlay: _propTypes2.default.func,
  onCanPlayThrough: _propTypes2.default.func,
  onDurationChange: _propTypes2.default.func,
  onEmptied: _propTypes2.default.func,
  onEncrypted: _propTypes2.default.func,
  onEnded: _propTypes2.default.func,
  onError: _propTypes2.default.func,
  onLoadedData: _propTypes2.default.func,
  onLoadedMetadata: _propTypes2.default.func,
  onLoadStart: _propTypes2.default.func,
  onPause: _propTypes2.default.func,
  onPlay: _propTypes2.default.func,
  onPlaying: _propTypes2.default.func,
  onProgress: _propTypes2.default.func,
  onRateChange: _propTypes2.default.func,
  onSeeked: _propTypes2.default.func,
  onSeeking: _propTypes2.default.func,
  onStalled: _propTypes2.default.func,
  onSuspend: _propTypes2.default.func,
  onTimeUpdate: _propTypes2.default.func,
  onVolumeChange: _propTypes2.default.func,
  onWaiting: _propTypes2.default.func
};

exports.default = (0, _recompose.compose)((0, _recompose.branch)(function (props) {
  return props.require;
}, (0, _recompose.renderComponent)(Video)))((0, _recompose.renderNothing)(null));