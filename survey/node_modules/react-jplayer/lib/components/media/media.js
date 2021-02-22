'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _react = require('react');

var _react2 = _interopRequireDefault(_react);

var _propTypes = require('prop-types');

var _propTypes2 = _interopRequireDefault(_propTypes);

var _eventsContainer = require('./events/eventsContainer');

var _eventsContainer2 = _interopRequireDefault(_eventsContainer);

var _track = require('./track/track');

var _track2 = _interopRequireDefault(_track);

var _constants = require('../../util/constants');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var Media = function Media(props) {
  return _react2.default.createElement(
    _eventsContainer2.default,
    {
      updateMediaStatus: props.updateMediaStatus,
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
    _react2.default.cloneElement(_react2.default.Children.only(props.children), {
      ref: props.setCurrentMedia,
      className: _constants.classes.MEDIA
    }, props.tracks.map(function (track) {
      return _react2.default.createElement(_track2.default, _extends({ key: track.src }, track));
    }))
  );
};

Media.defaultProps = {
  tracks: []
};

Media.propTypes = {
  children: _propTypes2.default.node.isRequired,
  setCurrentMedia: _propTypes2.default.func.isRequired,
  updateMediaStatus: _propTypes2.default.func.isRequired,
  tracks: _propTypes2.default.arrayOf(_propTypes2.default.shape({
    default: _propTypes2.default.bool,
    kind: _propTypes2.default.string,
    src: _propTypes2.default.string.isRequired,
    label: _propTypes2.default.string,
    srclang: _propTypes2.default.string
  })),
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

exports.default = Media;