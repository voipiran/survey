'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var _classnames = require('classnames');

var _classnames2 = _interopRequireDefault(_classnames);

var _constants = require('../../../util/constants');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

exports.default = function (jPlayer, additionalStates) {
  for (var _len = arguments.length, additionalClasses = Array(_len > 2 ? _len - 2 : 0), _key = 2; _key < _len; _key++) {
    additionalClasses[_key - 2] = arguments[_key];
  }

  var _extends2;

  return _classnames2.default.apply(undefined, [_constants.classes.JPLAYER].concat(additionalClasses, [_extends((_extends2 = {}, _defineProperty(_extends2, _constants.classes.states.AUDIO, !jPlayer.mediaSettings.video), _defineProperty(_extends2, _constants.classes.states.VIDEO, jPlayer.mediaSettings.video), _defineProperty(_extends2, _constants.classes.states.PLAYING, !jPlayer.paused), _defineProperty(_extends2, _constants.classes.states.IDLE, jPlayer.currentTime === 0), _defineProperty(_extends2, _constants.classes.states.FULL_SCREEN, jPlayer.fullScreen), _defineProperty(_extends2, _constants.classes.states.MUTED, jPlayer.muted), _defineProperty(_extends2, _constants.classes.states.VOLUME_LOW, !jPlayer.muted && jPlayer.volume < 0.5), _defineProperty(_extends2, _constants.classes.states.VOLUME_HIGH, !jPlayer.muted && jPlayer.volume >= 0.5), _defineProperty(_extends2, _constants.classes.states.SEEKING, jPlayer.seeking), _defineProperty(_extends2, _constants.classes.states.LOOPED, jPlayer.loop), _defineProperty(_extends2, _constants.classes.states.NO_BROWSER_SUPPORT, jPlayer.mediaSettings.nonSupported), _defineProperty(_extends2, _constants.classes.states.NO_VOLUME_SUPPORT, !jPlayer.volumeSupported), _extends2), additionalStates)]));
};