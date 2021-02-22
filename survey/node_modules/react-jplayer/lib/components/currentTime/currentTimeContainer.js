'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _reactJplayerUtils = require('react-jplayer-utils');

var _currentTime = require('./currentTime');

var _currentTime2 = _interopRequireDefault(_currentTime);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var mapStateToProps = function mapStateToProps(_ref, _ref2) {
  var jPlayers = _ref.jPlayers;
  var id = _ref2.id;
  return {
    currentTimeText: jPlayers[id].currentTimeText
  };
};

exports.default = (0, _reactJplayerUtils.connectWithId)(mapStateToProps)(_currentTime2.default);