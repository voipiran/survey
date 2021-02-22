'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _reactJplayerUtils = require('react-jplayer-utils');

var _actions = require('../../actions/actions');

var _fullScreen = require('./fullScreen');

var _fullScreen2 = _interopRequireDefault(_fullScreen);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var mapStateToProps = function mapStateToProps(_ref, _ref2) {
  var jPlayers = _ref.jPlayers;
  var id = _ref2.id;
  return {
    fullScreen: jPlayers[id].fullScreen
  };
};

var mapDispatchToProps = {
  setFullScreen: function setFullScreen(id, fullScreen) {
    return (0, _actions.setOption)(id, 'fullScreen', fullScreen);
  }
};

exports.default = (0, _reactJplayerUtils.connectWithId)(mapStateToProps, mapDispatchToProps)(_fullScreen2.default);