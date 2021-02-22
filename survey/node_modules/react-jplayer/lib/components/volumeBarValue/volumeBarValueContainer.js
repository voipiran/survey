'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _reactJplayerUtils = require('react-jplayer-utils');

var _volumeBarValue = require('./volumeBarValue');

var _volumeBarValue2 = _interopRequireDefault(_volumeBarValue);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var mapStateToProps = function mapStateToProps(_ref, _ref2) {
  var jPlayers = _ref.jPlayers;
  var id = _ref2.id;
  return {
    verticalVolume: jPlayers[id].verticalVolume,
    muted: jPlayers[id].muted,
    volume: jPlayers[id].volume
  };
};

exports.default = (0, _reactJplayerUtils.connectWithId)(mapStateToProps)(_volumeBarValue2.default);