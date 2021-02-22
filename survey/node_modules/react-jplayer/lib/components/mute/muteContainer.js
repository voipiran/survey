'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _reactJplayerUtils = require('react-jplayer-utils');

var _actions = require('../../actions/actions');

var _mute = require('./mute');

var _mute2 = _interopRequireDefault(_mute);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var mapStateToProps = function mapStateToProps(_ref, _ref2) {
  var jPlayers = _ref.jPlayers;
  var id = _ref2.id;
  return {
    muted: jPlayers[id].muted
  };
};

var mapDispatchToProps = {
  setMute: _actions.setMute
};

exports.default = (0, _reactJplayerUtils.connectWithId)(mapStateToProps, mapDispatchToProps)(_mute2.default);