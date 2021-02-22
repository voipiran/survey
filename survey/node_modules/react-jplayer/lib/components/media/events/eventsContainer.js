'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _propTypes = require('prop-types');

var _propTypes2 = _interopRequireDefault(_propTypes);

var _recompose = require('recompose');

var _reactJplayerUtils = require('react-jplayer-utils');

var _events = require('./events');

var _events2 = _interopRequireDefault(_events);

var _urlNotSupportedError = require('../../../util/errorHandlers/urlNotSupportedError');

var _urlNotSupportedError2 = _interopRequireDefault(_urlNotSupportedError);

var _actions = require('../../../actions/actions');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var mapStateToProps = function mapStateToProps(_ref, _ref2) {
  var jPlayers = _ref.jPlayers;
  var id = _ref2.id;
  return {
    src: jPlayers[id].src,
    pauseOthersOnPlay: jPlayers[id].pauseOthersOnPlay,
    otherJPlayerIds: Object.keys(jPlayers).filter(function (key) {
      return key !== id;
    })
  };
};

var contextTypes = {
  internalEvents: _propTypes2.default.shape({
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
  })
};

var defaultProps = {
  internalEvents: {}
};

var mapEvents = function mapEvents(ownerProps) {
  var events = {};

  Object.keys(ownerProps.internalEvents).forEach(function (key) {
    events[key] = function (e) {
      ownerProps.internalEvents[key](e);
      ownerProps[key](e);
    };
  });

  return _extends({}, ownerProps, events);
};

var firstHandlers = {
  pauseOthers: function pauseOthers(props) {
    return function () {
      props.otherJPlayerIds.forEach(function (id) {
        return props.pause(id);
      });
    };
  }
};

var secondHandlers = {
  onDurationChange: function onDurationChange(props) {
    return function (e) {
      props.updateMediaStatus();
      props.onDurationChange(e);
    };
  },
  onEnded: function onEnded(props) {
    return function (e) {
      props.pause(props.id, 0);
      props.updateMediaStatus();
      props.onEnded(e);
    };
  },
  onError: function onError(props) {
    return function (e) {
      props.setOption(props.id, 'error', (0, _urlNotSupportedError2.default)(props.src));
      props.onError(e);
    };
  },
  onPlay: function onPlay(props) {
    return function (e) {
      if (props.pauseOthersOnPlay) {
        props.pauseOthers();
      }
      props.play(props.id);
      props.onPlay(e);
    };
  },
  onProgress: function onProgress(props) {
    return function (e) {
      var bufferedTimeRanges = [];

      for (var i = 0; i < e.currentTarget.buffered.length; i += 1) {
        bufferedTimeRanges.push({
          start: e.currentTarget.buffered.start(i),
          end: e.currentTarget.buffered.end(i)
        });
      }
      props.updateMediaStatus();
      props.setOption(props.id, 'bufferedTimeRanges', bufferedTimeRanges);
      props.onProgress(e);
    };
  },
  onSeeked: function onSeeked(props) {
    return function (e) {
      props.setOption(props.id, 'seeking', false);
      props.onSeeked(e);
    };
  },
  onSeeking: function onSeeking(props) {
    return function (e) {
      props.setOption(props.id, 'seeking', true);
      props.onSeeking(e);
    };
  },
  onTimeUpdate: function onTimeUpdate(props) {
    return function (e) {
      props.updateMediaStatus();
      props.onTimeUpdate(e);
    };
  }
};

exports.default = (0, _recompose.compose)((0, _reactJplayerUtils.connectWithId)(mapStateToProps, {
  setOption: _actions.setOption,
  pause: _actions.pause,
  play: _actions.play
}), (0, _recompose.getContext)(contextTypes), (0, _recompose.defaultProps)(defaultProps), (0, _recompose.mapProps)(mapEvents), (0, _recompose.withHandlers)(firstHandlers), (0, _recompose.withHandlers)(secondHandlers))(_events2.default);