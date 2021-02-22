'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _reactJplayerUtils = require('react-jplayer-utils');

var _initializeOptions = require('../initializeOptions/initializeOptions');

var _constants = require('../util/constants');

var _urlNotSetError = require('../util/errorHandlers/urlNotSetError');

var _urlNotSetError2 = _interopRequireDefault(_urlNotSetError);

var _noFormatSupportedError = require('../util/errorHandlers/noFormatSupportedError');

var _noFormatSupportedError2 = _interopRequireDefault(_noFormatSupportedError);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

var updateFormats = function updateFormats(sources) {
  var formats = [];

  Object.keys(sources).forEach(function (supplied) {
    var canPlayType = void 0;

    try {
      // Some legacy browsers don't have canPlayType property
      canPlayType = document.createElement(_constants.formats[supplied].MEDIA).canPlayType(_constants.formats[supplied].CODEC);
    } catch (error) {
      canPlayType = '';
    }

    formats.push({
      supplied: supplied,
      supported: canPlayType
    });
  });

  return formats;
};

var clearMedia = function clearMedia() {
  return _extends({}, _constants.defaultStatus, {
    media: _constants.defaultOptions.media
  });
};

var setMedia = function setMedia(_, _ref) {
  var media = _ref.media;

  var video = void 0;
  var src = void 0;
  var nonSupported = true;
  var error = void 0;

  var formats = updateFormats(media.sources);

  formats.forEach(function (format) {
    if (format.supported && nonSupported) {
      video = _constants.formats[format.supplied].MEDIA === 'video';
      src = media.sources[format.supplied];
      nonSupported = false;
    }
  });

  if (nonSupported) {
    error = (0, _noFormatSupportedError2.default)('media.sources: \'' + Object.keys(media.sources).join(', ') + '\'');
  }

  return _extends({}, clearMedia(), {
    mediaSettings: {
      formats: formats,
      video: video,
      nonSupported: nonSupported
    },
    media: media,
    video: video,
    src: src,
    paused: true,
    error: error
  });
};

var play = function play(jPlayer, _ref2) {
  var time = _ref2.time;

  if (jPlayer.src) {
    return {
      paused: false,
      newTime: !isNaN(time) ? time : null
    };
  }

  return {
    error: (0, _urlNotSetError2.default)(play.name)
  };
};

var pause = function pause(jPlayer, _ref3) {
  var time = _ref3.time;

  if (jPlayer.src) {
    return {
      paused: true,
      newTime: !isNaN(time) ? time : null
    };
  }

  return {
    error: (0, _urlNotSetError2.default)(pause.name)
  };
};

var setPlayHead = function setPlayHead(jPlayer, _ref4) {
  var percent = _ref4.percent;

  var limitedPercent = (0, _reactJplayerUtils.limitValue)(percent, 0, 100);

  if (jPlayer.src) {
    return {
      playHeadPercent: limitedPercent
    };
  }

  return {
    error: (0, _urlNotSetError2.default)(setPlayHead.name)
  };
};

var setVolume = function setVolume(_, _ref5) {
  var volume = _ref5.volume;
  return {
    volume: (0, _reactJplayerUtils.limitValue)(volume, 0, 1),
    muted: volume <= 0
  };
};

var setMute = function setMute(_, _ref6) {
  var mute = _ref6.mute;
  return {
    muted: mute
  };
};

var setOption = function setOption(jPlayer, _ref7) {
  var key = _ref7.key,
      value = _ref7.value;

  switch (key) {
    case 'media':
      {
        if (Object.keys(value).some(function (v) {
          return v;
        })) {
          return setMedia(jPlayer, { media: value });
        }
        return clearMedia();
      }
    case 'playHeadPercent':
      return setPlayHead(jPlayer, { percent: value });
    case 'volume':
      return setVolume(jPlayer, { volume: value });
    case 'muted':
      return setMute(jPlayer, { mute: value });
    default:
      return _defineProperty({}, key, value);
  }
};

var focus = function focus(state, id) {
  var newState = _extends({}, state);

  if (newState[id].keyEnabled) {
    Object.keys(newState).forEach(function (key) {
      if (key === id) {
        newState[key].focused = true;
      } else {
        newState[key].focused = false;
      }
    });
  }

  return newState;
};

var focusOnFirstKeyEnabledPlayer = function focusOnFirstKeyEnabledPlayer(state) {
  var firstKeyEnabledPlayer = Object.keys(state).filter(function (key) {
    return state[key].keyEnabled;
  }).shift();

  if (state[firstKeyEnabledPlayer] !== undefined) {
    var focusedPlayer = _extends({}, state[firstKeyEnabledPlayer], {
      focused: true
    });

    return _extends({}, state, _defineProperty({}, firstKeyEnabledPlayer, focusedPlayer));
  }

  return state;
};

var updateJPlayer = function updateJPlayer(state, action, fn) {
  var value = fn(state[action.id], action);
  var newState = state[action.id].keyEnabled ? focus(state, action.id) : focusOnFirstKeyEnabledPlayer(state);
  var jPlayer = newState[action.id];

  return _extends({}, newState, _defineProperty({}, action.id, _extends({}, jPlayer, value)));
};

var reducer = function reducer() {
  var state = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : _initializeOptions.initialState;
  var action = arguments[1];

  var updateValue = function updateValue(fn) {
    return updateJPlayer(state, action, fn);
  };

  switch (action.type) {
    case _constants.actionNames.SET_MEDIA:
      return updateValue(setMedia);
    case _constants.actionNames.CLEAR_MEDIA:
      return updateValue(clearMedia);
    case _constants.actionNames.PLAY:
      return updateValue(play);
    case _constants.actionNames.PAUSE:
      return updateValue(pause);
    case _constants.actionNames.PLAY_HEAD:
      return updateValue(setPlayHead);
    case _constants.actionNames.VOLUME:
      return updateValue(setVolume);
    case _constants.actionNames.MUTE:
      return updateValue(setMute);
    case _constants.actionNames.SET_OPTION:
      return updateValue(setOption);
    case _constants.actionNames.FOCUS:
      return focus(state, action.id);
    default:
      return state;
  }
};

exports.default = reducer;